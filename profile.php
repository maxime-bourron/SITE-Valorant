<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header('Location: connexion.html');
    exit;
}

// Récupérer l'ID de l'utilisateur à partir de la session
$id_utilisateur = $_SESSION['id_utilisateur'];

// Établir une connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'valorant_stats');

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Préparer la requête SQL pour récupérer les informations du profil
$sql = "SELECT nom_utilisateur FROM utilisateurs WHERE id_utilisateur = ?";

// Préparer la déclaration SQL
$stmt = $conn->prepare($sql);

// Lier les paramètres avec les valeurs des variables
$stmt->bind_param("i", $id_utilisateur);

// Exécuter la déclaration
$stmt->execute();

// Récupérer le résultat de la requête
$result = $stmt->get_result();

// Vérifier si l'utilisateur existe dans la base de données
if ($result->num_rows > 0) {
    // Récupérer les données de l'utilisateur
    $row = $result->fetch_assoc();
    $nom_utilisateur = $row['nom_utilisateur'];
    $id_utilisateur = $_SESSION['id_utilisateur'];

    // Créer un tableau associatif des informations du profil
    $profile_info = array(
        'id_utilisateur' => $id_utilisateur,
        "nom_utilisateur" => $nom_utilisateur
        // Ajoutez d'autres informations du profil ici si nécessaire
    );

    // Convertir le tableau associatif en format JSON
    $profile_info_json = json_encode($profile_info);

    // Renvoyer les informations du profil au format JSON
    echo $profile_info_json;
} else {
    echo "Erreur : Utilisateur introuvable.";
}

// Fermer la connexion à la base de données
$conn->close();
?>
