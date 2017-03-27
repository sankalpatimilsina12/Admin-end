<!--
This page displays a email/password edit form used to submit edited form details to
the admin-manager which then edits(updates) the specified user in the database.
-->

<?php require_once("includes/connection.php") ?>

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:not-logged.php");
  }
?>

<?php
$db = new Connect();
$row_id = $_GET['row_id'];
$query = "SELECT email, password FROM users WHERE id=$row_id";
$result = mysqli_query($db->getConnection(), $query);
$row = $result->fetch_all();
?>

<html lang="en">
  <!--head begins-->
  <?php require_once("includes/header.php") ?>
  <script src="js/validate.js"></script>
  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <div class="container">
      <form class="form-horizontal center-div" onsubmit="return validate();" novalidate="novalidate" role="form" method="post" action="admin-manager.php?row_id=<?php echo $row_id ?>">
        <div class="form-group">
          <label class="control-label col-sm-2">Email:</label>
          <div class="col-sm-10">
            <input class="form-control" id="email" name="email" value="<?php echo $row[0][0]; ?>">
            <p id="email-error-message"></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2">Password:</label>
          <div class="col-sm-10">
            <input class="form-control" id="password" name="password" value="<?php echo $row[0][1]; ?>">
            <p id="password-error-message"></p>
          </div>
        </div>
        <div class="form-group"> 
          <div class="row col-sm-10">
            <div class="col-sm-offset-2 col-sm-3 hand-button">
              <button class="btn btn-large btn-primary" type="submit">Update</button>
            </div>
            <div class="col-sm-offset-2 col-sm-2 hand-button">
              <a id="cancel-button" class="btn btn-large btn-warning" role="button" href="pagemanager.php">Cancel</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </body>
  <!--body ends-->
  </html>