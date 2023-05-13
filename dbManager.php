<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Ubezpieczenia Graniczna</title>
	<link rel="stylesheet" href="./styles/global.css">
	<link rel="stylesheet" href="styles/dbManager.css">
	<link rel="stylesheet" href="./styles/nav.css">
	<?php
		require_once 'config.php';

		session_start();

		if (isset($_SESSION['isLoggedIn']))
			if (!$_SESSION['isAgent'] && !$_SESSION['isAdministrator'])
				header("location: index.php");
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
		<h2>Menedżer bazy danych</h2>
		<h3>Adresy</h3>
		<form action="./actions/dbManager/adresy.php" method="post">
			<label for="kraj">
				Kraj
				<input type="text" name="kraj"/>
			</label>
			<label for="wojewodztwo">
				Województwo
				<input type="text" name="wojewodztwo"/>
			</label>
			<label for="miasto">
				Miasto
				<input type="text" name="miasto"/>
			</label>
			<label for="ulica">
				Ulica
				<input type="text" name="ulica"/>
			</label>
			<label for="budynek">
				Budynek
				<input type="text" name="budynek"/>
			</label>
			<label for="mieszkanie">
				Mieszkanie
				<input type="text" name="mieszkanie"/>
			</label>
			<label for="kod_pocztowy">
				Kod pocztowy
				<input type="text" name="kod_pocztowy"/>
			</label>
			<input type="submit" value="Wyślij">
		</form>
		<h3>Dane</h3>
		<form action="./actions/dbManager/dane.php" method="post">
			<label for="imie">
				Imie
				<input type="text" name="imie"/>
			</label>
			<label for="nazwisko">
				Nazwisko
				<input type="text" name="nazwisko"/>
			</label>
			<label for="id_address">
				ID Adresu
				<input type="number" name="id_address"/>
			</label>
			<label for="telefon">
				Telefon
				<input type="number" name="telefon"/>
			</label>
			<label for="email">
				E-Mail
				<input type="email" name="email"/>
			</label>
			<label for="password">
				Hasło
				<input type="password" name="password"/>
			</label>
			<input type="submit" value="Wyślij">
		</form>
		<h3>Klienci</h3>
		<form action="./actions/dbManager/klienci.php" method="post">
			<label for="dane_id">
				ID Danych
				<input type="number" name="dane_id"/>
			</label>
			<label for="agent_id">
				ID Agenta
				<input type="number" name="agent_id"/>
			</label>
			<input type="submit" value="Wyślij">
		</form>
		<h3>Ubezpieczenia</h3>
		<form action="./actions/dbManager/ubezpieczenia.php" method="post">
			<label for="klient_id">
				ID Klienta
				<input type="number" name="klient_id"/>
			</label>
			<label for="tytul">
				Tytuł
				<input type="text" name="tytul"/>
			</label>
			<label for="opis">
				Opis
				<input type="text" name="opis"/>
			</label>
			<label for="kwota">
				Kwota
				<input type="text" name="kwota"/>
			</label>
			<label for="typ">
				Typ
				<select name="typ">
					<option value="zycie">Życie</option>
					<option value="nieruchomosc">Nieruchomość</option>
					<option value="samochod">Samochód</option>
				</select>
			</label>
			<input type="submit" value="Wyślij">
		</form>

		<?php
			if ($_SESSION['isAdministrator'])
			{
				echo <<<HTML
<h3>Placówki</h3>
		<form action="./actions/dbManager/placowki.php" method="post">
			<label for="nazwa">
				Nazwa
				<input type="text" name="nazwa"/>
			</label>
			<label for="adres_id">
				ID Adresu
				<input type="number" name="adres_id"/>
			</label>
			<input type="submit" value="Wyślij">
		</form>
		<h3>Administratorzy</h3>
		<form action="./actions/dbManager/administratorzy.php" method="post">
			<label for="dane_id">
				ID Danych
				<input type="number" name="dane_id"/>
			</label>
			<label for="rola">
				Nazwisko
				<select name="rola">
					<option value="db_admin">Administrator bazy danych</option>
					<option value="devops">DevOps</option>
					<option value="ksiegowy">ksiegowy</option>
				</select>
			</label>
			<input type="submit" value="Wyślij">
		</form>
		<h3>Agenci</h3>
		<form action="./actions/dbManager/agenci.php" method="post">
			<label for="dane_id">
				ID Danych
				<input type="number" name="dane_id"/>
			</label>
			<input type="submit" value="Wyślij">
		</form>
HTML;
			}
		?>
	</section>
</main>
</body>
</html>