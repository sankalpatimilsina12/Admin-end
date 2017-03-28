<!--
  This is the landing page for successfully logged in users/admin.

  If the user is admin as passed on the $_GET request, 'Admin Manager' can be accessed to update
  email/password in the database.
-->

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
    exit;
  }
?>

<html lang="en">
  <!--head starts-->
  <?php require_once("includes/head-components.php") ?>
  </head>
  <!--head ends-->

  <!--body starts-->
  <body>
    <div class="container-fluid">
      <h3 style="text-align:center; color:gainsboro; margin-top: 5%;">Welcome to dashboard</h3>
      <div class="list-group" style="margin-top: 5%">
        <a href="pagemanager.php" class="list-group-item lleft">Page manager</a>
        <a href="admin-manager.php" class="list-group-item lleft">Admin manager</a>
        <a href="logged-out.php" class="list-group-item lleft">Logout</a>
      </div>
  </body>
  <!--body ends-->
</html>