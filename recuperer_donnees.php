<?php
// Démarrer la session
session_start();

// Vérifier si l'ID de l'utilisateur est défini dans la session
if (!isset($_SESSION['id_utilisateur'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header('Location: connexion.php');
    exit;
}

// Récupérer l'ID de l'utilisateur à partir de la session
$id_utilisateur = $_SESSION['id_utilisateur'];

// Établir une connexion à la base de données MySQL
$conn = new mysqli('localhost', 'root', '', 'valorant_stats');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Préparer et exécuter la requête SQL pour récupérer les données de l'utilisateur depuis la base de données
$sql = "SELECT result, roundwin, roundlose, kills, deaths, assists, agent, map FROM stats WHERE id_utilisateur = '$id_utilisateur'";
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
