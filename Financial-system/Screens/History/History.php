<?php
header("Content-type:text/html; charset=utf8");

session_start();

require_once "../../Classes/Registration.php";
require_once "../../Classes/User.php";
require_once "../../Classes/Category.php";

$Registration = new Registration();
$User = new User();
$Category = new Category();

if(isset($_SESSION['userToken']) && !empty($_SESSION['userToken'])) {

		$ListingUserData = $User->ListingUserData();
		$expense = 0;
		$recipe = 0;
		$balance = 0;
		
		foreach ($ListingUserData as $UserData) :
			$expense = $UserData->expense;
			$recipe = $UserData->recipe;
			$balance = $UserData->balance;
		endforeach;

		$ListingExpense = $Category->ListingCategory("E");
		$ListingRecipe = $Category->ListingCategory("R");

    if(isset($_GET['desconnect']) && !empty($_GET['desconnect'])) {
        $_SESSION = array();
        session_destroy();
        header('location: ../../index.php');
		}
		
		if(isset($_GET['confirmDelete'])){
			$Registration->DeleteRegistration($_GET['typeDelete']);
		}

		if(isset($_GET['month']) && !empty($_GET['month'])){
			$ListingExpense = $Registration->ListingRegistration('D', $_GET['month']);
			$ListingReceive = $Registration->ListingRegistration('R', $_GET['month']);
		}

} else {
    header('location: ../../index.php');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Historic</title>
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
			integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
			crossorigin="anonymous"
		/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" />
		<link rel="stylesheet" href="../../Styles/_fonts.css" />
		<link rel="stylesheet" href="../../Styles/header.css" />
		<link rel="stylesheet" href="History.css" />
	</head>
	<body>
		<!-- Start nav -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<section class="nav-content">
				<div class="menu-btn">
					<p class="navbar-brand">
						<i class="fas fa-comment-dollar fa-lg"></i>
						Finance
					</p>
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
						<li class="nav-item">
							<a class="nav-link h5" href="../Transaction/TransactionPage.php">Transactions</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link h5" href="History.php?month=1">Historic</a>
						</li>
						<li class="nav-item">
							<a class="nav-link h5" href="../Profile/Profile.php">Profile</a>
						</li>
						<li class="nav-item">
							<a class="nav-link h5" href="History.php?desconnect=true">Disconnect</a>
						</li>
					</ul>
				</div>
			</section>
			<section class="money-view">
				<div id="carouselExampleControls" class="carousel" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<article class="item-money-view">
								<p class="item-money-text">Balance: $ <?php echo $balance; ?></p>
							</article>
						</div>
						<div class="carousel-item">
							<article class="item-money-view">
								<p class="item-money-text">Expense: $ <?php echo $expense; ?></p>
							</article>
						</div>
						<div class="carousel-item">
							<article class="item-money-view">
								<p class="item-money-text">Revenue: $ <?php echo $recipe; ?></p>
							</article>
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</section>
		</nav>

		<!-- Finish nav -->

		<!-- Start Listing -->

		<div id="main-table-jan">
			<main class="container">
				<div class="title-table">
					<h3>Recipes</h3>
				</div>

				<nav class="month-menu">
					<label for="container-btn">Select Month:</label>
					<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" name="container-btn" id="container-btn">
						<div class="btn-group mr-2" role="group" aria-label="First group">
							<a href="History.php?month=1" class="btn btn-secondary jan" onclick="ChangeMonth('jan')">1</a>
							<a href="History.php?month=2" class="btn btn-secondary fev" onclick="ChangeMonth('fev')">2</a>
							<a href="History.php?month=3" class="btn btn-secondary mar" onclick="ChangeMonth('mar')">3</a>
							<a href="History.php?month=4" class="btn btn-secondary abr" onclick="ChangeMonth('abr')">4</a>
							<a href="History.php?month=5" class="btn btn-secondary maio" onclick="ChangeMonth('mai')">5</a>
							<a href="History.php?month=6" class="btn btn-secondary jun" onclick="ChangeMonth('jun')">6</a>
							<a href="History.php?month=7" class="btn btn-secondary jul" onclick="ChangeMonth('jul')">7</a>
							<a href="History.php?month=8" class="btn btn-secondary ago" onclick="ChangeMonth('ago')">8</a>
							<a href="History.php?month=9" class="btn btn-secondary set" onclick="ChangeMonth('set')">9</a>
							<a href="History.php?month=10" class="btn btn-secondary out" onclick="ChangeMonth('out')">10</a>
							<a href="History.php?month=11" class="btn btn-secondary nov" onclick="ChangeMonth('nov')">11</a>
							<a href="History.php?month=12" class="btn btn-secondary dez" onclick="ChangeMonth('dez')">12</a>
						</div>
					</div>
				</nav>

				<div class="container-table">
					<table>
						<tr class="trRece">
							<th>ID</th>
							<th>Class</th>
							<th>Kind</th>
							<th>Value</th>
							<th>Date</th>
							<th>Edit or Delete</th>
						</tr>
						<?php if ($ListingReceive) :
              foreach ($ListingReceive as $registrar) : ?>
								<tr class="trRece">
									<td><?php echo $registrar->id ?></td>
									<td><?php echo $registrar->name ?></td>
									<td><?php echo $registrar->type ?></td>
									<td><?php echo $registrar->value.' $' ?></td>
									<?php $timestamp = strtotime($registrar->data); ?>
									<?php $new_date = date("d-m-Y", $timestamp); ?>
									<td><?php echo $new_date; ?></td>
									<td>
										<a href="../UpdateRecipeRegistration/UpdateRecipeRegistration.php?updateId=<?php echo $registrar->id; ?>"class="btn btn-info btn-table">
											<i class="fas fa-edit"></i>
										</a>
										<a href="History.php?confirmDelete=<?php echo $registrar->id ?>&valueDelete=<?php echo $registrar->value;?>&typeDelete=DR&month=<?php echo $_GET['month']; ?>" class="btn btn-danger btn-table">
											<i class="fas fa-trash"></i>
										</a>
									</td>
								</tr>

							<?php endforeach; ?>
            <?php else : ?>
							<tr>
								<td colspan="5" id="blockedRegistrationReceita">No recipe registered!!</td>
							</tr>
            <?php endif; ?>		
					</table>	

				<div class="title-table">
					<h3>Expenditure</h3>
				</div>

				<nav class="month-menu">
					<label for="container-btn">Select the month:</label>
					<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" name="container-btn" id="container-btn">
						<div class="btn-group mr-2" role="group" aria-label="First group">
							<a href="History.php?month=1" class="btn btn-secondary jan" onclick="ChangeMonth('jan')">1</a>
							<a href="History.php?month=2" class="btn btn-secondary fev" onclick="ChangeMonth('fev')">2</a>
							<a href="History.php?month=3" class="btn btn-secondary mar" onclick="ChangeMonth('mar')">3</a>
							<a href="History.php?month=4" class="btn btn-secondary abr" onclick="ChangeMonth('abr')">4</a>
							<a href="History.php?month=5" class="btn btn-secondary maio" onclick="ChangeMonth('mai')">5</a>
							<a href="History.php?month=6" class="btn btn-secondary jun" onclick="ChangeMonth('jun')">6</a>
							<a href="History.php?month=7" class="btn btn-secondary jul" onclick="ChangeMonth('jul')">7</a>
							<a href="History.php?month=8" class="btn btn-secondary ago" onclick="ChangeMonth('ago')">8</a>
							<a href="History.php?month=9" class="btn btn-secondary set" onclick="ChangeMonth('set')">9</a>
							<a href="History.php?month=10" class="btn btn-secondary out" onclick="ChangeMonth('out')">10</a>
							<a href="History.php?month=11" class="btn btn-secondary nov" onclick="ChangeMonth('nov')">11</a>
							<a href="History.php?month=12" class="btn btn-secondary dez" onclick="ChangeMonth('dez')">12</a>
						</div>
					</div>
				</nav>

				<div class="container-table">
					<table>
						<tr class="trDesp">
							<th>ID</th>
							<th>Class</th>
							<th>Kind</th>
							<th>Value</th>
							<th>Date</th>
							<th>Edit or Delete</th>
						</tr>
						<?php if ($ListingExpense) :
              foreach ($ListingExpense as $registrar) : ?>
								<tr class="trDesp">
									<td><?php echo $registrar->id ?></td>
									<td><?php echo $registrar->name ?></td>
									<td><?php echo 'E' ?></td>
									<td><?php echo $registrar->value.' $' ?></td>
									<?php $timestamp = strtotime($registrar->data); ?>
									<?php $new_date = date("d-m-Y", $timestamp); ?>
									<td><?php echo $new_date; ?></td>
									<td>
										<a href="../UpdateExpenseRegistration/UpdateExpenseRegistration.php?updateId=<?php echo $registrar->id; ?>" class="btn btn-info btn-table">
											<i class="fas fa-edit"></i>
										</a>
										<a href="History.php?confirmDelete=<?php echo $registrar->id ?>&valueDelete=<?php echo $registrar->value;?>&typeDelete=DD&month=<?php echo $_GET['month']; ?>" class="btn btn-danger btn-table">
											<i class="fas fa-trash"></i>
										</a>
									</td>
								</tr>

							<?php endforeach; ?>
            <?php else : ?>
							<tr>
                <td colspan="5" id="blockedRegistrationDespesa">No expenses registered!!</td>
              </tr>
            <?php endif; ?>		
					</table>
				</div>
			</main>
		</div>

		<!-- Finish Jan -->

	</body>
	<script
		src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
		integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
		crossorigin="anonymous"
	></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
		integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
		crossorigin="anonymous"
  ></script>
  <script src="../../JS/Masks.js"></script>
</html>
