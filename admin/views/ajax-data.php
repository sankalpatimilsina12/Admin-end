<?php require_once("../controllers/connection.php") ?>

<?php
  $db = new Connect();

  if(isset($_POST['page_id'])) {
    $page_id = $_POST['page_id'];
    $query = "DELETE FROM pages WHERE id=$page_id";
    $result = mysqli_query($db->getConnection(), $query);
    echo $result;
  }

  if(isset($_POST['image_id'])) {
    $image_id = $_POST['image_id'];
    $query = "DELETE FROM images WHERE id=$image_id";
    $result = mysqli_query($db->getConnection(), $query);
    echo $result;
  }

  if(isset($_POST['slide_id'])) {
    $slide_id = $_POST['slide_id'];
    $query = "DELETE FROM slides WHERE id=$slide_id";
    $result = mysqli_query($db->getConnection(), $query);
    echo $result;
  }

  if(isset($_POST['subscriber_id'])) {
    $subscriber_id = $_POST['subscriber_id'];
    $query = "DELETE FROM subscribers WHERE id=$subscriber_id";
    $result = mysqli_query($db->getConnection(), $query);
    echo $result;
  }

  if(isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $query = "DELETE FROM posts WHERE id=$post_id";
    $result = mysqli_query($db->getConnection(), $query);
    echo $result;
  }

  if(isset($_POST['admin_id'])) {
    $admin_id = $_POST['admin_id'];
    $query = "DELETE FROM users WHERE id=$admin_id";
    $result = mysqli_query($db->getConnection(), $query);
    echo $result;
  }
?>