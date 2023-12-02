<?php
header("Content-type:text/html; charset=utf8");

session_start();
require_once "../../Classes/User.php";
require_once "../../Classes/Category.php";
require_once "../../Classes/Registration.php";

$User = new User();
$Category = new Category();
$Registration = new Registration();

if(isset($_SESSION['userToken']) && !empty($_SESSION['userToken'])) {

		$CategoryId = $_GET['updateId'];
		var_dump($CategoryId);	
		$ListingRecipe = $Category->ListingCategory("R");
		$ListingOneData = $Registration->ListingOneData($CategoryId);

    if(isset($_GET['desconnect']) && !empty($_GET['desconnect'])) {
        $_SESSION = array();
        session_destroy();
        header('location: ../../index.php');
    }

		if (isset($_POST['UpdateExpenseRegistration'])) {
            $Registration->UpdateRegistration($CategoryId, 'R');
    }

} else {
    header('location: ../../index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
			integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
			crossorigin="anonymous"
		/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" />
		<link rel="stylesheet" href="../../Styles/_fonts.css" />
		<link rel="stylesheet" href="../../Styles/header.css" />
		<link rel="stylesheet" href="UpdateRecipeRegistration.css" />
		<title>Transactions</title>
	</head>
	<body>
		
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<section class="nav-content">
				<div class="menu-btn">
					<a class="navbar-brand" href="#">
						<i class="fas fa-comment-dollar fa-lg"></i>
						Finance
					</a>
					<button
						class="navbar-toggler"
						type="button"
						data-toggle="collapse"
						data-target="#navbarColor02"
						aria-controls="navbarColor02"
						aria-expanded="false"
						aria-label="Toggle navigation"
					>
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>

				<div class="collapse navbar-collapse" id="navbarColor02">
					<div class="mr-auto"></div>
					<ul class="navbar-nav">
						<li class="nav-item active">
							<a class="nav-link h5" href="../Transaction/TransactionPage.php">Transactions</a>
						</li>
						<li class="nav-item">
							<a class="nav-link h5" href="../History/History.php?month=1">Historic</a>
						</li>
						<li class="nav-item">
							<a class="nav-link h5" href="../Profile/Profile.php">Profile</a>
						</li>
						<li class="nav-item">
							<a class="nav-link h5" href="UpdateRegistration.php?desconnect=true">Disconnect</a>
						</li>
					</ul>
				</div>
      </section> 
    </nav>
    <main>
			<div class="form-container">
						<h2>Changes</h2>
						<form action="UpdateRecipeRegistration.php?updateId=<?php echo $_GET['updateId']; ?>" method="post" id="formCategory" class="form-register">
						<?php if ($ListingOneData) :
              foreach ($ListingOneData as $registrar) : ?>
								<select class="form-control cursor" name="classRegistration">
									<option hidden>Names</option>
									<?php if ($ListingRecipe) :
										foreach ($ListingRecipe as $categoria) : ?>
											<option 
												value="<?php echo $categoria->id ?>" 
												<?php if($registrar->Category_id == $categoria->id) : ?> 
												<?php echo "selected"; ?> 
												<?php endif; ?> 
											>
													<?php echo $categoria->name ?>
											</option>
										<?php  endforeach; ?>
									<?php endif; ?>
								</select>
								<label for="data">Choose the date</label>
								<input type="date" class="form-control data" name="dateRegistration" value="<?php echo $registrar->data; ?>" >
								<label for="valueRegistration">Expense Amount</label>
								<input
									type="text"
									class="form-control"
									id="valueRegistration"
									name="valueRegistration"
									onchange="MoneyMask('valueRegistration')"
									value="<?php echo $registrar->value.' $'; ?>"
								/>
								<a href="../History/History.php?month=1" class="btn btn-light">Come back</a>
								<button type="submit" name="UpdateExpenseRegistration" class="btn btn-info">Alter</button>
							<?php endforeach; ?>
										<?php endif; ?>
				</form>
			</div>
		</main>
	</body>
	<script src="../../JS/Masks.js"></script>
	</html>

		