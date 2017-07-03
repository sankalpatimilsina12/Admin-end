
<!--
  This page allows users/admin to edit/update the existing
  page in the pages database.
-->

<?php require_once("../controllers/site-contents.php") ?>
<?php require_once("../controllers/connection.php") ?>

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
    exit;
  }
?>

<!--Get data to populate the page-->
<?php

  $row_id = $_GET['row_id'];

  logoFooterSiteUrl();

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];
  $site_url = $_SESSION['site-url'];

  $db = new Connect;
  $row_id = $_GET['row_id'];
  $query = "SELECT title, content, seo_title, meta_title, meta_keywords FROM posts";
  $result = mysqli_query($db->getConnection(), $query);
  $row = $result->fetch_all();

  unset($_SESSION['logo']);
  unset($_SESSION['footer']);
  unset($_SESSION['site-url']);

?>

<html lang="en">
  <!--head begins-->
  <?php require_once("head-components.php") ?>
    <script src="<?php echo $site_url ?>/admin/resources/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="<?php echo $site_url ?>/admin/resources/font-awesome/css/font-awesome.min.css">
  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <div class="container-fluid">

      <nav class="navbar navbar-toggleable-md navbar-light" style="background-color: #222; height: 50px;">
        <a class="navbar-brand" href="index.php">
          <img src="<?php echo $site_url ?>/admin/resources/static/images/uploads/<?php echo $logo; ?>" width="30" height="30" alt="cms-logo">
        </a>

        <a href="logged-out.php" class="logout">
          <i class="fa fa-sign-out" aria-hidden="true"><span class="logout-text"> Log Out</span></i>
        </a>

        <a href="settings.php" class="settings">
          <i class="fa fa-cog" aria-hidden="true"><span class="settings-text"> Settings</span></i>
        </a>
      </nav>

      <nav class="navbar navbar-toggleable-md">
        <button class="navbar-toggler navbar-top-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars" aria-hidden="true"></i>
        </button>

        <div class="collapse navbar-collapse flex-column side-nav" id="navbarSupportedContent">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $site_url ?>/admin/views/dashboard.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $site_url ?>/admin/views/page-manager.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Page Manager</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $site_url ?>/admin/views/image-manager.php"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Image Manager</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="post-manager.php"><i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp;Post Manager</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="slider-manager.php"><i class="fa fa-sliders" aria-hidden="true"></i>&nbsp;Slider Manager</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="newsletter-subscribers.php"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Newsletter Subscribers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $site_url ?>/admin/views/admin-manager.php"><i class="fa fa-male" aria-hidden="true"></i>&nbsp;&nbsp;Admin Manager</a>
          </li>
        </div>
      </nav>

      <div class="right-container" style="padding: 2%">

        <div class="row">
          <div class="col-sm-10">
              <h2 class="page-header">
                 Edit Page 
              </h2>
          </div>
        </div>

        <hr>
        <br>

        <form class="form-horizontal" onsubmit="return validate();" novalidate="novalidate" role="form" method="post" action="../controllers/manager.php?request=editpost&row_id=<?php echo $row_id; ?>" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label col-sm-6"><strong>Title:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" id="title" name="title" value=<?php echo $row[0][0]; ?>>
                  <p id="title-error" style="color: green"></p>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><strong>Content:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" id="content" name="content" value=<?php echo $row[0][1]; ?>>
                  <p id="content-error" style="color: green"></p>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><strong>Seo Title:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" id="seo-title" name="seo-title" value=<?php echo $row[0][2]; ?>>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label col-sm-6"><strong>Meta Title:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" id="meta-title" name="meta-title" value=<?php echo $row[0][3]; ?>>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><strong>Meta Keywords:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" id="meta-keywords" name="meta-keywords" value=<?php echo $row[0][4]; ?>>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><strong>Select Images:</strong></label>
                <div class="col-sm-12">
                  <label class="btn" style="background-color: #d3d3d3; width: 100%">
                      <span id="add-image">Add Images</span><input id="file" name="filesToUpload[]" type="file" style="display: none;" multiple>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" style="padding-top: 7%"> 
            <div class="row">
              <div class="col-sm-6">
                <div class="col-sm-12">
                  <button id="add-button" class="btn btn-primary" style="width: 100%" type="submit">Update</button>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="col-sm-12">
                  <a id="cancel-button" class="btn btn-warning" style="width: 100%" role="button" href="post-manager.php">Cancel</a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!--right-container ends-->

      <!--footer begins-->
      <div id="footer">
          <p class="footer-block"><?php echo $footer ?></p>
      </div>
      <!--footer ends-->

    </div>
    <!--container-fluid ends-->
    <!--validation script-->
    <script>
      function validate() {
        document.getElementById("title-error").innerHTML = "";
        document.getElementById("content-error").innerHTML = "";

        var flag = true;

        if(document.getElementById("title").value == "") {
          document.getElementById("title-error").innerHTML = "Title field empty!";
          flag = false;
        }

        if(document.getElementById("content").value == "") {
          document.getElementById("content-error").innerHTML = "Text field empty!";
          flag = false;
        }

        return flag;
      }
    </script>
  </body>
  <!--body ends-->
</html>
