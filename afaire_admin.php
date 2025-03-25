<?php
session_start();
@include 'connexion_bdd.php';

// Vérification du rôle de l'utilisateur
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login_form.php');
    exit();
}

$statut = 'A Faire';

try {
    // Récupérer les tâches "À faire" de l'admin connecté
    $sql = "SELECT taches.titre, users.username, users.email, users.role, taches.echeance, taches.statut 
            FROM taches 
            LEFT JOIN users ON taches.user_concerne = users.id 
            WHERE taches.statut = '$statut' AND taches.admin_id = {$_SESSION['id']}";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        throw new Exception("Erreur SQL : " . mysqli_error($conn));
    }
} catch (Exception $e) {
    echo "Une erreur est survenue : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gestion des Tâches - À Faire</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styleTask.css">
</head>
<body>
    <?php include "identique/header.php"; ?>
    <div class="body">
        <?php include "identique/navbar.php"; ?>
        <section>
            <h4 class="title p-2 m-2">Tâches à Faire
                <a href="dashboard.php" class="btn btn-primary">RETOUR</a>
            </h4>
            <table class="table table-bordered">
                <tr>
                    <th>Titre de la tâche</th>
                    <th>Nom</th>
                    <th>Mail</th>
                    <th>Rôle</th>
                    <th>Échéance</th>
                    <th>Statut</th>
                </tr>
                
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['titre']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                            <td><?php echo htmlspecialchars($row['echeance']); ?></td>
                            <td><?php echo htmlspecialchars($row['statut']); ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan='6' class='text-center'>Aucune tâche trouvée</td></tr>
                <?php } ?>
            </table>
        </section>
    </div>
</body>
</html>
