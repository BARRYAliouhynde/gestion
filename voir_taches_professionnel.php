<?php
session_start();
@include '../connexion_bdd.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'professionnel') {
    header('location:login_form.php');
    exit;
}

@include 'connexion_bdd.php';

$user_id = $_SESSION['id'];

$sql = "SELECT taches.titre, users_admin.username AS nom_admin, users_admin.email AS email_admin, 
               taches.echeance, taches.statut
        FROM taches
        JOIN users AS users_admin ON taches.admin_id = users_admin.id
        WHERE taches.user_concerne = $user_id";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Erreur SQL : " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mes Tâches</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styleTask.css">
</head>
<body>

    <?php include "identique/header.php"; ?>
    <div class="body">
        <?php include "identique/navbar.php"; ?>
        <section>
            <h4 class="title p-2 m-2">Mes Tâches</h4>
            <table class="table table-bordered p-2 m-3">
                <tr>
                    <th>Titre</th>
                    <th>Assigné par</th>
                    <th>Email de l'admin</th>
                    <th>Échéance</th>
                    <th>Statut</th>
                </tr>
                
               <?php
                if (mysqli_num_rows($result) > 0) {  
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['titre']); ?></td>
                            <td><?php echo htmlspecialchars($row['nom_admin']); ?></td>
                            <td><?php echo htmlspecialchars($row['email_admin']); ?></td>
                            <td><?php echo htmlspecialchars($row['echeance']); ?></td>
                            <td><?php echo htmlspecialchars($row['statut']); ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan='5' class='text-center'>Aucune tâche trouvée</td></tr>
                <?php } ?>
            </table>
        </section>
    </div>

</body>
</html>
