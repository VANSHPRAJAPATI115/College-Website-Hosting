<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
   header('location:login_form.php');
}

if (isset($_GET['id'])) {
   $user_id = $_GET['id'];
} else {
   header('location:view_users.php');
}

if (isset($_POST['submit'])) {
   // Validate and sanitize user input
   $marks = isset($_POST['marks']) ? intval($_POST['marks']) : 0;

   // Use prepared statement to prevent SQL injection
   $update_sql = "UPDATE user_form SET marks = ? WHERE id = ?";
   $stmt = mysqli_prepare($conn, $update_sql);

   if ($stmt) {
      mysqli_stmt_bind_param($stmt, "ii", $marks, $user_id);
      mysqli_stmt_execute($stmt);
      echo "<p>Marks updated successfully!</p>";
   } else {
      echo "Error in prepared statement: " . mysqli_error($conn);
   }

   // Close the statement
   mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Fill Marks</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <div class="container">
      <h2>Fill Marks for User:</h2>

      <form action="" method="post">
         <label for="marks">Enter Marks:</label>
         <input type="text" name="marks" required>
         <input type="submit" name="submit" value="Submit Marks">
      </form>
      <a href="view_users.php" class="btn">Back to User List</a>
      <a href="admin_page.php" class="btn">Back to Admin Page</a>
   </div>

</body>

</html>
