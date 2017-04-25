
<!--
  The index page shows the basic site interface
  to public users.
-->

<?php require_once("../admin/controllers/site-contents.php") ?>
<?php require_once("../admin/controllers/connection.php");
    $db = new Connect; 
 ?>

<!--Get data to populate the charts-->
<?php session_start(); ?>

<?php

  $post_id = $_GET['post_id'];

  $query = "SELECT * FROM posts WHERE posts.id=$post_id";
  $result = mysqli_query($db->getConnection(), $query);
  $post_details = $result->fetch_all();

  logoFooterSiteUrl(); 

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];
  $site_url = $_SESSION['site-url'];

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
                  Post Details <small style="color: gray">View post</small>
              </h2>
              <hr>
              <ol class="breadcrumb">
                  <li class="active">
                      <i class="fa fa-info-circle"></i> Post Details
                  </li>
              </ol>
          </div>
        </div>
        <br>

        <table class="table table-bordered table-hover">
          <tbody>
            <tr class="table-active">
              <td><strong>Title: </strong><?php echo $post_details[0][1]; ?></td>
              <td><strong>Description: </strong><?php echo $post_details[0][1]; ?></td>
            </tr>
            <tr class="table-success">
              <td><strong>Seo Title: </strong><?php echo $post_details[0][2]; ?></td>
              <td><strong>Meta Title: </strong><?php echo $post_details[0][3]; ?></td>
            </tr>
            <tr class="table-danger">
              <td><strong>Meta Keywords: </strong><?php echo $post_details[0][4]; ?></td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-sm-12">
            <br>
            <ol class="breadcrumb">
              <li class="active">
                  <i class="fa fa-file-image-o"></i> Images
              </li>
            </ol>
          </div>
        </div>
        <?php
          $images = explode(",", $post_details[0][8]);
          array_pop($images);
          for($i = 0; $i < count($images); $i++) {
            echo "<img class='img img-thumbnail' style='width: 30%; height: 50%' alt='img' src='$site_url/admin/resources/static/images/uploads/$images[$i]'>";
          }
        ?>

        <br>
        <div class="row">
          <div class="col-sm-12" id="bar" style="width: 100%; height: 300px; background-color: "></div>
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