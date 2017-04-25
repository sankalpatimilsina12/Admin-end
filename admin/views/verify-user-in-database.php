<!--
  If email and password validation were successful, process the
  email and password values to match in database. If the user is registered
  in database, then load the dashboard.
-->

<?php require_once("../controllers/connection.php"); ?>

<?php
  $db = new Connect();

  $email = $_POST['email'];
  $password = $_POST['password'];
  $enc = md5($password);

  $query = "SELECT email, password FROM users WHERE email = '".$email."' AND password = '".$enc."'";
  $result = mysqli_query($db->getConnection(), $query);
  $row = $result->fetch_all();

  if($result->num_rows > 0) {

    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;

    header("Location:dashboard.php");
    exit;
  }

  else {
    header("Location:index.php?login_success=0");
    exit;
  } 
?>