<?php
	session_start();

	require_once '../../config.php';

	if (isset($_SESSION['isLoggedIn'])) {
		if (!$_SESSION['isAgent'] && !$_SESSION['isAdministrator'])
			header("location: index.php");

		$connection = mysqli_connect($hostname, $username, $password, $dbName) or die;

		$query = "INSERT INTO `dane` (`imie`, `nazwisko`, `adres_id`, `telefon`, `email`, `password`) VALUES ('" . $_POST['imie'] . "', '" . $_POST['nazwisko'] . "', '" . $_POST['id_address'] . "', '" . $_POST['telefon'] . "', '" . $_POST['email'] . "', '" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "')";

		mysqli_query($connection, $query);

		header('location: ../../dbManager.php');
	}