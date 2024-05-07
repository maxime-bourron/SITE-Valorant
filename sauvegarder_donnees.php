<?php
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
$sql = "INSERT INTO stats (result, roundwin, roundlose, kills, deaths, assists, agent, map) VALUES ('$result', $roundwin, $roundlose, $kills, $deaths, $assists, '$agent', '$map')";

if ($conn->query($sql) === TRUE) {
    echo "Données insérées avec succès.";
} else {
    echo "Erreur lors de l'insertion des données : " . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();
?>

