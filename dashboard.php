<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location:login_form.php'); // Redirection si non connecté
    exit;
}

$username = $_SESSION['username']; // Récupérer le nom d'utilisateur
$user_role = $_SESSION['role']; // 
$user_id = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styleTask.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
</head>
<body>
    <?php include "identique/header.php" ?>
    <div class="body">
        <?php include "identique/navbar.php" ?>
        <section class="section m-4">
            <!-- Le contenu spécifique à chaque utilisateur va ici. -->
            <h3 class="">Bienvenue, <?php echo htmlspecialchars($username); ?> !</h3>
            <h3>Voici votre espace de travail.</h3>

			 <!-- Admin dashboard  -->
			<?php if ($user_role == 'admin'): ?>
            <div class="dashboard">
					<div class="dashboard_box un">
						   <a href="ajouter_taches.php"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
						<span> Ajouter Taches</span>
					</div>
					<div class="dashboard_box deux" >
						<a href="voir_taches.php"><i class="fa fa-tasks"></i></a>
						<span> Les taches</span>
					</div>
					<div class="dashboard_box trois">
						<a href="index.php"><i class="fa fa-users"></i></a>
						<span>Gestion Utilisateur</span>
					</div>
					<div class="dashboard_box quatre">
						<a href=""><i class="fa fa-briefcase" aria-hidden="true"></i></a>
						<span>A Faire</span>
					</div>
					<div class="dashboard_box cinq">
						<a href=""><i class="fa fa-spinner"></i></a>
						<span> En Cours</span>
					</div>
					<div class="dashboard_box six">
						<a href=""><i class="fa fa-check-circle" aria-hidden="true"></i></a>
						<span>Terminé </span>
					</div>
				</div>

				 <!-- Etudiant And Professionnel dashboard  -->
				<?php else /*($user_role == 'etudiant'|| $user_role == 'professionnel' )*/: ?>
				<div class="dashboard">
					<div class="dashboard_box deux" >
						<a href="#"><i class="fa fa-tasks"></i></a>
						<span> Mes taches</span>
					</div>
					<div class="dashboard_box trois">
						<a href="#"> <i class="fa fa-user" aria-hidden="true"></i></a>
						<span>Mon Profile</span>
					</div>
					<div class="dashboard_box six">
						<a href="#"> <i class="fa fa-bell" aria-hidden="true"></i></i></a>
						<span>Notifications </span>
					</div>
					<div class="dashboard_box quatre">
						<a href=""><i class="fa fa-briefcase" aria-hidden="true"></i></a>
						<span>A Faire</span>
					</div>
					<div class="dashboard_box cinq">
						<a href=""><i class="fa fa-spinner"></i></a>
						<span> En Cours</span>
					</div>
					<div class="dashboard_box six">
						<a href=""><i class="fa fa-check-circle" aria-hidden="true"></i></a>
						<span>Terminé </span>
					</div>
				</div>

				<?php endif; ?>
				 <!-- Professionnel dashboard 
				 <?php //elseif ($user_role == 'professionnel'): ?>
				<div class="dashboard">
					<div class="dashboard_box deux" >
						<a href="#"><i class="fa fa-tasks"></i></a>
						<span> Mes taches</span>
					</div>
					<div class="dashboard_box trois">
						<a href="#"> <i class="fa fa-user" aria-hidden="true"></i></a>
						<span>Mon Profile</span>
					</div>
					<div class="dashboard_box trois">
						<a href="#"><i class="fa fa-users"></i></a>
						<span>les Etudiant</span>
					</div>
					<div class="dashboard_box quatre">
						<a href=""><i class="fa fa-briefcase" aria-hidden="true"></i></a>
						<span>A Faire</span>
					</div>
					<div class="dashboard_box cinq">
						<a href=""><i class="fa fa-spinner"></i></a>
						<span> En Cours</span>
					</div>
					<div class="dashboard_box six">
						<a href=""><i class="fa fa-check-circle" aria-hidden="true"></i></a>
						<span>Terminé </span>
					</div>
				</div>
				 -->
				
        </section>
    </div>
</body>
</html>
