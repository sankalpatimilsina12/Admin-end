<?php require_once("../admin/controllers/connection.php") ?>

<?php
  $db = new Connect();
?>

<?php
  if(isset($_POST['page_id'])) {
    $page_id = $_POST['page_id'];

    $query = "SELECT id, title, text, parent_id FROM pages";
    $result = mysqli_query($db->getConnection(), $query);
    $pages = $result->fetch_all();


    for($i = 0; $i < ceil(count($pages)/3); $i++) {
      echo "<div class='row'>";

      for($j = 0; $j < 3; $j++) {

        if(!isset($pages[3 * $i + $j][0]))
          break;
        
        if($pages[3 * $i + $j][0] == $page_id || $pages[3 * $i + $j][3] == $page_id) {
          echo "<div class='col-sm-12' style='padding: 2%'>";
          echo "<div class='card card-inverse' style='background-color:#333;'>";
          echo "<div class='card-block' style='position: relative; height: 40%;'>";
          echo "<h3 class='card-title'>{$pages[3 * $i + $j][1]}</h3>";
          echo "<p class='card-text'>{$pages[3 * $i + $j][2]}</p>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
        }
      }

      echo "</div>";
    // row ends
    }
  }

  if(isset($_POST['sel_id'])) {
    $sel_id = $_POST['sel_id'];

    $query = "SELECT name FROM states WHERE country_id=$sel_id";
    $result = mysqli_query($db->getConnection(), $query);
    $states = $result->fetch_all();

    echo json_encode($states);
  }
  ?>