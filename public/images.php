<!--Get data to populate the charts-->
<?php session_start(); ?>

<?php
  if(!isset($_SESSION['logo'])) {
    header("Location:../admin/controllers/data.php?request=logo-footer-siteurl&location=../../public/images.php");
    exit;
  }

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];
  $site_url = $_SESSION['site-url'];

  if(!isset($_SESSION['row'])) {
    header("Location: $site_url/admin/controllers/data.php?request=public-images");
    exit;
}

  $images = $_SESSION['row'];

  unset($_SESSION['row']);
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
    <link rel="stylesheet" href="<?php echo $site_url ?>/admin/resources/static/css/ihover.css">
    <script src="<?php echo $site_url ?>/admin/resources/static/js/jquery-1.6.1.min.js" ></script>
    <link rel="stylesheet" href="<?php echo $site_url ?>/admin/resources/static/css/prettyPhoto.css">
    <script src="<?php echo $site_url ?>/admin/resources/static/js/jquery.prettyPhoto.js"></script>
    <script src="<?php echo $site_url ?>/admin/resources/static/js/bootstrap.min.js" ></script>
  </head>
  <!--head ends-->


  <!--body begins-->
  <body>
    <!--container-fluid begins-->
    <div class="container-fluid">

      <nav class="navbar navbar-toggleable-md navbar-light" style="background-color: #222; height: 50px;">
        <a class="navbar-brand" href="index.php">
          <img src="<?php echo $site_url ?>/admin/resources/static/images/logo.png" width="30" height="30" alt="cms-logo">
        </a>
      </nav>

      <nav class="nav flex-column side-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Pages Viewport</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="images.php"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Images Viewport</a>
        </li>
      </nav>

      <!--right-container begins-->
      <div class="right-container" style="padding: 2%">
        <div class="row">
          <div class="col-sm-12">
              <h2 class="page-header">
                  Images
              </h2>
              <hr>
              <ol class="breadcrumb">
                  <li class="active">
                      <i class="fa fa-picture-o"></i> Images
                  </li>
              </ol>
          </div>
        </div>

        <br>
        <br>

        <?php for($i = 0; $i < ceil(count($images)/4); $i++) { 
          echo "<div class='row'>";

          for($j = 0; $j < 4; $j++) {

            if(!isset($images[$i * 4 + $j][0])) 
              break;

            echo "<div class='col-sm-3'>";
            echo "<div class='ih-item square effect7 img-fluid' style='max-width:100%;'>";
            echo "<a href='$site_url/admin/resources/static/images/uploads/{$images[$i * 4 + $j][0]}' rel='prettyPhoto[gallery3]'>";
            echo "<div class='img'><img src='$site_url/admin/resources/static/images/uploads/{$images[$i * 4 + $j][0]}'></div>";
            echo "<div class='info'>";
            echo "<h3>{$images[$i * 4 + $j][0]}</h3>";
            echo "</div>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
          }
          
          echo "</div>";
        }
      ?>

      </div>
      <!--right-container ends-->
    </div>
    <!--container-fluid ends-->
    
    <!--footer begins-->
    <div id="footer">
      <div class="container-fluid">
        <p class="footer-block">CMS &copy; CMS 2017</p>
      </div>
    </div>
    <!--footer ends-->

  <!--prettyPhoto script-->
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
      $("a[rel^='prettyPhoto']").prettyPhoto();
    });
  </script>

  </body>
  <!--body ends-->
</html>