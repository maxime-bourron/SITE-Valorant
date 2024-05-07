<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'valorant_stats');

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Préparer la requête SQL pour récupérer le mot de passe de l'utilisateur
    $sql = "SELECT id_utilisateur, mot_de_passe FROM utilisateurs WHERE nom_utilisateur = ?";
    
    // Préparer la déclaration SQL
    $stmt = $conn->prepare($sql);

    // Lier les paramètres avec les valeurs des variables
    $stmt->bind_param("s", $nom_utilisateur);

    // Exécuter la déclaration
    $stmt->execute();

    // Récupérer le résultat de la requête
    $result = $stmt->get_result();

    // Vérifier si l'utilisateur existe dans la base de données
    if ($result->num_rows > 0) {
        // Récupérer les données de l'utilisateur
        $row = $result->fetch_assoc();
        $id_utilisateur = $row['id_utilisateur'];
        $mot_de_passe_hash = $row['mot_de_passe'];

        // Vérifier si le mot de passe soumis correspond au mot de passe haché dans la base de données
        if (password_verify($mot_de_passe, $mot_de_passe_hash)) {
            // Démarrer une session pour l'utilisateur
            session_start();
            $_SESSION['id_utilisateur'] = $id_utilisateur;

            // Rediriger l'utilisateur vers la page principale de l'application
            header('Location: index.html');
            exit;
        } else {
            // Afficher un message d'erreur si le mot de passe est incorrect
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        // Afficher un message d'erreur si l'utilisateur n'existe pas
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>