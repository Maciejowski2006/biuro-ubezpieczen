<?php
session_start();

require_once './../config.php';

if (isset($_POST['sql'])) {
    if (isset($_SESSION['isLoggedIn'])) {
        if (!$_SESSION['isAdministrator'])
            header("location: index.php");

        $connection = mysqli_connect($hostname, $username, $password, $dbName) or die;

        $query = $_POST['sql'];

        mysqli_query($connection, $query);

        header('location: ../adminArea.php');
    }
}
?>