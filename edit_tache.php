<?php
session_start();
@include 'connexion_bdd.php';

// Vérifier si l'utilisateur est bien un admin connecté
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('location:login_form.php');
    exit;
}

// Vérifier si l'ID de la tâche est fourni dans l'URL
if (!isset($_GET['id_tache'])) {
    die("Erreur : ID de la tâche manquant.");
}

$id_tache = (int) $_GET['id_tache']; // Assurer que c'est bien un nombre

// Récupérer la tâche
$sql_tache = "SELECT * FROM taches WHERE id_tache = $id_tache";
$result_tache = mysqli_query($conn, $sql_tache);

if (!$result_tache || mysqli_num_rows($result_tache) == 0) {
    die("Erreur : La tâche n'existe pas.");
}

$tache = mysqli_fetch_assoc($result_tache);

// Récupérer tous les utilisateurs
$sql_users = "SELECT id, username FROM users";
$result_users = mysqli_query($conn, $sql_users);

// Récupérer les statuts possibles
$statuts = ['En cours', 'Terminé', 'A FAIRE']; // Exemple de statuts

// Vérifier si le formulaire est soumis
if (isset($_POST['submit'])) {
    $titre = mysqli_real_escape_string($conn, $_POST['titre']);
    $user_concerne = (int) $_POST['user_concerne'];
    $statut = mysqli_real_escape_string($conn, $_POST['statut']);
    $echeance = mysqli_real_escape_string($conn, $_POST['echeance']);

    // Gérer le fichier uploadé
    if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
        $document_name = $_FILES['document']['name'];
        $document_tmp_name = $_FILES['document']['tmp_name'];
        $document_path = "documents/" . basename($document_name);

        // Déplacer le fichier téléchargé vers le répertoire "documents"
        if (move_uploaded_file($document_tmp_name, $document_path)) {
            $sql_update = "UPDATE taches SET titre = '$titre', user_concerne = $user_concerne, statut = '$statut', echeance = '$echeance', document = '$document_path' WHERE id_tache = $id_tache";
        } else {
            echo "Erreur lors du téléchargement du document.";
            exit;
        }
    } else {
        $sql_update = "UPDATE taches SET titre = '$titre', user_concerne = $user_concerne, statut = '$statut', echeance = '$echeance' WHERE id_tache = $id_tache";
    }

    if (mysqli_query($conn, $sql_update)) {
        header('location:voir_taches.php');
        exit;
    } else {
        echo "Erreur lors de la mise à jour.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier Tâche</title>
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
            <h4 class="title p-2 m-2">Modifier la Tâche</h4>
            <form method="POST" class="p-4 m-2 border rounded shadow bg-light" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $tache['titre']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="user_concerne" class="form-label">Assigné</label>
                    <select class="form-select" name="user_concerne" required>
                        <?php while ($user = mysqli_fetch_assoc($result_users)) { ?>
                            <option value="<?php echo $user['id']; ?>" <?php if ($user['id'] == $tache['user_concerne']) echo 'selected'; ?>>
                                <?php echo $user['username']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select class="form-select" name="statut" required>
                        <?php foreach ($statuts as $status) { ?>
                            <option value="<?php echo $status; ?>" <?php if ($status == $tache['statut']) echo 'selected'; ?>>
                                <?php echo $status; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="echeance" class="form-label">Échéance</label>
                    <input type="date" class="form-control" id="echeance" name="echeance" value="<?php echo $tache['echeance']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="document" class="form-label">Joindre un document</label>
                    <input type="file" class="form-control" id="document" name="document" accept=".pdf,.doc,.docx,.jpg,.png">
                    <?php if ($tache['document']): ?>
                        <p>Document actuel : <a href="<?php echo $tache['document']; ?>" target="_blank">Voir</a></p>
                    <?php endif; ?>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Modifier</button>
            </form>
        </section>
    </div>

</body>
</html>
