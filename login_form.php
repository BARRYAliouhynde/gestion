<?php
@include 'connexion_bdd.php';
session_start();

if(isset($_POST['submit'])){

   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = "SELECT * FROM users WHERE email ='$email' AND username = '$username' AND password = '$pass'";
   $result = mysqli_query($conn, $select);

   if (!$result) {
       die("Erreur SQL : " . mysqli_error($conn)); // Afficher l'erreur SQL en cas de problème
   }

   if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);

      $_SESSION['username'] = $row['username']; // Stocke le nom d'utilisateur en session
      $_SESSION['user_id'] = $row['id']; // Stocker l'ID de l'utilisateur
      $_SESSION['role'] = $row['role']; // Stocker le rôle de l'utilisateur
     
      // Redirection selon le rôle de l'utilisateur
      if($row['role'] == 'admin'){
           $_SESSION['role'] = $row['role'];
           $_SESSION['id'] = $row['id'];
           $_SESSION['username'] = $row['username'];
         
         header('location:dashboard.php'); // Redirection vers la page fusionnée pour l'admin
         exit;
      } elseif($row['role'] == 'professionnel'){
           $_SESSION['role'] = $row['role'];
           $_SESSION['id'] = $row['id'];
           $_SESSION['username'] = $row['username'];
         header('location:dashboard.php'); // Redirection vers la page fusionnée pour le professionnel
         exit;
      } elseif($row['role'] == 'etudiant'){
          $_SESSION['role'] = $row['role'];
          $_SESSION['id'] = $row['id'];
          $_SESSION['username'] = $row['username'];;
         header('location:dashboard.php'); // Redirection vers la page fusionnée pour l'étudiant
         exit;
      }
   } else {
      $error[] = 'Vos données sont incorrectes !';
   }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Page de connexion</title>
   <link rel="stylesheet" href="css/styleContactAutre.css">
</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>Se connecter</h3>
      <?php
      if(isset($error)){
         foreach($error as $msg){
            echo '<span class="error-msg">'.$msg.'</span>';
         }
      }
      ?>
      <input type="text" name="username" required placeholder="Entrer votre nom">
      <input type="email" name="email" required placeholder="Entrer votre email">
      <input type="password" name="password" required placeholder="Entrer votre mot de passe">
      <input type="submit" name="submit" value="Se connecter" class="form-btn">
      <p>Je n'ai pas encore de compte ! <a href="register_form.php">S'enregistrer</a></p>
   </form>
</div>

</body>
</html>
