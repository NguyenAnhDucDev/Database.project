<?php

require_once "Connection.php";

class Category
{

    public $name;
    public $type;
    public $class;

    public function CreateCategory() {
        try {
            if(isset($_POST["nameCategory"]) && !empty($_POST["nameCategory"]) && isset($_POST["typeCategory"]) && !empty($_POST["typeCategory"]) &&
                isset($_POST["classCategory"]) && !empty($_POST["classCategory"])) {

                $this->name = $_POST["nameCategory"];
                $this->type = $_POST["typeCategory"];
                $this->class = $_POST["classCategory"];

                $bd = new Connection();
                $con = $bd->conectar();
                $sql = $con->prepare("insert into Category(id,name,type,class,User_id) values(null,?,?,?,?)");

                $sql->execute(array(
                    $this->name,
                    $this->type,
                    $this->class,
                    $_SESSION["userToken"]
                ));

                if($sql->rowCount() > 0) {
                    header('location: TransactionPage.php');
                    echo "<script> alert('Your category has been successfully created!'); </script>";

                } else {
                    echo "<script> alert('Unable to create your category'); </script>";
                }
            }
        } catch (PDOException $msg) {
            echo "<script> alert('Unable to create category {$msg->getMessage()}'); </script>";
        }
    }

    public function ListingCategory($type) {
        try {
            $bd = new Connection();
            $con = $bd->conectar();
            $sql = $con->prepare("select * from Category where type = ? and User_id = ?");
            $sql->execute(array(
                $type,
                $_SESSION['userToken']
            ));
            if($sql->rowCount() > 0) {
                return $result = $sql->fetchAll(PDO::FETCH_CLASS);
            }

        } catch (PDOException $msg) {
            echo "<script> alert('Unable to list your categories: {$msg->getMessage()}'); </script>";
        }
    }

    public function UpdateCategory(){
        try {
            if (isset($_POST['confirmUpdate'])){
                $this->id = intval($_POST["confirmUpdate"]);
                $this->name = $_POST["updateNameCategory"];
                $this->type  = $_POST["updateTypeCategory"];
                $this->class = $_POST["updateClassCategory"];
                $bd = new Connection();

                $con = $bd->conectar();
                $sql = $con->prepare("update Category set name = ?,type = ?,class = ? where id = ?");
                $sql->execute(array(
                    $this->name,
                    $this->type,
                    $this->class,
                    $this->id
                ));

                var_dump($sql->rowCount());

                if ($sql->rowCount() > 0) {
                    header("location: TransactionPage.php");
                }
            } else {
                header("location: TransactionPage.php");
            }
        } catch (PDOException $msg) {
            echo "Unable to change categories: " . $msg->getMessage();
        }
    }

    public function DeleteCategory() {
        try {
            $bd = new Connection();
            $con = $bd->conectar();
            $sql = $con->prepare('delete from Category where id = ?');
            $sql->execute(array(
                $_GET["confirmDelete"]
            ));

            if ($sql->rowCount() > 0) {
                echo '<script type="text/javascript">alert("Category deleted successfully!");</script>';
                header('location: TransactionPage.php');
            }
        } catch (PDOException $msg) {
            echo "<script> alert('Unable to delete the category: {$msg->getMessage()}'); </script>";
        }
    }
}
