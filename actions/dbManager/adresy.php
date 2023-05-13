<?php
	session_start();

	require_once '../../config.php';

	if (isset($_SESSION['isLoggedIn'])) {
		if (!$_SESSION['isAgent'] && !$_SESSION['isAdministrator'])
			header("location: index.php");

		$connection = mysqli_connect($hostname, $username, $password, $dbName) or die;

		$query = "INSERT INTO `adresy` ( `kraj`, `wojewodztwo`, `miasto`, `ulica`, `budynek`, `mieszkanie`, `kod_pocztowy`) VALUES ('" . $_POST['kraj'] . "', '" . $_POST['wojewodztwo'] . "', '" . $_POST['miasto'] . "', '" . $_POST['ulica'] . "', '" . $_POST['budynek'] . "', '" . $_POST['mieszkanie'] . "', '" . $_POST['kod_pocztowy'] . "')";

		if ($_POST['mieszkanie'] == "")
			$query = "INSERT INTO `adresy` ( `kraj`, `wojewodztwo`, `miasto`, `ulica`, `budynek`, `mieszkanie`, `kod_pocztowy`) VALUES ('" . $_POST['kraj'] . "', '" . $_POST['wojewodztwo'] . "', '" . $_POST['miasto'] . "', '" . $_POST['ulica'] . "', '" . $_POST['budynek'] . "', NULL, '" . $_POST['kod_pocztowy'] . "')";

		mysqli_query($connection, $query);

		header('location: ../../dbManager.php');
	}