<?php
header("Content-type:text/html; charset=utf8");

session_start();
require_once "Classes/User.php";

$User = new User();
if(isset($_POST["logUser"])) {
    $User->Authenticator();
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
		<link rel="stylesheet" href="Styles/_fonts.css" />
		<link rel="stylesheet" href="Styles/auth.css" />
		<link rel="stylesheet" href="Styles/header.css" />
		<title>Login</title>
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
				<h3>Login</h3>
				<form action="index.php" method="post" class="form-group">
					<label for="email">Email</label>
					<input type="text" id="email" name="email" class="form-control" placeholder="login@email.com" required />
					<label for="senha">Password</label>
					<input type="password" id="senha" name="senha" class="form-control" placeholder="*******" required />
					<article>
						<button type="submit" class="btn btn-primary login" name="logUser">Enter</button>
					</article>
					<hr />
					<section>
						<p>Don't have a login?&nbsp;</p>
						<a href="Screens/RegisterAccount/RegisterAccount.php">Sign Up</a>
					</section>
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
	<script src="JS/Masks.js" type="text/javascript"></script>
</html>
