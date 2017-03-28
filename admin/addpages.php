<!--
This page displays a page add form used to submit new page details to
the page-manager which then creates the specified new page in the database.
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
    <div class="container">
      <form class="form-horizontal center-div" onsubmit="return validate();" novalidate="novalidate" role="form" method="post" action="pagemanager.php?request=addpages">
        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Title:</label>
          <div class="col-sm-10">
            <input class="form-control" id="title" name="title" placeholder="Enter title">
            <p id="title-error"></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="comment">Content:</label>
          <div class="col-sm-10">
            <textarea class="form-control" rows="5" id="text" name="content" placeholder="Enter text"></textarea>
            <p id="text-error"></p>
          </div>
        </div>
        <div class="form-group"> 
          <div class="row col-sm-10">
            <div class="col-sm-offset-2 col-sm-2 hand-button">
              <button id="add-button" class="btn btn-large btn-primary" type="submit">Add</button>
            </div>
            <div class="col-sm-offset-2 col-sm-3 hand-button">
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