<?php require_once('connection.php') ?>

<?php session_start() ?>

<?php
  $db = new Connect;

  switch($_GET['request']) {
    case 'dashboard':
                  $query = "SELECT COUNT(*) FROM pages";
                  $result = mysqli_query($db->getConnection(), $query);
                  $row = $result->fetch_all();
                  $page_count = $row[0][0];
          
                  $query = "SELECT COUNT(*) FROM images";
                  $result = mysqli_query($db->getConnection(), $query);
                  $row = $result->fetch_all();
                  $image_count = $row[0][0];

                  $location = "../views/dashboard.php";

                  $_SESSION['page_count'] = $page_count;
                  $_SESSION['image_count'] = $image_count;
                  break;

    
    case 'public-index':
                  $query = "SELECT COUNT(*) FROM pages";
                  $result = mysqli_query($db->getConnection(), $query);
                  $row = $result->fetch_all();
                  $page_count = $row[0][0];
          
                  $query = "SELECT COUNT(*) FROM images";
                  $result = mysqli_query($db->getConnection(), $query);
                  $row = $result->fetch_all();
                  $image_count = $row[0][0];


                  $query = "SELECT id, title, content, images FROM posts ORDER BY id DESC LIMIT 3";
                  $result = mysqli_query($db->getConnection(), $query);
                  $latest_posts = $result->fetch_all();

                  $location = "../../public/index.php";

                  $_SESSION['page_count'] = $page_count;
                  $_SESSION['image_count'] = $image_count;
                  $_SESSION['latest_posts'] = $latest_posts;
                  break;

    case 'public-posts-list':
                  $query = "SELECT id, title, content, images FROM posts";
                  $result = mysqli_query($db->getConnection(), $query);
                  $posts = $result->fetch_all();
                  $page = $_GET['page'];

                  $location = "../../public/posts-list.php?page=$page";

                  $_SESSION['posts'] = $posts;
                  break;

    case 'public-pages':
                  $query = "SELECT id, title, text, parent_id FROM pages";
                  $result = mysqli_query($db->getConnection(), $query);
                  $row = $result->fetch_all();

                  $location = "../../public/pages.php";

                  $_SESSION['row'] = $row;
                  break;

    case 'public-images':
                  $query = "SELECT image FROM images";
                  $result = mysqli_query($db->getConnection(), $query);
                  $row = $result->fetch_all();

                  $location = "../../public/images.php";

                  $_SESSION['row'] = $row;
                  break;

    case 'request-quote':
                  $query = "SELECT name, code FROM tbl_country";
                  $result = mysqli_query($db->getConnection(), $query);
                  $row = $result->fetch_all();

                  $location =  "../../public/request-quote.php";

                  $_SESSION['row'] = $row;
                  break;
  }
  header("Location: $location");
  exit;
?>