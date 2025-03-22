<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('location:login_form.php'); // Redirection si l'utilisateur n'est pas admin ou non connecté
    exit;
}
@include 'connexion_bdd.php';


$id_tache = $_GET['id_tache']; // ID de la tâche à supprimer

$sql_delete = "DELETE FROM taches WHERE id_tache = '$id_tache'";
if (mysqli_query($conn, $sql_delete)) {
    header('location:voir_taches.php'); // Rediriger après suppression
    exit;
} else {
    echo "Erreur lors de la suppression de la tâche : " . mysqli_error($conn);
}
?>
