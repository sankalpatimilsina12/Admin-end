<?php require_once("connection.php") ?>

<?php

  $db = new Connect();

  if(isset($_GET['request'])) {

    switch($_GET['request']) {
      case 'addpages':
                  $title = $db->getConnection()->real_escape_string($_POST['title']);
                  $content = $db->getConnection()->real_escape_string($_POST['content']);
                  $query = "INSERT INTO pages (title, text) VALUES ('$title', '$content')";
                  $location = "../views/page-manager.php";
                  break;

      case 'editpages':
                  $title = $db->getConnection()->real_escape_string($_POST['title']);
                  $content = $db->getConnection()->real_escape_string($_POST['content']);
                  $row_id = (int)$_GET['row_id'];
                  $query = "UPDATE pages SET title='$title', text='$content' WHERE id=$row_id";
                  $location = "../views/page-manager.php";
                  break;

      case 'pagemanager-delete':
                  $row_id = (int)$_GET['row_id'];
                  $query = "DELETE FROM pages WHERE pages.id=$row_id";
                  $location = "../views/page-manager.php";
                  break;

      case 'imagemanager-delete':
                  $row_id = $_GET['row_id'];
                  $query = "DELETE FROM images WHERE images.id=$row_id";
                  $location = "../views/image-manager.php";
                  break;

      case 'list-images-delete':
                  $row_id = $_GET['row_id'];
                  $image_row_id = $_GET['image_row_id'];
                  $query = "DELETE FROM images WHERE images.id=$image_row_id";
                  $location = "../views/list-images.php?row_id=$row_id";
                  break;

      case 'create-user':
                  $email = $db->getConnection()->real_escape_string($_POST['email']);
                  $password = $db->getConnection()->real_escape_string($_POST['password']);
                  $enc = md5($password);

                  $query = "INSERT INTO users (email, password) VALUES ('$email', '$enc')";
                  $location = "../views/admin-manager.php";
                  break;

      case 'edit-user':
                  $email = $db->getConnection()->real_escape_string($_POST['email']);
                  $password = $db->getConnection()->real_escape_string($_POST['password']);
                  $enc = md5($password);

                  $row_id = (int)$_GET['row_id'];
                  $query = "UPDATE users SET email='$email', password='$enc' WHERE id=$row_id";
                  $location = "../views/admin-manager.php";
                  break;

      case 'delete-user':
                  $row_id = $_GET['row_id'];
                  $query = "DELETE FROM users WHERE users.id=$row_id";
                  $location = "../views/admin-manager.php";
                  break;

      case 'imagemanager-upload':
                    $file = $_FILES['fileToUpload']['name'];
                    $file_loc = $_FILES['fileToUpload']['tmp_name'];
                    $folder="../resources/static/images/uploads/";
                    move_uploaded_file($file_loc,$folder.$file);

                    $page_title = $_POST['page_title'];
                    $query = "SELECT id FROM pages WHERE title='$page_title'";
                    $result = mysqli_query($db->getConnection(), $query);
                    $row = $result->fetch_all();
                    $row_id = $row[0][0];

                    $query="INSERT INTO images(image, page_id) VALUES ('$file', $row_id)";

                    $location = "../views/image-manager.php";
                    break;

      case 'list-images-upload':
                    $file = $_FILES['fileToUpload']['name'];
                    $file_loc = $_FILES['fileToUpload']['tmp_name'];
                    $folder="../resources/static/images/uploads/";
                    move_uploaded_file($file_loc,$folder.$file);

                    $row_id = $_GET['row_id'];
                    $location = "list-images.php?row_id=$row_id";

                    $query="INSERT INTO images(image, page_id) VALUES ('$file', $row_id)";

                    $location = "../views/list-images.php?row_id=$row_id";
                    break;

      case 'settings-logo':
                    $file = $_FILES['fileToUpload']['name'];
                    $file_loc = $_FILES['fileToUpload']['tmp_name'];
                    $folder="../resources/static/images/uploads/";
                    move_uploaded_file($file_loc,$folder.$file);

                    $query="INSERT INTO settings (id, logo) VALUES (1, '$file')
                            ON DUPLICATE KEY UPDATE logo='$file'";

                    $location = "../views/settings.php";
                    break;


      case 'settings-footer':
                    $footer = $db->getConnection()->real_escape_string($_POST['footer']);

                    $query = "INSERT INTO settings (id, footer) VALUES (2, '$footer')
                              ON DUPLICATE KEY UPDATE footer='$footer'";

                    $location = "../views/settings.php";
                    break;
    }

    $result = mysqli_query($db->getConnection(), $query);
  }

  header("Location: $location");
  exit;

?>