<?php
@include 'config.php';

// Remove any leading whitespace or output here

session_start();

if (!isset($_SESSION['admin_name'])) {
   header('location:login_form.php');
}

// Modified query to include user_type, department, and branch for all users
$sql = "SELECT id, name, user_type, department, branch FROM user_form";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Users</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">
   <h2>User List:</h2>
   <ul>
      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
         <li>
            <a href="fill_marks.php?id=<?php echo $row['id']; ?>">
               <?php echo $row['name']; ?>
            </a> - <?php echo $row['user_type']; ?> , <?php echo $row['department']; ?> , <?php echo $row['branch']; ?>
         </li>
      <?php endwhile; ?>
   </ul>
   <a href="admin_page.php" class="btn">Back to Admin Page</a>
</div>

</body>

</html>
