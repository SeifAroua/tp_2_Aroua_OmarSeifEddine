<?php
// Fonction pour gérer la connexion à la base de données
function connectDB() {
    // Remplacez ces informations par vos propres informations de base de données
    $server = 'localhost';
    $userName = "root";
    $pwd = "";
    $db = "ecom1_tp2";

    // Création de la connexion
    $conn = new mysqli($server, $userName, $pwd, $db);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Traitement du formulaire si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // Validation et traitement des données du formulaire
    if (empty($errors)) {
        // Connexion à la base de données
        $conn = connectDB();

        // Préparation de la déclaration SQL pour l'insertion
        $stmt = $conn->prepare("INSERT INTO adress (street, street_nb, type, city, zipcode) VALUES (?, ?, ?, ?, ?)");

        // Boucle sur les données du formulaire et insertion dans la base de données
        foreach ($_POST['street'] as $key => $street) {
            $street_nb = $_POST['street_nb'][$key];
            $type = $_POST['type'][$key];
            $city = $_POST['city'][$key];
            $zipcode = $_POST['zipcode'][$key];

            // Liaison des paramètres et exécution de la déclaration
            $stmt->bind_param("sissi", $street, $street_nb, $type, $city, $zipcode);
            $stmt->execute();
        }

        // Fermeture de la déclaration
        $stmt->close();

        // Fermeture de la connexion
        $conn->close();

        // Redirection vers la page d'accueil
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/process.css">
    <title>Retour à l'accueil</title>
</head>

<body>
    <a href="index.php"><button type="button">Retour à l'accueil</button></a>
</body>
</html>
