<!--
  This is the landing page for successfully logged in users/admin.

  If the user is admin as passed on the $_GET request, 'Admin Manager' can be accessed to update
  email/password in the database.
-->

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
  }
?>

<html lang="en">
  <!--head starts-->
  <?php require_once("../includes/head-components.php") ?>
  </head>
  <!--head ends-->

  <!--body starts-->
  <body>
    <div class="container">
      <div class="row" style="margin-top: 15%">
        <a style="text-decoration:none" id="page-manager" href="pagemanager.php" class="col-sm-6 left-container">
          <h3 class="dashboard-header">Page Manager</h3>
        </a>
        <a style="text-decoration:none" id="admin-manager" href="admin-manager.php" class="col-sm-6 right-container">
          <h3 class="dashboard-header">Admin Manager</h3>
        </a>
      </div>
      <div class="row">
        <a style="text-decoration:none" href="logged-out.php" class="col-sm-12 bottom-container">
          <h3 class="dashboard-header" style="padding-top: 5%">Logout</h3>
        </a>
      </div>
  </body>
  <!--body ends-->
</html>