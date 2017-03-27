<?php require_once("../includes/connection.php") ?>

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:not-logged.php");
  }
?>

<?php
  $db = new Connect;

  if(isset($_GET['row_id'])) {
    $row_id = (int)$_GET['row_id'];

    $email = $db->getConnection()->real_escape_string($_POST['email']);
    $password = $db->getConnection()->real_escape_string($_POST['password']);

    $query = "UPDATE users SET email='$email', password='$password' WHERE id=$row_id";
    $result = mysqli_query($db->getConnection(), $query);
  }

  $query = "SELECT id, email, password FROM users";
  $result = mysqli_query($db->getConnection(), $query);
  $row = $result->fetch_all();
?>

<html>
  <!--head starts-->
  <?php require_once("../includes/header.php") ?>
  </head>
  <!--head ends-->

  <!--body starts-->
  <body>
    <div class="container">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Index</th>  
            <th>Email</th>  
            <th>Password</th>  
          </tr>
        </thead>
        <tbody>
          <?php
            for($i = 0; $i < $result->num_rows; $i++) {
              echo "<tr>";
              for($j = 0; $j < 3; $j++) {
                echo "<td>{$row[$i][$j]}</td>";
              }
              $row_id = $row[$i][$j-3];
              echo "<td><a role='button' href='change-email-password.php?row_id=$row_id' class='btn btn-info'>Edit</a></td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table> 
      <a role="button" class="btn btn-primary" href="dashboard.php">Dashboard</a>
    </div>
  </body>
  <!--body ends-->
</html>