<!--
  This page shows all the images belonging to particular
  row(or page) in the pages table.
-->

<?php require_once("../controllers/connection.php") ?>
<?php $db = new Connect; ?>

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
    exit;
  }
?>

<?php
  $row_id = $_GET['row_id'];

  if(!isset($_SESSION['logo'])) {
    header("Location: ../controllers/data.php?request=logo-footer-siteurl&location=list-images.php&row_id=$row_id");
    exit;
  }

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];
  $site_url = $_SESSION['site-url'];

  if(!isset($_SESSION['row'])) {
    header("Location: $site_url/admin/controllers/data.php?request=list-images&row_id=$row_id");
    exit;
  }

  $row = $_SESSION['row'];

  unset($_SESSION['row']);
  unset($_SESSION['logo']);
  unset($_SESSION['footer']);
  unset($_SESSION['site-url']);


?>

<html lang="en">
  <!--head starts-->
    <?php require_once("head-components.php") ?>
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
            <a class="nav-link" href="dashboard.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a>
          </li>
          <li class="nav-item active">
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
          <div class="col-sm-10">
              <h2 class="page-header">
                  Images
              </h2>
          </div>
          <div class="col-sm-2">
            <form class="form-horizontal" id="image-submit-form" role="form" method="post" action="<?php echo $site_url ?>/admin/controllers/manager.php?request=list-images-upload&row_id=<?php echo $row_id ?>" enctype="multipart/form-data">
              <div class="form-group">
                <label class="btn btn-success" style="cursor: pointer">
                    <span id="add-image">Add new image <i class="fa fa-plus-circle" aria-hidden="true"></i></span><input id="file" name="fileToUpload" type="file" style="display: none;">
                </label>
              </div>
            </form>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-sm-12">
          <ol class="breadcrumb">
              <li class="active">
                  <i class="fa fa-picture-o" aria-hidden="true"></i> Images
              </li>
          </ol>
          </div>
        </div>

        <?php for($i = 0; $i < ceil(count($row)/3); $i++) { 
          echo "<div class='row'>";

          for($j = 0; $j < 3; $j++) {

            if(!isset($row[3 * $i + $j][0]))
              break;
            

            echo "<div class='col-sm-4' style='padding: 2%'>";
            echo "<div class='card card-inverse' style='background-color:#ececd6;'>";
            echo "<img class'card-img-top style='width: 100%; height: 40%' src='$site_url/admin/resources/static/images/uploads/{$row[3 * $i + $j][1]}' alt='img'>";
            echo "<div class='card-block' style='position: relative; height: 15%;'>";
            $image_row_id = $row[3 * $i + $j][0];
            echo "<a role='button' onclick = 'return confirm(\'Are you sure?\');' class='btn btn-danger col-sm-6' style='position: absolute; left: 25%; bottom: 25%;' href='$site_url/admin/controllers/manager.php?request=list-images-delete&image_row_id=$image_row_id&row_id=$row_id'>Delete</a>";
            echo "</div>";
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
  </body>
  <!--body ends-->
</html>



<!--Show image loaded on load-->
<script>
document.getElementById("file").onchange = function () {
  document.getElementById("image-submit-form").submit();
}
</script>