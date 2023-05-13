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
        if (!$_SESSION['isAdministrator'])
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
        <h2>Konsola MariaDB</h2>
        <form action="actions/sendRequest.php" method="post">
            <label for="sql">
                SQL
                <input type="text" name="sql">
            </label>
            <input type="submit" value="Wyślij">
        </form>
    </section>
    <section class="myData">
        <h2>Moje dane</h2>
        <?php
        $connection = mysqli_connect($hostname, $username, $password, $dbName) or die;

        $query3 = "SELECT imie, nazwisko, telefon, email, adresy.*, administratorzy.rola FROM dane INNER JOIN adresy ON dane.adres_id=adresy.id INNER JOIN administratorzy ON dane.id=administratorzy.dane_id WHERE dane.id=\"" . $_SESSION['daneId'] . "\";";
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
            echo "<span class='text'><span class='bold'>Rola:</span> " . $row['rola'] . "</span>";


        }
        ?>
    </section>
</main>
</body>
</html>