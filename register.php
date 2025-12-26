<?php
$servername = "localhost";
$username = "louisducourneau_user-db-social";
$password = "haMyuHr8Oa";
$dbname = "louisducourneau_mini-social";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
<form action="action.php" method="post">
   <label>Votre nom :</label>
   <input name="nom" id="nom" type="text" />

   <label>Votre âge :</label>
   <input name="age" id="age" type="number" /></p>

   <button type="submit">Valider</button>
</form>
?>
