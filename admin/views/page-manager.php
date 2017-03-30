<!--
  This is the main page for all page managing events like adding and editing pages.
  Takes the post request from the requesting page(ie. add, edit) and builds the
  corresponding database query to update the database.

  Populates the page with data from database.
-->


<?php require_once("../controllers/connection.php"); ?>

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
    header('Location: ../controllers/data.php?request=page-manager');
    exit;
  }

  $row = $_SESSION['row'];
  unset($_SESSION['row']);
?>

<html lang="en">
  <!--head begins-->
  <?php require_once("head-components.php") ?>
  <head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <div class="container">
      <h2 style="text-align:center; color: gainsboro">Page Manager</h2>
      <br>
      <br>
      <h3 id="page-list-title">Pages List</h3>
      <div class="row">
        <div class="col-sm-4">
          <div class="list-group">
            <a href="add-pages.php" class="list-group-item lleft">Add page</a>
            <a href="image-manager.php" class="list-group-item lleft">Image manager</a>
            <a href="dashboard.php" class="list-group-item lleft">Dashboard</a>
          </div>
        </div>
        <div class="col-sm-8">
          <table class="table table-striped">
            <thead>
              <tr id="header-row">
                <th>Index</th>
                <th>Title</th>
                <th>Content</th>
              </tr>
            </thead>
            <tbody>
                <?php
                  for($i = 0; $i < count($row); $i++) {
                    echo "<tr id='table-row'>";
                    for($j = 0; $j < 3; $j++) {
                      echo "<td>" . $row[$i][$j] . "</td>";
                    }
                    $row_id = $row[$i][$j-3];
                    echo "<td><a href='list-images.php?row_id=$row_id' style='color: yellow'>Images</a></td>";
                    echo "<td><a role='button' class='btn btn-large btn-success' href='edit-page.php?row_id=$row_id'>Edit</a></td>";
                    echo "<td><a role='button' onclick='return confirm(\"Are you sure?\");' class='btn btn-large btn-danger' href='../controllers/manager.php?request=pagemanager-delete&row_id=$row_id'>Delete</a></td>";
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