<?php
session_start();

if(!isset($_SESSION['username'])){
    header('location:login_form.php'); // Redirection si non connecté
    exit;
}
$username = $_SESSION['username']; // Récupérer le nom d'utilisateur
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
	 integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
	 crossorigin="anonymous">
	<link rel="stylesheet" href="css/styleTask.css">
</head>
</head>
<body>
	<header class="header">
		<h2 class="u-name">ONE <b>PLACE</b></h2>
		<div>
			<i class="fa fa-envelope" aria-hidden="true"></i>
			<i class="fa fa-bell" aria-hidden="true"></i>
		</div>
	</header>
	<div class="body">
		<nav class="side-bar">
			<div class="user-p">
				<img src="images/professionnel.png">
				<h4>Pr.  <?php echo htmlspecialchars($username); ?></h4>
			</div>
			<hr>
			<!-- professionnel Navigation  -->
			<ul id="navList">
				<li>
					<a href="index.php">
						<i class="fa fa-tachometer" aria-hidden="true"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li>
					<a href="profile.php">
						<i class="fa fa-user" aria-hidden="true"></i>
						<span>Mon Profile</span>
					</a>
				</li>
				<li>
					<a href="my_task.php">
						<i class="fa fa-tasks" aria-hidden="true"></i>
						<span>Mes Tâches</span>
					</a>
				</li>
				<li>
					<a href="notifications.php">
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span>Notifications</span>
					</a>
				</li>
				<li>
					<a href="logout.php">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Sortir</span>
					</a>
				</li>
			</ul>
		</nav>
		<section class="section-1">
			
		</section>
	</div>

</body>
</html>