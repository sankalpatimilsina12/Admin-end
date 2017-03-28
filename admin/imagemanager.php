<?php require_once("../includes/connection.php") ?>


<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
  }
?>

<!--Load all images from the database into result object-->
<?php
    $db = new Connect;
    $query = "SELECT id, image, page_id FROM images";
    $result = mysqli_query($db->getConnection(), $query);
    $row = $result->fetch_all();

    $query = "SELECT id FROM pages";
    $result_page = mysqli_query($db->getConnection(), $query);
    $page_id = $result_page->fetch_all();
?>

<html lang="en">
  <!--head starts-->
  <?php require_once("../includes/head-components.php") ?>
  </head>
  <!--head ends-->

  <!--body starts-->
  <body>
    <div class="container">
      <h2 id="image-manager">Image Manager</h2>
      <br>
      <br>
      <h3 id="image-list-title">Images List</h3>
      <div class="row">
        <div class="col-sm-4">
          <div class="list-group">
            <form onsubmit="return isTitleSet()" action="upload-image.php?request=imagemanager" method="post" enctype="multipart/form-data">
              <label class="btn btn-default btn-file list-group-item lleft">
                  Add Image<input id="file" name="fileToUpload" type="file" style="display: none;">
              </label>
              <div class="form-group">
                <select class="form-control list-group-item lleft" id="page-select" style="display:none" name="page_id">
                  <?php for($i = 0; $i < $result_page->num_rows; $i++) {
                    echo "<option>{$page_id[$i][0]}</option>";
                  }
                  ?>
                </select>
              </div>
              <input type="submit" name="submit-btn" class="btn btn-default list-group-item lleft submit-btn" style="min-width: 100%">
            </form>
            <a href="pagemanager.php" class="list-group-item lleft">Page manager</a>
            <a href="dashboard.php" class="list-group-item lleft">Dashboard</a>
            <p id="error-message" class="list-group-item" style="display:none"></p>
          </div>
        </div>
        <div class="col-sm-8">
          <table class="table table-striped">
            <thead>
              <tr id="header-row">
                <th>Index</th>
                <th>Image</th>
                <th>Page Index</th>
              </tr>
            </thead>
            <tbody>
                <?php
                  for($i = 0; $i < $result->num_rows; $i++) {
                    echo "<tr id='table-row'>";
                    echo "<td>" . $row[$i][0] . "</td>";
                    $image = $db->getConnection()->real_escape_string($row[$i][1]);
                    echo "<td>.'<img id=\"table-images\" src=\"../images/uploads/$image\" />'. </td>";
                    echo "<td>" . $row[$i][2] . "</td>";
                    $row_num = $row[$i][0];
                    echo "<td><a role='button' onclick='return confirm(\"Are you sure?\");' class='btn btn-large btn-danger col-sm-6' href='delete-pages-images.php?request=imagemanager&row_id=$row_num'>Delete</a></td>";
                    echo "</tr>";
                  }
                ?>
            </tbody>
          </table>
        </div>
    </div>
  </body>
  <!--body ends-->
</html>

<!--Listen for the file upload event to whether display page-id box-->
<script>
  document.getElementById("file").onchange = function () {
    document.getElementById("page-select").style.display = "block";
    if(document.getElementById("error-message").style.display == "block") {
      document.getElementById("error-message").style.display = "none";
    }
  };
</script>

<!--Check if title field was set otherwise display error message-->
<script>
  function isTitleSet() {
    var message;

    if(document.getElementById("page-select").value != "") {
      return true;
    }

    if(document.getElementById("page-select").style.display == "none") {
      message = "Select image to upload!";
    } else {
      message = "Enter page ID";
    }

    document.getElementById("error-message").innerHTML = message; 
    document.getElementById("error-message").style.display = "block";

    return false;
  }
</script>