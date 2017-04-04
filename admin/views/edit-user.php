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
  if(!isset($_SESSION['row'])) {
    $row_id = $_GET['row_id'];
    header("Location: ../controllers/data.php?request=edit-user&row_id=$row_id");
    exit;
  }
  $row_id = $_GET['row_id'];
  $row = $_SESSION['row'];
  unset($_SESSION['row']);
?>

<html lang="en">
  <!--head begins-->
  <?php require_once("head-components.php") ?>
  <script src="../resources/static/js/validate.js"></script>
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
        <li class="nav-item">
          <a class="nav-link" href="image-manager.php"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Image Manager</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="admin-manager.php"><i class="fa fa-male" aria-hidden="true"></i>&nbsp;&nbsp;Admin Manager</a>
        </li>
      </nav>

      <div class="right-container" style="padding: 2%">

        <div class="row">
          <div class="col-sm-10">
              <h2 class="page-header">
                 Edit User 
              </h2>
          </div>
        </div>

        <hr>
        <br>

        <form class="form-horizontal" onsubmit="return validate();" novalidate="novalidate" role="form" method="post" action="../controllers/manager.php?request=edit-user&row_id=<?php echo $row_id ?>">
          <div class="form-group">
            <label class="control-label col-sm-2" for="email"><strong>Email:</strong></label>
            <div class="col-sm-12">
              <input class="form-control" id="email" name="email" value="<?php echo $row[0][0]; ?>">
              <p id="email-error-message"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2"><strong>Password:</strong></label>
            <div class="col-sm-12">
              <input class="form-control" id="password" name="password" placeholder="Enter password"></input>
              <p id="password-error-message"></p>
            </div>
          </div>
          <div class="form-group" style="padding: 1%"> 
            <div class="row">
              <div class="col-sm-6">
                <button id="add-button" class="btn btn-large btn-primary" style="width: 100%" type="submit">Update</button>
              </div>
              <div class="col-sm-6">
                <a id="cancel-button" class="btn btn-large btn-warning" style="width: 100%" role="button" href="admin-manager.php">Cancel</a>
              </div>
            </div>
          </div>
        </form>

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