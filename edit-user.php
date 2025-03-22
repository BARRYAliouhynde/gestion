<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('location:login_form.php'); // Redirection si l'utilisateur n'est pas admin ou non connecté
    exit;
}

@include 'connexion_bdd.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result);
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "UPDATE users SET username='$username', email='$email', role='$role' WHERE id='$user_id'";
    if (mysqli_query($conn, $sql)) {
        header('location:index.php'); // Rediriger vers la page de gestion après modification
        exit;
    } else {
        echo "Erreur lors de la mise à jour : " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modifier un Utilisateur</title>
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
            <h4 class="title p-2 m-2">Modifier l'Utilisateur</h4>
            <form method="POST" class="p-4 m-2 border rounded shadow bg-light">
                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Rôle</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="professionnel" <?php if ($user['role'] == 'professionnel') echo 'selected'; ?>>Professionnel</option>
                        <option value="etudiant" <?php if ($user['role'] == 'etudiant') echo 'selected'; ?>>Étudiant</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Modifier l'utilisateur</button>
            </form>
        </section>
    </div>

</body>
</html>
