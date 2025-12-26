<?php
// Infos de connexion MySQL
$servername = "localhost";
$db_user = "louisducourneau_user-db-social";
$db_password = "haMyuHr8Oa";
$dbname = "louisducourneau_mini-social";

// Connexion
$conn = new mysqli($servername, $db_user, $db_password, $dbname);

// Données du formulaire
$username = $_POST['user'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Requête préparée
$sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email', '$password')";
$conn->query($sql);
header("Location: login.php");


$conn->close();
?>