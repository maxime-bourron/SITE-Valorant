<?php
// Établir une connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'valorant_stats');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Récupérer les données depuis la table stats
$sql = "SELECT * FROM stats ORDER BY id DESC";
$result = $conn->query($sql);

$donnees = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $donnees[] = $row;
    }
}

// Fermer la connexion à la base de données
$conn->close();

// Renvoyer les données au format JSON
header('Content-Type: application/json');
echo json_encode($donnees);
?>
