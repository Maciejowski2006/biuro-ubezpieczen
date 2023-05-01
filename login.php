<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="./styles/global.css">
	<link rel="stylesheet" href="./styles/login.css">

	<?php
	include_once('templates\Template.php');
	include_once('templates\Nav.php');


	$nav = new templates\Nav();
	?>
</head>
<body>
<?php
echo templates\Nav::Render($nav);
?>
<main>
	<section class="user-login">
		<form action="actions/login.php" class="user-login">
			<h3>Klient</h3>
			<input type="hidden" name="formType" value="user">
			<input type="email" name="email">
			<input type="password" name="password">
			<input type="submit" value="Zaloguj się">
		</form>
	</section>
	<hr>
	<section class="internal-login">
		<section class="agent-login">
			<form action="actions/login.php" class="user-login">
				<h3>Agent</h3>
				<input type="hidden" name="formType" value="agent">
				<input type="email" name="email">
				<input type="password" name="password">
				<input type="submit" value="Zaloguj się">
			</form>
		</section>
		<section class="admin-login">
			<form action="actions/login.php" class="user-login">
				<h3>Administrator</h3>
				<input type="hidden" name="formType" value="admin">
				<input type="email" name="email">
				<input type="password" name="password">
				<input type="submit" value="Zaloguj się">
			</form>
		</section>
	</section>
</main>
</body>
</html>