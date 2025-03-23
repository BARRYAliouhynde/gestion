<?php 
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('location:login_form.php'); // Redirection si l'utilisateur n'est pas admin ou non connecté
    exit;
}

@include 'connexion_bdd.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Vérifier si l'utilisateur est assigné à des tâches
    $sql_check_tasks = "SELECT COUNT(*) FROM taches WHERE user_concerne = '$user_id'";
    $result_check_tasks = mysqli_query($conn, $sql_check_tasks);
    $count_tasks = mysqli_fetch_row($result_check_tasks)[0];

    if ($count_tasks > 0) {
        // Si l'utilisateur est assigné à des tâches, afficher un message et ne pas supprimer
      //  echo "<script>alert('Cet utilisateur est assigné à des tâches et ne peut pas être supprimé.');</script>";
         header('location:index.php'); 
    } else {
        // Sinon, supprimer l'utilisateur
        $sql = "DELETE FROM users WHERE id = '$user_id'";
        if (mysqli_query($conn, $sql)) {
            header('location:index.php');  // Rediriger vers la page principale après suppression
            exit;
        } else {
            echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($conn);
        }
    }
}
?>
