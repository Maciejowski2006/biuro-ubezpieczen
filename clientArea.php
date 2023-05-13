<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubezpieczenia Graniczna</title>
    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="styles/clientArea.css">
    <link rel="stylesheet" href="./styles/nav.css">
    <?php
    require_once 'config.php';

    session_start();

    if (isset($_SESSION['isLoggedIn']))
        if (!$_SESSION['isClient'])
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
    <section class="insuances">
        <h2>Moje ubezpieczenia</h2>
        <?php
        $connection = mysqli_connect($hostname, $username, $password, $dbName) or die;

        $query = "SELECT id FROM klienci WHERE dane_id=\"" . $_SESSION['daneId'] . "\";";

        $result = mysqli_query($connection, $query);

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);

            $userId = $row['id'];

            $query2 = "SELECT tytul, opis, kwota, typ FROM ubezpieczenia WHERE klient_id=\"" . $userId . "\";";

            $result2 = mysqli_query($connection, $query2);

            if ($result2->num_rows > 0) {
                echo <<<HTML
<table>
		<tr>
			<th>Tytuł</th>
			<th>Opis</th>
			<th>Kwota</th>
			<th>Typ</th>
		</tr>
HTML;

                while ($row = mysqli_fetch_assoc($result2)) {
                    echo "<tr>";
                    echo "<td>" . $row['tytul'] . "</td>";
                    echo "<td>" . $row['opis'] . "</td>";
                    echo "<td>" . $row['kwota'] . "</td>";
                    echo "<td>" . $row['typ'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
        ?>
    </section>
    <section class="myData">
        <h2>Moje dane</h2>
        <?php
        $query3 = "SELECT imie, nazwisko, telefon, email, adresy.* FROM dane INNER JOIN adresy ON dane.adres_id=adresy.id WHERE dane.id=\"" . $_SESSION['daneId'] . "\";";
        $result3 = mysqli_query($connection, $query3);

        if ($result3->num_rows > 0) {


            $row = mysqli_fetch_assoc($result3);
            echo "<span class='text'><span class='bold'>Imię i nazwisko:</span> " . $row['imie'] . " " . $row['nazwisko'] . "</span>";
            echo "<span class='text'><span class='bold'>Adres e-mail:</span> " . $row['email'] . "</span>";
            echo "<span class='text'><span class='bold'>Telefon:</span> " . $row['telefon'] . "</span>";
            if ($row['mieszkanie'] == null)
                $addressLine = $row['kraj'] . ", " . $row['wojewodztwo'] . ", " . $row['miasto'] . ", " . $row['ulica'] . $row['budynek'] . " (" . substr_replace($row['kod_pocztowy'], "-", 2, 0) . ")";
            else
                $addressLine = $row['kraj'] . ", " . $row['wojewodztwo'] . ", " . $row['miasto'] . ", " . $row['ulica'] . " " . $row['budynek'] . "/" . $row['mieszkanie'] . " (" . substr_replace($row['kod_pocztowy'], "-", 2, 0) . ")";

            echo "<span class='text'><span class='bold'>Adres:</span> " . $addressLine . "</span>";


        }
        ?>
    </section>
</main>
</body>
</html>