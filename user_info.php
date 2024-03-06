<?php
@include 'config.php';

// Fetch user information from the database
$sql = "SELECT * FROM user_form";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Information</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">
   <h2>User Information</h2>
   <div style="overflow-x:auto;">
      <table border="1">
         <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Department</th>
            <th>Branch</th>
            <th>Marks</th>
         </tr>
         <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
               <td><?php echo $row['id']; ?></td>
               <td><?php echo $row['name']; ?></td>
               <td><?php echo $row['email']; ?></td>
               <td><?php echo $row['user_type']; ?></td>
               <td><?php echo $row['department']; ?></td>
               <td><?php echo $row['branch']; ?></td>
               <td><?php echo isset($row['marks']) ? $row['marks'] : ''; ?></td>
            </tr>
         <?php endwhile; ?>
      </table>
   </div>
   <a href="admin_page.php" class="btn">Back to Admin Page</a>
</div>

</body>

</html>
