<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="./styles/global.css">
	<link rel="stylesheet" href="./styles/index.css">

	<?php
	// include komponentów
	include_once('templates/Template.php');
	include_once('templates/Nav.php');

	// deklaracja komponentów
	$nav = new templates\Nav();

	?>
</head>
<body>
<?php

// render komponentów
echo templates\Template::Render($nav);
?>
</body>
</html>

<?php
