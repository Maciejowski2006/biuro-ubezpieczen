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

	<script src="https://kit.fontawesome.com/c1cd934b70.js" crossorigin="anonymous"></script>

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
		<h2>O nas</h2>
		<h3>
			Obsługujemy <?php echo $ubezpieczenia ?> ubezpieczeń, od <?php echo $klienci ?> zadowolonych klientów, obsugiwanych w <?php echo $placowki ?> placówkach, przez <?php echo $agenci ?> agentów!
		</h3>
		<h2>Kontakt</h2>
		<h3>
			<?php
				$query5 = "SELECT adresy.kraj, adresy.wojewodztwo, adresy.miasto, adresy.ulica, adresy.budynek, adresy.mieszkanie FROM `placowki` INNER JOIN adresy on placowki.adres_id=adresy.id WHERE placowki.nazwa=\"Ubezpieczenia Graniczna\";";

				$res5 = mysqli_query($conn, $query5);
				$_adres = mysqli_fetch_assoc($res5);
				$adres = $_adres['kraj'] . ", " . $_adres['miasto'] . "(" . $_adres['wojewodztwo'] . "), " . $_adres['ulica'] . " " . $_adres['budynek'] . "/" . $_adres['mieszkanie'];
			?>


			<i class="fa-solid fa-phone"></i> +48 0700
			<br>
			<i class="fa-solid fa-envelope"></i> <a href="mailto:kontakt@najlepszeubezpieczenianaswiecie.eu" target="_blank">kontakt@najlepszeubezpieczenianaswiecie.eu</a>
			<br>
			<i class="fa-solid fa-location-dot"></i> <?php echo $adres ?>
		</h3>
	</section>
	<section>
		<img src="./bg.jpg" alt="Szczęśliwy klient">
	</section>
</main>
</body>
</html>