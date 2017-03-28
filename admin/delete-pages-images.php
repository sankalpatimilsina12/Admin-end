<!--
  This pages deletes the row in the database table of pages or images
  and redirects to either pagemanager or imagemanager based on the
  request origin.
-->

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

  switch($_GET['request']) {
    case 'pagemanager':
            $query = "DELETE FROM pages WHERE pages.id=$row_id";
            $location = "pagemanager.php";
            break;

    case 'imagemanager':
            $query = "DELETE FROM images WHERE images.id=$row_id";
            $location = "imagemanager.php";
            break;
    case 'list-images':
            $image_row_id = $_GET['image_row_id'];
            $query = "DELETE FROM images WHERE images.id=$image_row_id";
            $location = "list-images.php?row_id=$row_id";
            break;
  }

 $result = mysqli_query($db->getConnection(), $query);
 header("Location:$location");
?>