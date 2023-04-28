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
	<?php
	include_once('templates\Template.php');
	include_once('templates\Nav.php');

	$nav = new templates\Nav();
	?>
</head>
<body>
<?php
echo templates\Template::Render($nav);
?>
<main>
	<h2>Nasze placówki</h2>
	<p>Mamy wiele placówek które obsługują miliony klientów na całym świecie. Niestety nasza baza danych jest jeszcze
		nie dokończona, więc widoczna jest tylko jedna placówka.</p>
	<table>
		<tr>
			<th>Nazwa</th>
			<th>Kraj</th>
			<th>Adres</th>
		</tr>
		<?php
		$conn = mysqli_connect('192.168.0.250:3306', 'biuro_ubezpieczen', '5hE2GK@Gcs8dx5^&', 'biuro_ubezpieczen') or die;

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