<?php require_once("../controllers/connection.php") ?>

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
    exit;
  }
?>

<?php
  if(!isset($_SESSION['row'])) {
    header('Location: ../controllers/data.php?request=admin-manager');
    exit;
  }

  $row = $_SESSION['row'];

  unset($_SESSION['row']);
?>


<html>
  <!--head starts-->
  <?php require_once("head-components.php") ?>
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
            <a href="page-manager.php" class="list-group-item lleft">Page manager</a>
            <a href="image-manager.php" class="list-group-item lleft">Image manager</a>
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
            for($i = 0; $i < count($row); $i++) {
              echo "<tr>";
              for($j = 0; $j < 3; $j++) {
                echo "<td>{$row[$i][$j]}</td>";
              }
              $row_id = $row[$i][$j-3];
              echo "<td><a role='button' href='edit-user.php?row_id=$row_id' class='btn btn-info'>Edit</a></td>";
              echo "<td><a role='button' href='../controllers/manager.php?request=delete-user&row_id=$row_id' class='btn btn-danger'>Delete</a></td>";
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