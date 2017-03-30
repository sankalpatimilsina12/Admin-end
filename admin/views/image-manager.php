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
            <form onsubmit="return isTitleSet();" action="../controllers/manager.php?request=imagemanager-upload" method="post" enctype="multipart/form-data">
              <label class="btn btn-default btn-file list-group-item lleft">
                  Add Image<input id="file" name="fileToUpload" type="file" style="display: none;">
              </label>
              <div class="form-group">
                <select class="form-control list-group-item lleft" id="page-select" style="display:none" name="page_title">
                  <?php for($i = 0; $i < count($page_row); $i++) {
                    echo "<option>{$page_row[$i][0]}</option>";
                  }
                  ?>
                </select>
              </div>
              <input type="submit" name="submit-btn" class="btn btn-default list-group-item lleft submit-btn" style="min-width: 100%">
            </form>
            <a href="page-manager.php" class="list-group-item lleft">Page manager</a>
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
                  for($i = 0; $i < count($row); $i++) {
                    echo "<tr id='table-row'>";
                    echo "<td>" . $row[$i][0] . "</td>";
                    $image = $db->getConnection()->real_escape_string($row[$i][1]);
                    echo "<td>.'<img id=\"table-images\" src=\"../resources/static/images/uploads/$image\" />'. </td>";
                    echo "<td>" . $row[$i][2] . "</td>";
                    $row_num = $row[$i][0];
                    echo "<td><a role='button' onclick='return confirm(\"Are you sure?\");' class='btn btn-large btn-danger col-sm-6' href='../controllers/manager.php?request=imagemanager-delete&row_id=$row_num'>Delete</a></td>";
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