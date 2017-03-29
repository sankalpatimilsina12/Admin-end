<?php require_once("includes/connection.php") ?>

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
    exit;
  }
?>

<?php
  $db = new Connect;

  if(isset($_GET['request'])) {
    $email = $db->getConnection()->real_escape_string($_POST['email']);
    $password = $db->getConnection()->real_escape_string($_POST['password']);
    $enc = md5($password);

    switch($_GET['request']) {
      case 'new-user':
              $query = "INSERT INTO users (email, password) VALUES ('$email', '$enc')";
              break;

      case 'update-user':
              $row_id = (int)$_GET['row_id'];
              $query = "UPDATE users SET email='$email', password='$enc' WHERE id=$row_id";
              break;
    }

    $result = mysqli_query($db->getConnection(), $query);
  }

  $query = "SELECT id, email, password FROM users";
  $result = mysqli_query($db->getConnection(), $query);
  $row = $result->fetch_all();
?>

<html>
  <!--head starts-->
  <?php require_once("includes/head-components.php") ?>
  </head>
  <!--head ends-->

  <!--body starts-->
  <body>
    <div class="container">
      <h2 style="text-align:center; color: gainsboro;">Admin Manager</h2>
      <br>
      <br>
      <h3 id="users-list-title">Users List</h3>
      <div class="row">
        <div class="col-sm-4">
          <div class="list-group">
            <a href="pagemanager.php" class="list-group-item lleft">Page manager</a>
            <a href="imagemanager.php" class="list-group-item lleft">Image manager</a>
            <a href="dashboard.php" class="list-group-item lleft">Dashboard</a>
          </div>
        </div>
      <div class="col-sm-8">
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
              echo "<td><a role='button' href='update-email-password.php?row_id=$row_id' class='btn btn-info'>Edit</a></td>";
              echo "<td><a role='button' href='delete-user.php?row_id=$row_id' class='btn btn-danger'>Delete</a></td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table> 
      <br>
      <br>
      <a role='button' href='create-user.php' class='btn lleft' style="min-width: 100%">Create User</a>;
      </div>
    </div>
  </body>
  <!--body ends-->
</html>