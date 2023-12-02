<?php

session_start();

require_once "../../Classes/Category.php";
require_once "../../Classes/Registration.php";
require_once "../../Classes/User.php";

$Category = new Category();
$Registration = new Registration();
$User = new User();

if(isset($_SESSION['userToken']) && !empty($_SESSION['userToken'])) {

	$ListingRecipe = $Category->ListingCategory("R");
	$ListingExpense = $Category->ListingCategory("D");

	$ListingUserData = $User->ListingUserData();
	$expense = 0;
	$recipe = 0;
	$balance = 0;

	foreach ($ListingUserData as $UserData) :
		$expense = $UserData->expense;
		$recipe = $UserData->recipe;
		$balance = $UserData->balance;
		endforeach;
	
	if(isset($_GET['desconnect']) && !empty($_GET['desconnect'])) {
        $_SESSION = array();
        session_destroy();
        header('location: ../../index.php');
	}
	
	if(isset($_POST['createCategory'])){
		$Category->CreateCategory();
	}

	if(isset($_GET['confirmDelete'])){
		$Category->DeleteCategory();
	}

	if(isset($_POST['confirmUpdate'])){
		$Category->UpdateCategory();
	}

	if(isset($_POST['btnExpense'])){
		$Registration->CreateRegistration('D');
	}

	if(isset($_POST['btnReceive'])){
		$Registration->CreateRegistration('R');
	}

	if(isset($_POST['createRegistration'])){
    $Registration->CreateRegistration();
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
		<link rel="stylesheet" href="Transaction.css" />
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
							<a class="nav-link h5" href="#">Transactions</a>
						</li>
						<li class="nav-item">
							<a class="nav-link h5" href="../History/History.php?month=1">Historic</a>
						</li>
						<li class="nav-item">
							<a class="nav-link h5" href="../Profile/Profile.php">Profile</a>
						</li>
						<li class="nav-item">
							<a class="nav-link h5" href="TransactionPage.php?desconnect=true">Disconnect</a>
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

		<section class="card-container">
			<div
				class="card"
				onmouseover="ChangeLabelCards('#435BE2', 'receita')"
				onmouseout="ChangeLabelCards('#212529', 'receita')"
				onclick="OpenForm('formCategory')"
			>
				<i class="fas fa-money-check fa-2x receita"></i>
				<p class="h3 receita">Add Categories</p>
			</div>
			<div
				class="card"
				onmouseover="ChangeLabelCards('#435BE2', 'categoria')"
				onmouseout="ChangeLabelCards('#212529', 'categoria')"
				onclick="OpenForm('formRece')"
			>
				<i class="fas fa-money-check fa-2x colorIconCard categoria"></i>
				<p class="h3 categoria">Add Recipe</p>
			</div>
			<div
				class="card"
				onmouseover="ChangeLabelCards('#435BE2', 'despesa')"
				onmouseout="ChangeLabelCards('#212529', 'despesa')"
				onclick="OpenForm('formDesp')"
			>
				<i class="fas fa-money-check fa-2x colorIconCard despesa"></i>
				<p class="h3 despesa">Add Expense</p>
			</div>
		</section>

		<div class="form-container">

			<form action="TransactionPage.php" method="post" id="formCategory" class="form-register">
				<label for="nameCategory">Category Name</label>
				<input type="text" class="form-control" id="nameCategory" placeholder="Shopping at the supermarket" name="nameCategory" />
				<label for="typeCategory">Grade Type</label>
				<select class="form-control cursor" name="typeCategory">
					<option hidden>Types</option>
					<option value="R">Revenue</option>
					<option value="D">Expenditure</option>
				</select>
				<label for="classCategory">Grade Class</label>
				<select class="form-control cursor" name="classCategory">
					<option hidden>Classes</option>
					<option value="Feeding">Feeding</option>
					<option value="Education">Education</option>
					<option value="Leisure">Leisure</option>
					<option value="Work">Work</option>
					<option value="Transport">Transport</option>
					<option value="Clothing">Clothing</option>
					<option value="Other">Other</option>
				</select>
				<div class="container-btn">
					<button type="button" class="btn btn-light" onclick="CloseForm()">Close</button>
					<button type="submit" name="createCategory" class="btn btn-info" data-toggle="modal" data-target="#Category">Create</button>
				</div>
			</form>

			<form action="TransactionPage.php" method="post" id="formDesp" class="form-register">
				<label for="classRegistration">Expense Name</label>
				<select class="form-control cursor" name="classRegistration">
				<option hidden>Names</option>
					<?php if ($ListingExpense) :
						foreach ($ListingExpense as $categoria) : ?>
							<option value="<?php echo $categoria->id ?>"><?php echo $categoria->name ?></option>
						<?php  endforeach; ?>
					<?php endif; ?>
				</select>
				<label for="data">Choose the date</label>
				<input type="date" class="form-control data" name="dateRegistration">
				<label for="valueRegistration">Expense Amount</label>
				<input
					type="text"
					class="form-control"
					id="valueRegistration"
					name="valueRegistration"
					onchange="MoneyMask('valueRegistration')"
				/>
				<div class="container-btn">
					<button type="button" class="btn btn-light" onclick="CloseForm()">Close</button>
					<button type="submit" class="btn btn-info" name="btnExpense">Create</button>
				</div>
			</form>

			<form action="TransactionPage.php" method="post" id="formRece" class="form-register">
				<label for="classRegistration">Recipe Name</label>
				<select class="form-control cursor" name="classRegistration">
					<option hidden>Names</option>
					<?php if ($ListingRecipe) :
						foreach ($ListingRecipe as $categoria) : ?>
							<option value="<?php echo $categoria->id ?>"><?php echo $categoria->name ?></option>
						<?php  endforeach; ?>
					<?php endif; ?>
				</select>
				<label for="data">Choose the date</label>
				<input type="date" class="form-control data" name="dateRegistration">
				<label for="valueRece">Revenue Amount</label>
				<input type="text" class="form-control" id="valueRece" name="valueRegistration" onchange="MoneyMask('valueRece')" />
				<div class="container-btn">
					<button type="button" class="btn btn-light" onclick="CloseForm()">Close</button>
					<button type="submit" class="btn btn-info" name="btnReceive">Create</button>
				</div>
			</form>

			<div class="container-table" id="table-category">
				<table>
					<tr class="trCate">
						<th>ID</th>
						<th>Name</th>
						<th>Class</th>
						<th>Kind</th>
						<th>Edit or Delete</th>
					</tr>
					<?php if ($ListingRecipe) :
						foreach ($ListingRecipe as $categoriaReceita) : ?>
							<tr class="trCate">
								<td><?php echo $categoriaReceita->id ?></td>
								<td><?php echo $categoriaReceita->name ?></td>
								<td><?php echo $categoriaReceita->class ?></td>
								<td>
									<?php if($categoriaReceita->type == 'R') : ?>
										<?php echo 'Receita'; ?>
									<?php endif; ?>
								</td>
								<td>
									<button 
										type="button"
										class="btn btn-info btn-table" 
										data-toggle="modal" 
										data-target="#CategoryR"
									>
										<i class="fas fa-edit"></i>
									</button>
									<a href="TransactionPage.php?confirmDelete=<?php echo $categoriaReceita->id ?>" class="btn btn-danger btn-table">
										<i class="fas fa-trash"></i>
									</a>
								</td>
							</tr>
						
							<!-- Start Update Modal -->

							<div
								class="modal fade" 
								id="CategoryR"
								data-backdrop="static"
								data-keyboard="false"
								tabindex="-1"
								aria-labelledby="staticBackdropLabel"
								aria-hidden="true"
							>
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="staticBackdropLabel">Update your category</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="TransactionPage.php" method="POST">
													
												<label for="updateNameCategory">Category Name</label>
												<input 
													type="text" 
													class="form-control" 
													id="updateNameCategory" 
													placeholder="Shopping at the supermarket..." 
													name="updateNameCategory"
													value="<?php echo $categoriaReceita->name; ?>"
												/>

												<label for="updateTypeCategory">Grade Type</label>
												<select class="form-control cursor" name="updateTypeCategory">
													<option hidden>Types</option>
													<option 
														value="R"
														<?php if($categoriaReceita->type == "R") { echo "selected"; } ?>	
													>
														Revenue				
													</option>
													<option 
														value="D"
														<?php if($categoriaReceita->type == "D") { echo "selected"; } ?>	
													>
													Expenditure
													</option>
												</select>

												<label for="updateClassCategory">Grade Class</label>
												<select class="form-control cursor" name="updateClassCategory">
													<option hidden>Classes</option>
													<option 
														value="Feeding" 
														<?php if($categoriaReceita->class == "Feeding") { echo "selected"; } ?>
													>
														Feeding
													</option>
													<option 
														value="Education"
														<?php if($categoriaReceita->class == "Education") { echo "selected"; } ?>	
													>
														Education
													</option>
													<option 
														value="Leisure"
														<?php if($categoriaReceita->class == "Leisure") { echo "selected"; } ?>	
													>
														Leisure
													</option>
													<option 
														value="Work"
														<?php if($categoriaReceita->class == "Work") { echo "selected"; } ?>	
													>
														Work
													</option>
													<option 
														value="Transport"
														<?php if($categoriaReceita->class == "Transport") { echo "selected"; } ?>	
													>
														Transport
													</option>
													<option 
														value="Clothing"
														<?php if($categoriaReceita->class == "Clothing") { echo "selected"; } ?>	
													>
														Clothing
													</option>
													<option 
														value="Other"
														<?php if($categoriaReceita->class == "Other") { echo "selected"; } ?>	
													>
														Other
													</option>
												</select>

												<button 
													type="submit" 
													class="btn btn-info btn-modal-submit" 
													name="confirmUpdate" 
													value="<?php echo $categoriaReceita->id; ?>"
												>
													Alter
												</button>
											</form>
												
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>

							<!-- End Update Modal -->

						<?php  endforeach ; ?>
					<?php else : ?>
						<tr>
          		<td colspan="4" id="blockedReceive">No recipe category registered!!</td>
        		</tr>
        	<?php endif; ?>
				</table>
			</div>

			<div class="container-table" id="table-category2">
				<table>
					<tr class="trCate">
						<th>ID</th>
						<th>Name</th>
						<th>Classe</th>
						<th>Kind</th>
						<th>Edit or Delete</th>
					</tr>
					<?php if ($ListingExpense) :
						foreach ($ListingExpense as $categoriaDespesa) : ?>
							<tr class="trCate">
								<td><?php echo $categoriaDespesa->id ?></td>
								<td><?php echo $categoriaDespesa->name ?></td>
								<td><?php echo $categoriaDespesa->class ?></td>
								<td>
									<?php if($categoriaDespesa->type === 'D') : ?>
										<?php echo 'Despesa'; ?>
									<?php endif; ?>
								</td>
								<td>
									<button 
										type="button"
										class="btn btn-info btn-table" 
										data-toggle="modal" 
										data-target="#CategoryD"
									>
										<i class="fas fa-edit"></i>
									</button>
									<a href="TransactionPage.php?confirmDelete=<?php echo $categoriaDespesa->id ?>" class="btn btn-danger btn-table">
										<i class="fas fa-trash"></i>
									</a>
								</td>
							</tr>

						<!-- Start Update Modal -->

						<div
							class="modal fade" 
							id="CategoryD"
							data-backdrop="static"
							data-keyboard="false"
							tabindex="-1"
							aria-labelledby="staticBackdropLabel"
							aria-hidden="true"
						>
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="staticBackdropLabel">Update your category</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="TransactionPage.php" method="POST">
										
											<label for="updateNameCategory">Category Name</label>
											<input 
												type="text" 
												class="form-control" 
												id="updateNameCategory" 
												placeholder="Example: Shopping at the supermarket..." 
												name="updateNameCategory"
												value="<?php echo $categoriaDespesa->name; ?>"
											/>

											<label for="updateTypeCategory">Grade Type</label>
											<select class="form-control cursor" name="updateTypeCategory">
												<option hidden>Types</option>
												<option 
													value="R"
													<?php if($categoriaDespesa->type == "R") { echo "selected"; } ?>	
												>
													Revenue
												</option>
												<option 
													value="D"
													<?php if($categoriaDespesa->type == "D") { echo "selected"; } ?>	
												>
													Expenditure
												</option>
											</select>

											<label for="updateClassCategory">Grade Class</label>
											<select class="form-control cursor" name="updateClassCategory">
												<option hidden>Classes</option>
												<option 
													value="Feeding" 
													<?php if($categoriaDespesa->class == "Feeding") { echo "selected"; } ?>
												>
													Feeding
												</option>
												<option 
													value="Education"
													<?php if($categoriaDespesa->class == "Education") { echo "selected"; } ?>	
												>
													Education
												</option>
												<option 
													value="Leisure"
													<?php if($categoriaDespesa->class == "Leisure") { echo "selected"; } ?>	
												>
													Leisure
												</option>
												<option 
													value="Work"
													<?php if($categoriaDespesa->class == "Work") { echo "selected"; } ?>	
												>
													Work
												</option>
												<option 
													value="Transport"
													<?php if($categoriaDespesa->class == "Transport") { echo "selected"; } ?>	
												>
													Transport
												</option>
												<option 
													value="Clothing"
													<?php if($categoriaDespesa->class == "Clothing") { echo "selected"; } ?>	
												>
													Clothing
												</option>
												<option 
													value="Other"
													<?php if($categoriaDespesa->class == "Other") { echo "selected"; } ?>	
												>
													Other
												</option>
											</select>

											<button 
												type="submit" 
												class="btn btn-info btn-modal-submit" 
												name="confirmUpdate" 
												value="<?php echo $categoriaDespesa->id; ?>"
											>
												Alter
											</button>
										</form>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>

						<!-- End Update Modal -->

						<?php  endforeach; ?>
					<?php else : ?>
						<tr>
          		<td colspan="4" id="blockedExpense">No expense category registered!!</td>
        		</tr>
        	<?php endif; ?>			
				</table>
			</div>

		</div>	
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
	<script src="StyleFunctions.js" type="text/javascript"></script>
	<script src="../../JS/Masks.js"></script>
</html>
