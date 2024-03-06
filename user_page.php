<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:login_form.php');
}

// Initialize variables to avoid undefined index warnings
$user_id = '';
$user_marks = 'Confirm Admin';

// Check if user info is set in the session
if (isset($_SESSION['user_info']['id'])) {
   $user_id = $_SESSION['user_info']['id'];

   // Fetch user information from the database, including marks
   $sql = "SELECT * FROM user_form WHERE id = '$user_id'";
   $result = mysqli_query($conn, $sql);

   // Check if the query was successful
   if ($result) {
      // Fetch user data
      $user_data = mysqli_fetch_assoc($result);
      $user_marks = $user_data['marks'];
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>hi, <span>user</span></h3>
      <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>This is an user page</p>
      <p>Your Marks: <?php echo $user_marks; ?></p>
      <a href="login_form.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html>
