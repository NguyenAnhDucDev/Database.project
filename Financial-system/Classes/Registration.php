<?php

require_once "Connection.php";
require_once "User.php";

class Registration
{

    public $value;
    public $categoryExpenseId;
    public $categoryRecipeId;
    public $data;
    public $class;
    public $categoryId;
    
    public function CreateRegistration($type) {
            try {
              if(isset($_POST["valueRegistration"]) && !empty($_POST["valueRegistration"]) && isset($_POST["classRegistration"]) && !empty($_POST["classRegistration"]) && isset($_POST["dateRegistration"]) && !empty($_POST["dateRegistration"])) {
                $UserClass = new User();
                $bd = new Connection();
                $con = $bd->conectar();

                switch ($type) {
                  case 'D':
                    $this->categoryId = intval($_POST["classRegistration"]);
                    $this->value = doubleval(substr($_POST["valueRegistration"], 2));
                    $this->data = $_POST["dateRegistration"];

                    $sql = $con->prepare("insert into Registration(id,value,data,User_id,Category_id) values(null,?,?,?,?)");
    
                    $sql->execute(array(
                        $this->value,
                        $this->data,
                        $_SESSION["userToken"],
                        $this->categoryId
                    ));

                    if($sql->rowCount() > 0) {
                      $UserClass->UpdateUserBalance('E', 0, 0);
                    } else {
                      echo "<script> alert('Unable to record your expense.'); </script>";
                    }

                    break;
                  
                  case 'R':

                    $this->categoryId = intval($_POST["classRegistration"]);
                    $this->value = doubleval(substr($_POST["valueRegistration"], 2));
                    $this->data = $_POST["dateRegistration"];

                    $sql = $con->prepare("insert into Registration(id,value,data,User_id,Category_id) values(null,?,?,?,?)");
                    
                    $sql->execute(array(
                        $this->value,
                        $this->data,
                        $_SESSION["userToken"],
                        $this->categoryId
                    ));

                    if($sql->rowCount() > 0) {
                      $UserClass->UpdateUserBalance('R', 0, 0);
                    } else {
                      echo "<script> alert('Unable to register your revenue.'); </script>";
                    }

                    break;
                }


            }      
          } catch(PDOException $msg) {
            echo "<script> alert('Your expense could not be created: {$msg->getMessage()}'); </script>";
          }
        }
  



    public function ListingRegistration($type, $month){
      try {
        $bd = new Connection();
        $con = $bd->conectar();
        $sql = $con->prepare("select Registration.data, Registration.value, Registration.id, Category.name, Category.type, Category.class from Registration join Category on Category_id = Category.id and Registration.User_id = ? where Category.type = ? and month(Registration.data) = ?" );

        $sql->execute(array(
            $_SESSION["userToken"],
            $type,
            $month
        ));

        if ($sql->rowCount() > 0) {
             return $result = $sql->fetchAll(PDO::FETCH_CLASS);
        } 

      } catch (PDOException $msg) {
        echo "<script> alert('Unable to list your expenses and income: {$msg->getMessage()}'); </script>";
  }
}
    

    public function UpdateRegistration($id, $type){
        try {
            if (isset($_POST['UpdateExpenseRegistration'])){
                $this->class = intval($_POST["classRegistration"]);
                $this->value = doubleval(substr($_POST["valueRegistration"], 2));
                $this->data = $_POST["dateRegistration"];
                $this->categoryId = intval($id);

                $UserClass = new User();
                $bd = new Connection();
                $con = $bd->conectar();

                $sql = $con->prepare('select value from Registration where id = ?'); 
                $sql->execute(array(
                    $this->categoryId
                ));

                $lastValue = $sql->fetchAll(PDO::FETCH_CLASS);

                $sql = $con->prepare("update Registration set Category_id = ?, value = ?, data = ? where id = ?");
                $sql->execute(array(
                    $this->class,
                    $this->value,
                    $this->data,
                    $this->categoryId
                ));
                if ($sql->rowCount() > 0) {
                    switch ($type) {
                      case 'R':
                        $UserClass->UpdateUserBalance('UR', $this->categoryId, $lastValue); 
                      break;
                      case 'D':
                        $UserClass->UpdateUserBalance('UD', $this->categoryId, $lastValue); 
                      break;
                    }
                } else{
                  header("location: ../History/History.php?month=1");
                }
            } 
          } catch (PDOException $msg) {
            echo "Recipes or categories could not be changed: " . $msg->getMassage();
        }
    }

  
    public function DeleteRegistration($type){
        try{
            $UserClass = new User();
            $bd = new Connection();
            $con = $bd->conectar();
            $sql = $con->prepare('delete from Registration where id = ?');
            $sql->execute(array(
                $_GET["confirmDelete"]
            ));

            if ($sql->rowCount() > 0) {
              $UserClass->UpdateUserBalance($type, 0, 0);
            }
        }catch (PDOException $msg) {
            echo "<script> alert('Unable to delete the category: {$msg->getMessage()}');</script>";
        }
  }

  public function ListingOneData($id) {
    try {
      $bd = new Connection();
      $con = $bd->conectar();
      $sql = $con->prepare("select * from Registration where id = ?" );

      $sql->execute(array(
          $id
      ));

      if ($sql->rowCount() > 0) {
           return $result = $sql->fetchAll(PDO::FETCH_CLASS);
      } 

    } catch (PDOException $msg) {
      echo "<script> alert('Unable to list your expenses and income: {$msg->getMessage()}'); </script>";
}
  }

}

