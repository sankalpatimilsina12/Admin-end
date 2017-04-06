<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
    exit;
  }

  if(!isset($_SESSION['logo'])) {
    header("Location:../controllers/data.php?request=logo-footer&location=add-image.php");
    exit;
  }

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];

  unset($_SESSION['logo']);
  unset($_SESSION['footer']);
?>

<?php 
  $page_row = $_SESSION['page'];
?>

<html lang="en">
  <!--head starts-->
  <?php require_once("head-components.php") ?>
  <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
  </head>
  <!--head ends-->

  <!--body starts-->
  <body>
    <!--container begins-->
    <div class="container-fluid">

      <nav class="navbar navbar-toggleable-md navbar-light" style="background-color: #222; height: 50px;">
        <a class="navbar-brand" href="index.php">
          <img src="../resources/static/images/uploads/<?php echo $logo; ?>" width="30" height="30" alt="cms-logo">
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
            <a class="nav-link" href="dashboard.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="page-manager.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Page Manager</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="image-manager.php"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Image Manager</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin-manager.php"><i class="fa fa-male" aria-hidden="true"></i>&nbsp;&nbsp;Admin Manager</a>
          </li>
        </div>
      </nav>

      <div class="right-container" style="padding: 2%">

        <div class="row">
          <div class="col-sm-10">
              <h2 class="page-header">
                  Add Image
              </h2>
          </div>
        </div>

        <hr>
        <br>

        <form class="form-horizontal" onsubmit="return isImageLoaded();" role="form" method="post" action="../controllers/manager.php?request=imagemanager-upload" enctype="multipart/form-data">
          <div class="form-group">
            <label class="btn btn-primary" style="width: 100%">
                <span id="add-image">Add Image</span><input id="file" name="fileToUpload" type="file" style="display: none;">
            </label>
            <div class="form-group">
              <select class="form-control" id="page-select" name="page_title">
                <?php for($i = 0; $i < count($page_row); $i++) {
                  echo "<option>{$page_row[$i][0]}</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group"> 
            <div class="row">
              <div class="col-sm-6">
                <button id="add-button" class="btn btn-success" style="width: 100%" type="submit">Add</button>
              </div>
              <div class="col-sm-6">
                <a id="cancel-button" class="btn btn-large btn-warning" style="width: 100%" role="button" href="image-manager.php">Cancel</a>
              </div>
            </div>
          </div>

        </form>

        <div style="text-align: center">
          <img src="" alt="No Image Selected" id="selected-image" class="img-fluid" style="padding: 4%; width: 40%; height: 60%">
        </div>

      </div>
      <!--right-container ends-->

      <!--footer begins-->
      <div id="footer">
          <p class="footer-block"><?php echo $footer ?></p>
      </div>
      <!--footer ends-->

    </div>
    <!--container ends-->
  </body>
  <!--body ends-->
</html>

<!--Listen for the file upload event to whether display page-id box-->
<script>
  document.getElementById("file").onchange = function () {
    document.getElementById("add-image").innerHTML = "Image Loaded."
    var imageName = document.getElementById("file").value.substr(12);
    document.getElementById("selected-image").src = "../resources/static/images/uploads/" + imageName;
  }
</script>

<!--Listen for the file upload event-->
<script>
  function isImageLoaded() {

    if(document.getElementById("file").value == "") {
      document.getElementById("add-image").innerHTML = "Please select image to upload.";

      return false;
    }

    return true;
  }
</script>