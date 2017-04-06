
<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
    exit;
  }

  if(!isset($_SESSION['logo'])) {
    header("Location:../controllers/data.php?request=logo-footer&location=settings.php");
    exit;
  }

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];

  unset($_SESSION['logo']);
  unset($_SESSION['footer']);
?>

<html lang="en">
  <!--head begins-->
    <?php require_once("head-components.php") ?>
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
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
          <li class="nav-item">
            <a class="nav-link" href="image-manager.php"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Image Manager</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin-manager.php"><i class="fa fa-male" aria-hidden="true"></i>&nbsp;&nbsp;Admin Manager</a>
          </li>
        </div>
      </nav>

      <div class="right-container" style="padding: 2%">
        <div class="row">
          <div class="col-sm-12">
              <h2 class="page-header">
                Settings
              </h2>
              <hr>
              <ol class="breadcrumb">
                  <li class="active">
                      <i class="fa fa-cog" aria-hidden="true"></i> Settings
                  </li>
              </ol>
          </div>
        </div>
      
        
        <div class="row" style="padding: 2%">
          <div class="col-sm-6" style="padding: 1%">

            <form class="form-horizontal" onsubmit="return isImageLoaded();" role="form" method="post" action="../controllers/manager.php?request=settings-logo" enctype="multipart/form-data">
            
              <i class="fa fa-cogs" style="padding-bottom: 5%"><span class="settings-text"><strong> Change Site Logo</strong></span></i>

              <div class="form-group">
                <label class="btn btn-success" style="width: 100%">
                    <span id="add-image">Add Image</span><input id="file" name="fileToUpload" type="file" style="display: none;">
                </label>
              </div>

              <div class="form-group"> 
                <div class="row">
                  <div class="col-sm-12">
                    <button id="add-button" class="btn btn-primary" style="width: 100%" type="submit">Update</button>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <div class="col-sm-6" style="padding: 1%">
            <form onsubmit="return validate();" class="form-horizontal" novalidate="novalidate" role="form" method="post" action="../controllers/manager.php?request=settings-footer">

              <i class="fa fa-cogs" style="padding-bottom: 5%"><span class="settings-text"><strong> Change Footer</strong></span></i>

              <div class="form-group">
                <div class="col-sm-12">
                  <input class="form-control" id="footer-text" name="footer" placeholder="Enter footer text">
                  <p id="footer-error" style="color: green; padding: 1% 0 0 1%"></p>
                </div>
              </div>
              <div class="form-group"> 
                <div class="row" style="padding: 1%">
                  <div class="col-md-12">
                    <button id="add-button" class="btn btn-primary" style="width: 100%" type="submit">Update</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
            
        </div>
        <!--row ends-->
      </div>
      <!--right-container ends-->

      <!--footer begins-->
      <div id="footer">
          <p class="footer-block"><?php echo $footer ?></p>
      </div>
      <!--footer ends-->
    </div>
  </body>
</html>


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

<!--Validation script-->
<script>
  function validate() {

    if(document.getElementById("footer-text").value == "") {
      document.getElementById("footer-error").innerHTML = "Footer cannot be empty!";

      return false;
    }

    return true;
  }
</script>