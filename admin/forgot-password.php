<?php require_once("../includes/connection.php") ?>

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
  }
?>

<?php
  $message = "Enter email to recover password";

  if(isset($_POST['email'])) {
    $db = new Connect;
    $inputEmail = $_POST['email'];
    $query = "SELECT password FROM users WHERE email='$inputEmail'";
    $result = mysqli_query($db->getConnection(), $query);
    $row = $result->fetch_all();

    if($result->num_rows > 0) {
      $message = "Your password is: {$row[0][0]}";
    }

  }
?>

<html>
  <!--head begins-->
  <?php require_once("../includes/head-components.php") ?>
  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <div class="container">
      <h5 style="color: green; text-align: center; margin-top: 15%;"><?php echo $message; ?></h5>
      <form action="" role="form" method="post" novalidate="novalidate" class="form-horizontal center-div" style="margin: 3% 30%;">
        <div class="form-group">
          <div class="col-sm-10">
            <input class="form-control" name="email" placeholder="Email">
            <br>
          <button class="btn btn-primary" type="submit">Submit</button>
          &nbsp;
          &nbsp;
          <a role="button" class="btn btn-info" href="login.php">Login</a>
          </div>
        </div>
      </form>
    </div>
  </body>
  <!--body ends-->
</html>