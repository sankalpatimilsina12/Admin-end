<!--
This page displays a page edit form used to submit edited page details to
the page-manager which then edits(updates) the specified page in the database.
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
$query = "SELECT title, text FROM pages WHERE id=$row_id";
$result = mysqli_query($db->getConnection(), $query);
$row = $result->fetch_all();
?>

<html lang="en">
  <!--head begins-->
  <?php require_once("includes/header.php") ?>
  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <div class="container">
      <form onsubmit="return validate();" class="form-horizontal center-div" novalidate="novalidate" role="form" method="post" action="pagemanager.php?request=editpages&row_id=<?php echo $row_id ?>">
        <div class="form-group">
          <label class="control-label col-sm-2">Title:</label>
          <div class="col-sm-10">
            <input class="form-control" id="title" name="title" value="<?php echo $row[0][0]; ?>">
            <p id="title-error"></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2">Content:</label>
          <div class="col-sm-10">
            <textarea class="form-control" rows="5" id="text" name="content"><?php echo $row[0][1]; ?></textarea>
            <p id="text-error"></p>
          </div>
        </div>
        <div class="form-group"> 
          <div class="row col-sm-10">
            <div class="col-sm-offset-2 col-sm-3 hand-button">
              <button id="add-button" class="btn btn-large btn-primary" type="submit">Update</button>
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


  <!--validation script-->
  <script>
    function validate() {
      document.getElementById("title-error").innerHTML = "";
      document.getElementById("text-error").innerHTML = "";

      var flag = true;

      if(document.getElementById("title").value == "") {
        document.getElementById("title-error").innerHTML = "Title field empty!";
        flag = false;
      }

      if(document.getElementById("text").value == "") {
        document.getElementById("text-error").innerHTML = "Text field empty!";
        flag = false;
      }

      return flag;
    }
  </script>