<?php
	session_start();

	require_once '../../config.php';

	if (isset($_SESSION['isLoggedIn'])) {
		if (!$_SESSION['isAdministrator'])
			header("location: index.php");

		$connection = mysqli_connect($hostname, $username, $password, $dbName) or die;

		$query = "INSERT INTO `administratorzy` (`dane_id`, `rola`) VALUES ('" . $_POST['dane_id'] . "', '" . $_POST['rola'] . "')";

		mysqli_query($connection, $query);

		header('location: ../../dbManager.php');
	}