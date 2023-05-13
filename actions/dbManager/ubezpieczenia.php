<?php
	session_start();

	require_once '../../config.php';

	if (isset($_SESSION['isLoggedIn'])) {
		if (!$_SESSION['isAgent'] && !$_SESSION['isAdministrator'])
			header("location: index.php");

		$connection = mysqli_connect($hostname, $username, $password, $dbName) or die;

		$query = "INSERT INTO `ubezpieczenia` (`klient_id`, `tytul`, `opis`, `kwota`, `typ`) VALUES ('" . $_POST['klient_id'] . "', '" . $_POST['tytul'] . "', '" . $_POST['opis'] . "', '" . $_POST['kwota'] . "', '" . $_POST['typ'] . "')";

		mysqli_query($connection, $query);

		header('location: ../../dbManager.php');
	}