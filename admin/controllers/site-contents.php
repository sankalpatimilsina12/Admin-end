<?php require_once('connection.php') ?>

<?php

  function logoFooterSiteUrl() {
    $db = new Connect;
    $query = "SELECT logo, footer, siteurl FROM settings";
    $result = mysqli_query($db->getConnection(), $query);
    $row = $result->fetch_all();

    $_SESSION['logo'] = $row[0][0];
    $_SESSION['footer'] = $row[1][1];
    $_SESSION['site-url'] = $row[2][2];
  }
?>