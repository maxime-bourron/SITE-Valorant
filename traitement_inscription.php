<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Hachage du mot de passe (utilisez une fonction de hachage sécurisée comme password_hash)
    $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'valorant_stats');

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Préparer la requête SQL pour insérer les données dans la table utilisateurs
    $sql = "INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe) VALUES (?, ?)";
    
    // Préparer la déclaration SQL
    $stmt = $conn->prepare($sql);

    // Lier les paramètres avec les valeurs des variables
    $stmt->bind_param("ss", $nom_utilisateur, $mot_de_passe_hache);

    // Exécuter la déclaration
    if ($stmt->execute()) {
        // Rediriger l'utilisateur vers la page de connexion si l'inscription a réussi
        header('Location: connexion.html');
        exit;
    } else {
        // Afficher un message d'erreur en cas d'échec de l'inscription
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
