<?php
@include 'config.php';

if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];
   $department = isset($_POST['department']) ? mysqli_real_escape_string($conn, $_POST['department']) : '';
   $branch = isset($_POST['branch']) ? mysqli_real_escape_string($conn, $_POST['branch']) : '';

   // Check if the user is an admin
   if ($user_type == 'admin') {
      $department = mysqli_real_escape_string($conn, $_POST['department']); // Set department to empty for admin
      $branch = ''; // Set branch to empty for admin
   }

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {
      $error[] = 'user already exist!';
   } else {
      if ($pass != $cpass) {
         $error[] = 'password not matched!';
      } else {
         $insert = "INSERT INTO user_form(name, email, password, user_type, department, branch) 
                    VALUES('$name','$email','$pass','$user_type','$department','$branch')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <select name="department">
         <option value="NA">NA</option>
         <option value="Computer Science & IT Department">Computer Science & IT Department</option>
         <option value="Civil Engg. Department">Civil Engg. Department</option>
         <option value="Mechanical Engg. & Petrolium Department">Mechanical Engg. & Petrolium Department</option>
         <option value="Electrical Engg. Technology Department">Electrical Engg. Technology Department</option>
         <option value="Aeronautical Department">Aeronautical Department</option>
      </select>
      <select name="branch">
         <option value="NA">NA</option>
         <option value="CS">CS</option>
         <option value="IT">IT</option>
         <option value="ME">ME</option>
         <option value="PE">PE</option>
         <option value="PCE">PCE</option>
         <option value="EE">EE</option>
         <option value="ECE">ECE</option>
         <option value="EIC">EIC</option>
         <option value="CE">CE</option>
         <option value="AE">AE</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

</body>
</html>
