<?php
	session_start();

	require_once './../config.php';

	if (isset($_POST['email'])) {
		// Link variables
		$_email = $_POST['email'];
		$_password = $_POST['password'];

		$connection = mysqli_connect($hostname, $username, $password, $dbName) or die;

		$query = "SELECT * FROM dane WHERE email=\"" . $_email . "\";";

		$result = mysqli_query($connection, $query);

		if ($result->num_rows > 0) {
			$row = mysqli_fetch_assoc($result);

			if (password_verify($_password, $row['password'])) {
				// Set vars
				$_SESSION['email'] = $_email;
				$daneId = $row['id'];
				$_SESSION['daneId'] = $daneId;
				$_SESSION['isLoggedIn'] = true;
				$_SESSION['isClient'] = false;
				$_SESSION['isAgent'] = false;
				$_SESSION['isAdministrator'] = false;


				if ($connection->query("SELECT * FROM klienci WHERE dane_id='$daneId'")->num_rows > 0)
					$_SESSION['isClient'] = true;

				if ($connection->query("SELECT * FROM agenci WHERE dane_id='$daneId'")->num_rows > 0)
					$_SESSION['isAgent'] = true;

				if ($connection->query("SELECT * FROM administratorzy WHERE dane_id='$daneId'")->num_rows > 0)
					$_SESSION['isAdministrator'] = true;

				header("location: ../index.php");
			}
			$result->free_result();
		}
		$connection->close();
	}

