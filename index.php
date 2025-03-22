<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('location:login_form.php'); // Redirection si l'utilisateur n'est pas admin ou non connecté
    exit;
}

$username = $_SESSION['username']; // Récupérer le nom d'utilisateur
$user_role = $_SESSION['role']; // Récupérer le rôle de l'utilisateur
$user_id = $_SESSION['id']; // Récupérer l'ID de l'utilisateur

@include 'connexion_bdd.php';

// Récupérer tous les utilisateurs
$query = "SELECT * FROM users WHERE role != 'admin'"; // Exclut les admins
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gestion Utilisateur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleTask.css">
</head>
<body>

    <?php include "identique/header.php"; ?>
    <div class="body">
        <?php include "identique/navbar.php"; ?>
        <section>
            <h4 class="title p-2 m-2">Gestion des Utilisateurs <a href="add-user.php" class="btn btn-primary">Ajouter un utilisateur</a></h4>
            <table class="table table-bordered " >
                <tr>
                    <th>Numéro</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Éditer</th>
                    <th>Supprimer</th>
                </tr>
                <?php  $i=1;
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>
                            <td>{$i}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['role']}</td>
                            <td><a href='edit-user.php?id={$row['id']}' class='btn btn-warning'>Éditer</a></td>
                            <td><a href='delete-user.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Voulez-vous vraiment supprimer cet utilisateur ?\")'>Supprimer</a></td>
                          </tr>";
                    $i++;
                }
                ?>
            </table>
        </section>
    </div>

</body>
</html>
