<!--
  This is the main page for all page managing events like adding and editing pages.
  Takes the post request from the requesting page(ie. add, edit) and builds the
  corresponding database query to update the database.

  Populates the page with data from database.
-->


<?php require_once("../includes/connection.php"); ?>

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
  }
?>

<?php
  $db = new Connect();

  if(isset($_GET['request'])) {
    $title = $db->getConnection()->real_escape_string($_POST['title']);
    $content = $db->getConnection()->real_escape_string($_POST['content']);

    switch($_GET['request']) {
      case 'addpages':
                  $query = "INSERT INTO pages (title, text) VALUES ('$title', '$content')";
                  break;

      case 'editpages':
                  $row_id = (int)$_GET['row_id'];
                  $query = "UPDATE pages SET title='$title', text='$content' WHERE id=$row_id";
                  break;
    }

    $result = mysqli_query($db->getConnection(), $query);
  }

  $query = "SELECT id, title, text FROM pages";
  $result = mysqli_query($db->getConnection(), $query);
  $row = $result->fetch_all();
?>

<html lang="en">
  <!--head begins-->
  <?php require_once("../includes/head-components.php") ?>
  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <div class="container">
      <h2 id="page-manager">Page Manager</h2>
      <br>
      <br>
      <h3 id="page-list-title">Pages List</h3>
      <div class="row">
        <div class="col-sm-4">
          <div class="list-group">
            <a href="addpages.php" class="list-group-item lleft">Add page</a>
            <a href="imagemanager.php" class="list-group-item lleft">Image manager</a>
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
                  for($i = 0; $i < $result->num_rows; $i++) {
                    echo "<tr id='table-row'>";
                    for($j = 0; $j < 3; $j++) {
                      echo "<td>" . $row[$i][$j] . "</td>";
                    }
                    $row_id = $row[$i][$j-3];
                    echo "<td><a href='list-images.php?row_id=$row_id' style='color: yellow'>Images</a></td>";
                    echo "<td><a role='button' class='btn btn-large btn-success' href='editpages.php?row_id=$row_id'>Edit</a></td>";
                    echo "<td><a role='button' onclick='return confirm(\"Are you sure?\");' class='btn btn-large btn-danger' href='delete-pages-images.php?request=pagemanager&row_id=$row_id'>Delete</a></td>";
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