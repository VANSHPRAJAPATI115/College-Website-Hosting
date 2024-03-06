<?php
// Inside update_profile.php or similar

@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
   header('location:login_form.php');
}

if (isset($_POST['submit'])) {

   $user_id = $_SESSION['user_id']; // Get the user ID from the session
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $user_type = $_SESSION['user_type']; // Get the user type from the session
   $department = isset($_POST['department']) ? mysqli_real_escape_string($conn, $_POST['department']) : '';
   $branch = isset($_POST['branch']) ? mysqli_real_escape_string($conn, $_POST['branch']) : '';

   // If the user is an admin, don't allow changes to department and branch
   if ($user_type == 'admin') {
      $department = ''; // Set department to empty for admin
      $branch = ''; // Set branch to empty for admin
   }

   $update = "UPDATE user_form SET name = '$name', email = '$email', department = '$department', branch = '$branch' WHERE id = '$user_id'";
   mysqli_query($conn, $update);

   // Redirect to the profile page or another appropriate location
   header('location:profile.php');
}
?>
