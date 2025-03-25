<?php
$servername = "localhost"; // ou l'adresse du serveur de la base de données
$username = "root"; // utilisateur MySQL (par défaut 'root' sous XAMPP)
$password = ""; // mot de passe (généralement vide sous XAMPP)
$dbname = "gestion_projet"; // Remplace par le vrai nom de ta base

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Échec de la connexion : " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
