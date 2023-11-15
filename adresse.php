<?php
// Fonction pour générer les champs du formulaire en fonction du nombre spécifié
function genererChampsFormulaire($numeroFormulaire) {
    echo "<h2>Adresse $numeroFormulaire</h2>";
    
    // Définition des champs du formulaire
    $champs = ['street' => 'Street', 'street_nb' => 'Street Number', 'type' => 'Type', 'city' => 'City', 'zipcode' => 'Zipcode'];

    foreach ($champs as $nomChamp => $label) {
        echo "<label for=\"$nomChamp\">$label :</label>";
        
        // Gestion des types de champs différents
        if ($nomChamp === 'type') {
            echo '<select name="' . $nomChamp . '[]">';
            echo '<option value="delivery">Livraison</option>';
            echo '<option value="work">Travail</option>';
            echo '<option value="home">Domicile</option>';
            echo '<option value="billing">Facturation</option>';
            echo '<option value="other">Autre</option>';
            echo '</select>';
        } elseif ($nomChamp === 'city') {
            echo '<select name="' . $nomChamp . '[]">';
            echo '<option value="Montreal">Montreal</option>';
            echo '<option value="Laval">Laval</option>';
            echo '<option value="Toronto">Toronto</option>';
            echo '<option value="Quebec">Quebec</option>';
            echo '<option value="Manitoba">Manitoba</option>';
            echo '<option value="New Brunswick">New Brunswick</option>';
            echo '<option value="Autres">Autres</option>';
            echo '</select>';
        } else {
            echo '<input type="' . ($nomChamp === 'street_nb' ? 'number' : 'text') . '" name="' . $nomChamp . '[]" ' . ($nomChamp === 'zipcode' ? 'maxlength="6"' : '') . ' required>';
        }
        
        echo '<br>';
    }
}

// Vérification du type de requête HTTP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération du nombre d'adresses depuis le formulaire
    $nombreAdresse_forms = isset($_POST['nombreAdresse_forms']) ? intval($_POST['nombreAdresse_forms']) : 0;

    // Redirection vers la page "adresse.php" avec le nombre d'adresses en paramètre
    if ($nombreAdresse_forms > 0) {
        header("Location: adresse.php?nombreAdresse_forms=$nombreAdresse_forms");
    } else {
        // Affichage d'un message d'erreur si le nombre d'adresses n'est pas valide
        echo "Veuillez saisir un numéro valide.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css"> <!-- Modifiez le chemin selon votre structure -->
    <title>Afficher les Formulaires</title>
</head>

<body>
    <form action="result.php" method="post">
        <?php
        // Récupération du nombre d'adresses depuis l'URL
        $nombreAdresse_forms = isset($_GET['nombreAdresse_forms']) ? intval($_GET['nombreAdresse_forms']) : 0;

        // Génération des champs du formulaire en fonction du nombre d'adresses
        for ($i = 1; $i <= $nombreAdresse_forms; $i++) {
            genererChampsFormulaire($i);
        }
        ?>
        <input type="submit" name="confirm" value="Confirmer">
        <a href="index.php"><button type="button">Retour</button></a>
    </form>
</body>

</html>
