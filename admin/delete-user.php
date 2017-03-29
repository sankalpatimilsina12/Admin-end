<?php require_once("includes/connection.php") ?>

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
    exit;
  }
?>

<?php
  $db = new Connect();
  $row_id = $_GET['row_id'];

  $query = "DELETE FROM users WHERE users.id=$row_id";
  $result = mysqli_query($db->getConnection(), $query);


  header("Location: admin-manager.php");
  exit;
?>
