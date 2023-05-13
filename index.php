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
	<link rel="stylesheet" href="./styles/nav.css">

	<?php
		session_start();

		require_once 'config.php';
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
	<section>
		<?php
			$conn = mysqli_connect($hostname, $username, $password, $dbName) or die;


			$query = "SELECT COUNT(id) from ubezpieczenia;";
			$query2 = "SELECT COUNT(id) from klienci;";
			$query3 = "SELECT COUNT(id) from agenci;";
			$query4 = "SELECT COUNT(id) from placowki;";

			$res = mysqli_query($conn, $query);
			$res2 = mysqli_query($conn, $query2);
			$res3 = mysqli_query($conn, $query3);
			$res4 = mysqli_query($conn, $query4);
			$ubezpieczenia = mysqli_fetch_array($res)[0];
			$klienci = mysqli_fetch_array($res2)[0];
			$agenci = mysqli_fetch_array($res3)[0];
			$placowki = mysqli_fetch_array($res4)[0];


		?>

		<h2>
			Obsługujemy <?php echo $ubezpieczenia ?> ubezpieczenia, od <?php echo $klienci ?> zadowolonych klientów, obsugiwanych w <?php echo $placowki ?> placówkach, przez <?php echo $agenci ?> agentów!
		</h2>
	</section>
</main>
</body>
</html>