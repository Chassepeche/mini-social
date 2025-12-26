<?php
// Démarrer la session AVANT toute sortie
session_start();

// Connexion à la base de données
$servername = "localhost";
$db_user = "louisducourneau_user-db-social";
$db_password = "haMyuHr8Oa";
$dbname = "louisducourneau_mini-social";

$conn = new mysqli($servername, $db_user, $db_password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupérer les données du formulaire
$identifier = trim($_POST['ID_connect'] ?? '');
$password = $_POST['password'] ?? '';

// Vérifier que les champs ne sont pas vides
if (empty($identifier) || empty($password)) {
    die("Tous les champs sont obligatoires.");
}

// Rechercher l'utilisateur par username ou email
$sql = "SELECT id, username, mail, password FROM users WHERE username = ? OR mail = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $identifier, $identifier);
$stmt->execute();
$result = $stmt->get_result();

// Vérifier si l'utilisateur existe
if ($result->num_rows === 0) {
    die("Identifiant ou mot de passe incorrect.");
}

$user = $result->fetch_assoc();

// Vérifier le mot de passe
if (!password_verify($password, $user['password'])) {
    die("Identifiant ou mot de passe incorrect.");
}

// Connexion réussie : créer la session
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];

// Fermer les ressources
$stmt->close();
$conn->close();

// Rediriger vers la page d'accueil
header("Location: index.php");
exit(); // Important après header()
?>