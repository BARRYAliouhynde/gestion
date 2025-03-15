<?php

@include 'connexion_bdd.php';

if(isset($_POST['submit'])){

   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $role = $_POST['role'];

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select); 

   if(mysqli_num_rows($result) > 0){

      $error[] = 'OPPS Cet utilsateur existe deja!';
   }
   else{
      if($pass != $cpass){
         $error[] = 'Mot de passe non correspondant!';
      }else{
         $insert = "INSERT INTO users(username, email, password, role) VALUES('$username','$email','$pass','$role')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
         exit;
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styleContactAutre.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>S'enregistrer</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="username" required placeholder="Entrer votre nom">
      <input type="email" name="email" required placeholder="Entrer votre email">
      <input type="password" name="password" required placeholder="Entrer votre mot de passe">
      <input type="password" name="cpassword" required placeholder="Confirmer votre mot de passe">
      <select name="role">
         <option value="professionnel">Professionel</option>
         <option value="etudiant">Etudiant</option>
         <option value="admin">Administrateur</option>
      </select>
      <input type="submit" name="submit" value="S'enregistrer" class="form-btn">
      <p>J'ai deja un compte ! <a href="login_form.php"> Se connecter </a></p>
   </form>

</div>

</body>
</html>