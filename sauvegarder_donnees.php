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

// Récupérer les données envoyées depuis le formulaire
$result = isset($_POST['result']) ? $_POST['result'] : '';
$roundwin = isset($_POST['roundwin']) ? intval($_POST['roundwin']) : 0;
$roundlose = isset($_POST['roundlose']) ? intval($_POST['roundlose']) : 0;
$kills = isset($_POST['kills']) ? intval($_POST['kills']) : 0;
$deaths = isset($_POST['deaths']) ? intval($_POST['deaths']) : 0;
$assists = isset($_POST['assists']) ? intval($_POST['assists']) : 0;
$agent = isset($_POST['agent']) ? $_POST['agent'] : '';
$map = isset($_POST['map']) ? $_POST['map'] : '';

// Établir une connexion à la base de données MySQL
$conn = new mysqli('localhost', 'root', '', 'valorant_stats');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Préparer et exécuter la requête SQL pour insérer les données dans la base de données
$sql = "INSERT INTO stats (id_utilisateur, result, roundwin, roundlose, kills, deaths, assists, agent, map) VALUES ('$id_utilisateur', '$result', $roundwin, $roundlose, $kills, $deaths, $assists, '$agent', '$map')";

if ($conn->query($sql) === TRUE) {
    echo "Données insérées avec succès.";
} else {
    echo "Erreur lors de l'insertion des données : " . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();
?>
