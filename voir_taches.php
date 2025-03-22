<?php
session_start();

// Vérification du rôle de l'utilisateur
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login_form.php');
    exit();
}

@include 'connexion_bdd.php'; // Assure-toi que ce fichier contient la connexion à ta base de données

// Récupérer les tâches avec le nom de l'utilisateur assigné
$sql = "SELECT taches.id_tache, taches.titre, taches.statut, users.username 
        FROM taches 
        LEFT JOIN users ON taches.user_concerne = users.id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Voir Tâches</title>
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
            <h4 class="title p-2 m-2">
                Gestion des Tâches 
                <a href="ajouter_taches.php" class="btn btn-primary">Ajouter une Tâche</a>
            </h4>
            <table class="table table-bordered">
                <tr>
                    <th>Numéro</th>
                    <th>Titre</th>
                    <th>Assigné à</th>
                    <th>Status</th>
                    <th>Éditer</th>
                    <th>Supprimer</th>
                </tr>
                
                <?php
                if (mysqli_num_rows($result) > 0) {  $i=1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$i}</td> 
                                <td>{$row['titre']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['statut']}</td>
                                <td><a href='edit_tache.php?id_tache={$row['id_tache']}' class='btn btn-warning'>Modifier</a></td>
                                <td><a href='supprimer_tache.php?id_tache={$row['id_tache']}' class='btn btn-danger' onclick='return confirm(\"Voulez-vous supprimer cette tâche ?\");'>Supprimer</a></td>
                              </tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Aucune tâche trouvée</td></tr>";
                }
                ?>
            </table>
        </section>
    </div>

</body>
</html>
