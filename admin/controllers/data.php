<?php require_once('connection.php') ?>

<?php session_start() ?>

<?php
  $db = new Connect;

  switch($_GET['request']) {
    case 'page-manager':
                  $query = "SELECT id, title, text FROM pages";
                  $result = mysqli_query($db->getConnection(), $query);
                  $row = $result->fetch_all();
                  $location = "../views/page-manager.php";

                  $_SESSION['row'] = $row;
                  break;
    
    case 'image-manager':
                  $query = "SELECT id, image, page_id FROM images";
                  $result = mysqli_query($db->getConnection(), $query);
                  $row = $result->fetch_all();

                  $query = "SELECT title FROM pages";
                  $result_page = mysqli_query($db->getConnection(), $query);
                  $page_row = $result_page->fetch_all();
                  $location = "../views/image-manager.php";

                  $_SESSION['row'] = $row;
                  $_SESSION['page_row'] = $page_row;
                  break;

    case 'list-images':
                  $row_id = $_GET['row_id'];
                  $query = "SELECT id, image FROM images WHERE page_id=$row_id";
                  $result = mysqli_query($db->getConnection(), $query);
                  $row = $result->fetch_all();
                  $location = "../views/list-images.php?row_id=$row_id";

                  $_SESSION['row'] = $row;
                  break;

    case 'admin-manager':
                  $query = "SELECT id, email, password FROM users";
                  $result = mysqli_query($db->getConnection(), $query);
                  $row = $result->fetch_all();
                  $location = "../views/admin-manager.php";

                  $_SESSION['row'] = $row;
                  break;

    case 'edit-page':
                  $row_id = $_GET['row_id'];
                  $query = "SELECT title, text FROM pages WHERE id=$row_id";
                  $result = mysqli_query($db->getConnection(), $query);
                  $row = $result->fetch_all();
                  $location = "../views/edit-page.php?row_id=$row_id";

                  $_SESSION['row'] = $row;
                  break;

    case 'edit-user':
                  $row_id = $_GET['row_id'];
                  $query = "SELECT email FROM users WHERE id=$row_id";
                  $result = mysqli_query($db->getConnection(), $query);
                  $row = $result->fetch_all();
                  $location = "../views/edit-user.php?row_id=$row_id";

                  $_SESSION['row'] = $row;
                  break;
          
  }

  header("Location: $location");
  exit;
?>