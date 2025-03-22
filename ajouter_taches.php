<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('location:login_form.php'); // Redirection si l'utilisateur n'est pas admin ou non connecté
    exit;
}

@include 'connexion_bdd.php';

// Récupérer tous les utilisateurs pour le formulaire
$sql_users = "SELECT id, username FROM users WHERE role != 'admin' ";
$result_users = mysqli_query($conn, $sql_users);

if (isset($_POST['submit'])) {
    $titre = mysqli_real_escape_string($conn, $_POST['titre']);
    $user_concerne = mysqli_real_escape_string($conn, $_POST['user_concerne']);

    $sql = "INSERT INTO taches (titre, user_concerne) VALUES ('$titre', '$user_concerne')";
    if (mysqli_query($conn, $sql)) {
        header('location:voir_taches.php'); // Rediriger vers la page de gestion des tâches après ajout
        exit;
    } else {
        echo "Erreur lors de l'ajout de la tâche : " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ajouter Tâche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <h4 class="title p-2 m-2">Ajouter une Tâche</h4>
            <form method="POST" class="p-4 m-2 border rounded shadow bg-light">
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" required>
                </div>
                <div class="mb-3">
                    <label for="user_concerne" class="form-label">Assigné à </label>
                    <select class="form-select" name="user_concerne" required>
                        <option value="">Sélectionner un utilisateur</option>
                        <?php while ($user = mysqli_fetch_array($result_users)) { ?>
                            <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </section>
    </div>

</body>
</html>
