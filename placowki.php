<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Ubezpieczenia Graniczna</title>
	<link rel="stylesheet" href="./styles/global.css">
	<link rel="stylesheet" href="./styles/placowki.css">
	<link rel="stylesheet" href="./styles/nav.css">
	<?php
	require_once 'config.php';

		session_start();

	?>
</head>
<body>
<nav>
    <span>
		<a href="index.php">Strona główna</a>
    </span>
	<span>
		<a href="placowki.php">Placówki</a>
    </span>

	<?php
		if (isset($_SESSION['isLoggedIn'])) {
			if ($_SESSION['isLoggedIn']) {
				echo <<<HTML
<span>
	<a href="actions/logout.php">Wyloguj</a>
</span>
HTML;
			}
		} else {
			echo <<<HTML
<span>
		<a href="login.php">Logowanie</a>
    </span>
HTML;
		}

		if (isset($_SESSION['isClient']))
			if ($_SESSION['isClient']) {
				echo <<<HTML
<span>
	<a href="clientArea.php">Strefa Klienta</a>
</span>
HTML;
			}
		if (isset($_SESSION['isAgent']))
			if ($_SESSION['isAgent']) {
				echo <<<HTML
<span>
	<a href="agentArea.php">Strefa Agenta</a>
</span>
HTML;
			}
		if (isset($_SESSION['isAdministrator']))
			if ($_SESSION['isAdministrator']) {
				echo <<<HTML
<span>
	<a href="adminArea.php">Strefa Administratora</a>
</span>
HTML;
			}
		if (isset($_SESSION['isAdministrator']) || isset($_SESSION['isAgent']))
			if ($_SESSION['isAdministrator'] || isset($_SESSION['isAgent'])) {
				echo <<<HTML
<span>
	<a href="dbManager.php">Menedżer bazy danych</a>
</span>
HTML;
			}
	?>
</nav>
<main>
	<h2>Nasze placówki</h2>
	<p>Mamy wiele placówek które obsługują kilkanaście klientów na całym świecie.</p>
	<table>
		<tr>
			<th>Nazwa</th>
			<th>Kraj</th>
			<th>Adres</th>
		</tr>
		<?php
		$conn = mysqli_connect($hostname, $username, $password, $dbName) or die;


		$query = "SELECT nazwa, adresy.kraj, adresy.miasto, adresy.ulica, adresy.budynek FROM `placowki` INNER JOIN adresy on placowki.adres_id=adresy.id;";

		$res = mysqli_query($conn, $query);

		while ($row = mysqli_fetch_assoc($res)) {
			echo "<tr>";
			echo "<td>" . $row['nazwa'] . "</td>";
			echo "<td>" . $row['kraj'] . "</td>";
			echo "<td>" . $row['miasto'] . ", " . $row['ulica'] . " " . $row['budynek'] . "</td>";
			echo "</tr>";
		}
		?>
	</table>
</main>

</body>
</html>