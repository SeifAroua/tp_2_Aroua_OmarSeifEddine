<!-- add connexion -->
<?php
$server = 'localhost';
$userName = "root";
$pwd = "";
$db = "ecom1_tp2";

$conn = mysqli_connect($server, $userName, $pwd, $db);
if ($conn) {
    echo 'la connexion fonctionne';
    global $conn;
} else {
    echo "Error : Not connected to the $db database";
}
?>