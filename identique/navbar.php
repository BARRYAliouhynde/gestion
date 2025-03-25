<?php

// Vérifier si les variables de session existent, sinon leur attribuer des valeurs par défaut
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'professionel';
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : 'etudiant'; // Valeur par défaut
?>


<nav class="side-bar">
        <div class="user-p">
            <!-- Affiche l'image en fonction du rôle -->
       <img src="images/<?php 
                if ($user_role == 'admin') {
                    echo 'admin.png'; 
                } elseif ($user_role == 'professionnel') {
                    echo 'professionnel.png'; 
                } else {
                    echo 'etudiant.jpeg'; 
                }
            ?>">


            <!-- Affiche le titre et le nom d'utilisateur -->
            <h4><?php 
                if ($user_role == 'admin') {
                    echo 'Ad.'; 
                } elseif ($user_role == 'professionnel') {
                    echo 'Pr.'; 
                } else {
                    echo 'Et.'; 
                }
                echo ' ' . htmlspecialchars($username); 
            ?></h4>
            <hr>
        </div>


            <!-- Admin Navigation Bar -->
            <?php if ($user_role == 'admin'): ?>
                <ul id="navList">
                    <li>
                        <a href="dashboard.php">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="ajouter_taches.php">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            <span>Ajouter Tâche</span>
                        </a>
                    </li>
                    <li>
                        <a href="voir_taches.php">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            <span>Voir Tâches</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Gestion utilisateurs</span>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            <span>Sortir</span>
                        </a>
                    </li>
                </ul>
            <!-- Etudiant Navigation Bar -->
            <?php elseif ($user_role == 'etudiant'): ?>
                <ul id="navList">
                    <li>
                        <a href="dashboard.php">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Mon Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="voir_taches_etudiant.php">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            <span>Mes Tâches</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
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
            <!-- Professionnel Navigation Bar -->
            <?php elseif ($user_role == 'professionnel'): ?>
                <ul id="navList">
                    <li>
                        <a href="dashboard.php">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Mon Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="voir_taches_professionnel.php">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            <span>Mes Tâches</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
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
            <?php endif; ?>
</nav>