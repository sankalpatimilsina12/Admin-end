<!--
  This page lists all the availabe posts.
-->

<?php require_once("../admin/controllers/site-contents.php") ?>

<!--Get data to populate the charts-->
<?php session_start(); ?>

<?php

  logoFooterSiteUrl(); 

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];
  $site_url = $_SESSION['site-url'];

  if(isset($_GET['page'])) {
    $page = $_GET['page'];
  }
  else{
    $page = 1;
  }

  if(!isset($_SESSION['posts'])) {
    header("Location: $site_url/admin/controllers/data.php?request=public-posts-list&page=$page");
    exit;
  }


  $posts_limit = 3;

  $allPosts = $_SESSION['posts'];

  $posts = [];

  for($i = 0; $i < $posts_limit; $i++)
  {
    if(!isset($allPosts[($page - 1) * 3 + $i]))
      break;

    array_push($posts, $allPosts[($page - 1) * 3 + $i]); 
  }

  unset($_SESSION['posts']);
  unset($_SESSION['logo']);
  unset($_SESSION['footer']);
  unset($_SESSION['site-url']);

?>

<html lang="en">
  <!--head begins-->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo $site_url ?>/admin/resources/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $site_url ?>/admin/resources/static/css/style-public.css">
    <link rel="stylesheet" href="<?php echo $site_url ?>/admin/resources/font-awesome/css/font-awesome.min.css">
    <script src="<?php echo $site_url ?>/admin/resources/static/js/jquery-3.2.0.min.js" ></script>
    <script src="<?php echo $site_url ?>/admin/resources/static/js/bootstrap.min.js" ></script>
    <script src="<?php echo $site_url ?>/admin/resources/highcharts/highcharts.js" ></script>
  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <div class="container-fluid">

      <nav class="navbar navbar-toggleable-md navbar-light" style="background-color: #222; height: 50px;">
        <a class="navbar-brand" href="index.php">
          <img src="<?php echo $site_url ?>/admin/resources/static/images/logo.png" width="30" height="30" alt="cms-logo">
        </a>

        <a href="request-quote.php" class="request-quote">
          <i class="fa fa-envelope-o" aria-hidden="true"><span class="request-quote-text"> Request Quote</span></i>
        </a>
      </nav>

      <nav class="nav flex-column side-nav">
        <li class="nav-item active">
          <a class="nav-link" href="images.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Pages Viewport</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="images.php"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Images Viewport</a>
        </li>
      </nav>

      <div class="right-container" style="padding: 2%">

        <div class="row">
          <div class="col-sm-12">
              <h2 class="page-header">
                  Posts <small style="color: gray">View all posts</small>
              </h2>
              <hr>
              <ol class="breadcrumb">
                  <li class="active">
                      <i class="fa fa-list"></i> Posts
                  </li>
              </ol>
          </div>
        </div>
        <br>
        <div class="row">
          <?php for($i = 0; $i < count($posts); $i++) { 
              if(!isset($posts[$i][0]))
                break;
              $words = explode(" ", $posts[$i][2]);
              $images = explode(",", $posts[$i][3]);
              array_pop($images);
              $background = array("#6666ff", "#333", "#808000"); ?>
              <div class="col-sm-4">
                <div class="card card-inverse" style="background-color: <?php echo $background[$i]; ?>">
                  <div class="card-block">
                    <h3 class="card-title"><?php echo $posts[$i][1]; ?></h3>
                    <div>
                      <img class'card-img-top' style='width: 70%; height: 35%' src='<?php echo $site_url; ?>/admin/resources/static/images/uploads/<?php echo $images[0]; ?>' alt='img'>
                    </div>
                    <br>
                    <div class="row" style="padding-left: 5%">
                      <?php for($j = 0; $j < 5; $j++) { 
                        if(!isset($words[$j]))
                          break; ?>
                          <p class="card-text"><?php echo $words[$j]; ?>&nbsp;</p>
                      <?php } ?>
                      <p>........</p>
                    </div>
                    <a style="color: #fff; text-decoration: none;" href="post-details.php?post_id=<?php echo $posts[$i][0] ?>">Read More</a>
                  </div>
                </div>
              </div>
          <?php } ?>
        </div>
        <br>
        <br>
        <ul class="pagination justify-content-center">
        <?php
          for($i = 1; $i <= ceil(count($allPosts)/$posts_limit); $i++)
          {
          echo "<li class='page-item'><a class='page-link' href='posts-list.php?page=$i'>$i</a></li>";
          }
        ?>
        </ul>
        </div>
      </div>
      <!--right-container ends-->

      <!--footer begins-->
      <div id="footer">
          <p class="footer-block">CMS &copy; CMS 2017</p>
      </div>
      <!--footer ends-->
      
    </div>
    <!--container-fluid ends-->

  </body>
  <!--body ends-->
</html>