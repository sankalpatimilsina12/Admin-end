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
  if(!isset($_SESSION['row'])) {
    header("Location: ../controllers/data.php?request=image-manager");
    exit;
  }

  $row = $_SESSION['row'];

  $page_row = $_SESSION['page_row'];

  unset($_SESSION['row']);
  unset($_SESSION['page_row']);

?>

<html lang="en">
  <!--head starts-->
  <?php require_once("head-components.php") ?>
  <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <div class="container-fluid">

      <nav class="navbar navbar-toggleable-md navbar-light" style="background-color: #222; height: 50px;">
        <a class="navbar-brand" href="index.php">
          <img src="../resources/static/images/logo.png" width="30" height="30" alt="cms-logo">
        </a>
      </nav>

      <nav class="nav flex-column side-nav">
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
      </nav>

      <div class="right-container" style="padding: 2%">

        <div class="row">
          <div class="col-sm-10">
              <h2 class="page-header">
                  Image Manager <small style="color: gray">Images Editing</small>
              </h2>
          </div>
          <div class="col-sm-2">
            <?php $_SESSION['page'] = $page_row; ?>
            <a role="button" class="btn btn-success" href="add-image.php">Add new image <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-sm-12">
          <ol class="breadcrumb">
              <li class="active">
                  <i class="fa fa-picture-o" aria-hidden="true"></i> Image Manager
              </li>
          </ol>
          </div>
        </div>

        <?php for($i = 0; $i < ceil(count($row)/3); $i++) {
          echo "<div class='row'>";

          for($j = 0; $j < 3; $j++) {

            if(!isset($row[3 * $i + $j][1]))
              break;
            

            echo "<div class='col-sm-4' style='padding: 2%'>";
            echo "<div class='card card-inverse' style='background-color:#ececd6;'>";
            echo "<img class'card-img-top style='width: 100%; height: 40%' src='../resources/static/images/uploads/{$row[3 * $i + $j][1]}' alt='img'>";
            echo "<div class='card-block' style='position: relative; height: 15%;'>";
            $row_id = $row[3 * $i + $j][0];
            echo "<a role='button' onclick = 'return confirm(\'Are you sure?\');' class='btn btn-danger col-sm-6' style='position: absolute; left: 25%; bottom: 25%;' href='../controllers/manager.php?request=imagemanager-delete&row_id=$row_id'>Delete</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }

          echo "</div>";
        }
        ?>
        <!--row ends-->

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
