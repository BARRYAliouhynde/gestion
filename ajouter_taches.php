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
    $echeance = mysqli_real_escape_string($conn, $_POST['echeance']);
    $admin_id = $_SESSION['id'];    // Récupérer l'ID de l'admin connecté

    $document = ''; // Initialisation de la variable document

    // Vérification si un fichier a été uploadé
    if (!empty($_FILES['document']['name'])) {
        $target_dir = "uploads/"; // Dossier de stockage des fichiers

        // S'assurer que le dossier uploads existe
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $document = $target_dir . basename($_FILES["document"]["name"]);

        // Vérifier et déplacer le fichier uploadé
        if (!move_uploaded_file($_FILES["document"]["tmp_name"], $document)) {
            echo "Erreur lors du téléchargement du fichier.";
            exit;
        }
    }

    // Insérer la tâche dans la base de données
    $sql = "INSERT INTO taches (titre, user_concerne, admin_id, echeance, document) 
            VALUES ('$titre', '$user_concerne', '$admin_id', '$echeance', '$document')";

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
            <form method="POST" enctype="multipart/form-data" class="p-4 m-2 border rounded shadow bg-light">
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
                <div class="mb-3">
                    <label for="echeance" class="form-label">Date d'échéance</label>
                    <input type="date" class="form-control" id="echeance" name="echeance" required>
                </div>
                <div class="mb-3">
                    <label for="document" class="form-label">Joindre un document</label>
                    <input type="file" class="form-control" id="document" name="document" accept=".pdf,.doc,.docx,.jpg,.png,.txt">
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
            </form>

        </section>
    </div>

</body>
</html>
