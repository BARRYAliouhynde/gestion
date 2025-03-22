<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('location:login_form.php'); // Redirection si l'utilisateur n'est pas admin ou non connecté
    exit;
}

@include 'connexion_bdd.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = '$user_id'";
    if (mysqli_query($conn, $sql)) {
        header('location:index.php'); // Rediriger vers la page de gestion après suppression
        exit;
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($conn);
    }
}
?>
