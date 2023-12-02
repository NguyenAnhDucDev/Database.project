<?php
header("Content-type:text/html; charset=utf8");

session_start();
require_once "../../Classes/User.php";

$User = new User();
if(isset($_POST["createUser"])) {
    $User->VerifyUserToCreate();
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
		<link rel="stylesheet" href="../../Styles/auth.css" />
		<link rel="stylesheet" href="../../Styles/header.css" />
		<title>Cadastre</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<section class="nav-content">
				<div class="menu-btn">
					<a class="navbar-brand" href="#">
						<i class="fas fa-comment-dollar fa-lg"></i>
						Finance
					</a>
				</div>
			</section>
		</nav>
		<main>
			<div>
				<h3>Sign Up</h3>
				<form action="RegisterAccount.php" method="post" class="form-group">
					<label for="nome">Name</label>
					<input type="text" id="nome" name="nome" class="form-control" placeholder="Nguyen Anh Duc" required />
					<label for="sexo">Sex</label>
					<select name="sexo" id="sexo" class="form-control" required>
						<option value="">Select the option:</option>
						<option value="F">Female</option>
						<option value="M">Male</option>
						<option value="O">Other</option>
						<option value="N">Do Not Declare</option>
					</select>
					<label for="email">E-mail</label>
					<input type="email" id="email" name="email" class="form-control" placeholder="22024536@vnu.edu.vn" required />
					<label for="endereco">Address</label>
					<input type="text" id="endereco" name="endereco" class="form-control" placeholder="Avenue or street" required />
					<label for="telefone">Cell phone</label>
					<input
						type="text"
						id="telefone"
						name="telefone"
						class="form-control"
						placeholder="(xx) xxxxx-xxxx"
						required
						oninput="PhoneMask('telefone')"
					/>
					<label for="senha">Password</label>
					<input type="password" id="senha" name="senha" class="form-control" placeholder="*******" required />
					<article>
						<a href="../../index.php" class="btn btn-outline-secondary voltar">Back</a>
						<button type="submit" class="btn btn-success criar" name="createUser">Create</button>
					</article>
				</form>
			</div>
		</main>
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
	<script src="../../JS/Masks.js" type="text/javascript"></script>
</html>
