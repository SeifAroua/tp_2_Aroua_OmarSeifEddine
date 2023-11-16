<?php
// Fonction pour gérer la connexion à la base de données
function connectDB() {
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
        $stmt = $conn->prepare("INSERT INTO `address` (street, street_nb, `type`, city, zipcode) VALUES (?, ?, ?, ?, ?)");

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
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">

    <title>Résultat</title>
</head>

<body>
    <?php
    // Affichage du message de confirmation
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo '<h1>Félicitations, vos adresses ont bien été ajoutées à la base de données.</h1>';
    }
    ?>

    <a href="index.php"><button type="button">Retour à l'accueil</button></a>
</body>
</html>
