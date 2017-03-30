<?php require_once("includes/connection.php") ?>


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