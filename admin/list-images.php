<!--
  This page shows all the images belonging to particular
  row(or page) in the pages table.
-->

<?php require_once("includes/connection.php") ?>

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
    exit;
  }
?>

<?php
  $row_id = $_GET['row_id'];
  $db = new Connect;
  $query = "SELECT id, image FROM images WHERE page_id=$row_id";
  $result = mysqli_query($db->getConnection(), $query);
  $row = $result->fetch_all();
?>

<html lang="en">
  <!--head starts-->
  <?php require_once("includes/head-components.php") ?>
  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <div class="container">
      <h2 id="images-list">Images</h2>
      <br>
      <br>
      <div class="row">
        <div class="col-sm-4">
          <div class="list-group">
            <a href="pagemanager.php" class="list-group-item lleft">Page manager</a>
            <a href="imagemanager.php" class="list-group-item lleft">Image manager</a>
            <a href="dashboard.php" class="list-group-item lleft">Dashboard</a>
          </div>
        </div>
        <div class="col-sm-8">
          <table class="table table-striped">
            <thead>
            </thead>
            <tbody>
                <?php
                  for($i = 0; $i < $result->num_rows; $i++) {
                    echo "<tr id='table-row'>";
                    $image = $db->getConnection()->real_escape_string($row[$i][1]);
                    echo "<td>.'<img id=\"table-images\" src=\"images/uploads/$image\" />'. </td>";
                    $image_row_id = $row[0][0];
                    echo "<td><a role='button' class='btn btn-danger' href='delete-pages-images.php?request=list-images&image_row_id=$image_row_id&row_id=$row_id'>Delete</a></td>";
                    echo "</tr>";
                  }
                ?>
            </tbody>
          </table>
        </div>
      </div>
      <br>
      <br>
      <form onsubmit="return isImageAdded();" action="upload-image.php?request=list-images&row_id=<?php echo $row_id ?>" method="post" enctype="multipart/form-data">
        <label class="btn btn-default btn-file list-group-item lleft">
            <span id="add-image">Add Image</span><input id="file" name="fileToUpload" type="file" style="display: none;">
        </label>
        <p id="error-message" class="list-group-item" style="display:none"></p>
        <input type="submit" name="submit-btn" class="btn btn-default list-group-item lleft submit-btn" style="min-width: 100%">
      </form>
    </div>
  </body>
  <!--body ends-->
</html>



<!--Show image loaded on load-->
<script>
document.getElementById("file").onchange = function () {
  document.getElementById("add-image").innerHTML = "Image loaded";
}
</script>


<!--Checks if the image was added-->
<script>
  function isImageAdded() {
    if(document.getElementById("file").value == "") {
      document.getElementById("error-message").style.display = "block";
      document.getElementById("error-message").innerHTML = "Select image to upload";
      return false;
    } 
    return true;
  }
</script>