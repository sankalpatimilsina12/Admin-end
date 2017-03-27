<?php require_once("includes/connection.php") ?>

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:not-logged.php");
  }
?>

<?php
  $db = new Connect;

  if(isset($_POST['submit-btn'])) {
    $file = $_FILES['fileToUpload']['name'];
    $file_loc = $_FILES['fileToUpload']['tmp_name'];
    $folder="images/uploads/";
    move_uploaded_file($file_loc,$folder.$file);

    switch($_GET['request']) {
      case 'imagemanager':
                $row_id = $_POST['page_id'];
                $location = "imagemanager.php";
                break;

      case 'list-images':
                $row_id = $_GET['row_id'];
                $location = "list-images.php?row_id=$row_id";
                break;
    }

    $query="INSERT INTO images(image, page_id) VALUES ('$file', $row_id)";
    $result = mysqli_query($db->getConnection(), $query); 
  }

  header("Location:$location");
  exit;
?>