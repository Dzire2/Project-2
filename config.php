<?php
$host = 'localhost';  // Hostname ya MySQL Server
$username = 'root';   // Jina la mtumiaji wa MySQL
$password = '';  // Nenosiri la mtumiaji wa MySQL
$database = 'JSdatabase';  // Jina la database unayotaka kuunganisha

// Ufunguo wa uunganisho wa MySQL
$conn = mysqli_connect($host, $username, $password, $database);
// Angalia kama kuna hitilafu wakati wa uunganisho
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>