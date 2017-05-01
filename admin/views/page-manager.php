<!--
  Page Manager shows all the users' created pages
  with different page editing options.
-->


<?php require_once("../controllers/site-contents.php") ?>
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
  logoFooterSiteUrl();

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];
  $site_url = $_SESSION['site-url'];

  $db = new Connect;
  $query = "SELECT id, title, text, parent_id FROM pages WHERE pages.parent_id != -2";
  $result = mysqli_query($db->getConnection(), $query);
  $non_footer_pages = $result->fetch_all();


  $query = "SELECT id, title, text, parent_id FROM pages WHERE pages.parent_id = -2";
  $result = mysqli_query($db->getConnection(), $query);
  $footer_pages = $result->fetch_all();

  unset($_SESSION['logo']);
  unset($_SESSION['footer']);
  unset($_SESSION['site-url']);
?>

<html lang="en">
  <!--head begins-->
    <?php require_once("head-components.php") ?>
    <link rel="stylesheet" href="<?php echo $site_url ?>/admin/resources/font-awesome/css/font-awesome.min.css">
  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <div class="container-fluid">

      <nav class="navbar navbar-toggleable-md navbar-light" style="background-color: #222; height: 50px;">
        <a class="navbar-brand" href="index.php">
          <img src="<?php echo $site_url ?>/admin/resources/static/images/uploads/<?php echo $logo; ?>" width="30" height="30" alt="cms-logo">
        </a>

        <a href="logged-out.php" class="logout">
          <i class="fa fa-sign-out" aria-hidden="true"><span class="logout-text"> Log Out</span></i>
        </a>

        <a href="settings.php" class="settings">
          <i class="fa fa-cog" aria-hidden="true"><span class="settings-text"> Settings</span></i>
        </a>
      </nav>

      <nav class="navbar navbar-toggleable-md">
        <button class="navbar-toggler navbar-top-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars" aria-hidden="true"></i>
        </button>

        <div class="collapse navbar-collapse flex-column side-nav" id="navbarSupportedContent">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="page-manager.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Page Manager</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="image-manager.php"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Image Manager</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="post-manager.php"><i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp;Post Manager</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="slider-manager.php"><i class="fa fa-sliders" aria-hidden="true"></i>&nbsp;Slider Manager</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="newsletter-subscribers.php"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Newsletter Subscribers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin-manager.php"><i class="fa fa-male" aria-hidden="true"></i>&nbsp;&nbsp;Admin Manager</a>
          </li>
        </div>
      </nav>

      <div class="right-container" style="padding: 2%">

        <div class="row">
          <div class="col-sm-10">
              <h2 class="page-header">
                  Page Manager <small style="color: gray">Pages Editing</small>
              </h2>
          </div>
          <div class="col-sm-2">
            <a role="button" class="btn btn-success" href="add-pages.php">Add new page <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-sm-12">
          <ol class="breadcrumb">
              <li class="active">
                  <i class="fa fa-file-text-o" aria-hidden="true"></i> Page Manager
              </li>
          </ol>
          </div>
        </div>

        <?php 
          for($i = 0; $i < ceil(count($non_footer_pages)/3); $i++) {
          echo "<div class='row'>";

          for($j = 0; $j < 3; $j++) {

            if(!isset($non_footer_pages[3 * $i + $j][1]))
              break;
            
            if($non_footer_pages[3 * $i + $j][3] == -2)
              continue;

            $page_box_id = 3 * $i + $j;

            echo "<div id=\"$page_box_id\" class='col-sm-4' style='padding: 2%'>";
            echo "<div class='card card-inverse' style='background-color:#333;'>";
            echo "<div class='card-block' style='position: relative; height: 40%;'>";
            echo "<h3 class='card-title'>{$non_footer_pages[3 * $i + $j][1]}</h3>";
            echo "<p class='card-text'>{$non_footer_pages[3 * $i + $j][2]}</p>";
            $row_id = $non_footer_pages[3 * $i + $j][0];
            echo "<a role='button' class='btn btn-primary' style='position: absolute; bottom:6%;' href='edit-page/$row_id'>Edit page</a>";
            echo "&nbsp;&nbsp;&nbsp;&nbsp;";
            // echo "<a role='button' onclick = 'return confirm(\'Are you sure?\');' class='btn btn-danger' style='position: absolute; left: 40%; bottom: 6%;' href='$site_url/admin/controllers/manager.php?request=pagemanager-delete&row_id=$row_id'>Delete</a>";
            echo "<a role='button' onclick = 'deleteRow(3*$i+$j, $row_id);' class='btn btn-danger' style='position: absolute; left: 40%; bottom: 6%;'>Delete</a>";
            echo "<a role='button' class='btn btn-warning' style='position: absolute; left: 66.8%; bottom: 6%;' href='list-images/row/$row_id'>Images</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }

          echo "</div>";
        // row ends
        }
        ?>
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i> Footer Pages
                </li>
            </ol>
          </div>
        </div>

        <?php for($i = 0; $i < ceil(count($footer_pages)/3); $i++) {
          echo "<div class='row'>";

          for($j = 0; $j < 3; $j++) {

            if(!isset($footer_pages[3 * $i + $j][1]))
              break;
            
            if($footer_pages[3 * $i + $j][3] != -2)
              continue;

            $page_box_id = 3 * $i + $j;

            echo "<div id=\"$page_box_id\" class='col-sm-4' style='padding: 2%'>";
            echo "<div class='card card-inverse' style='background-color:#333;'>";
            echo "<div class='card-block' style='position: relative; height: 40%;'>";
            echo "<h3 class='card-title'>{$footer_pages[3 * $i + $j][1]}</h3>";
            echo "<p class='card-text'>{$footer_pages[3 * $i + $j][2]}</p>";
            $row_id = $footer_pages[3 * $i + $j][0];
            echo "<a role='button' class='btn btn-primary' style='position: absolute; bottom:6%;' href='edit-page/$row_id'>Edit page</a>";
            echo "&nbsp;&nbsp;&nbsp;&nbsp;";
            // echo "<a role='button' onclick = 'return confirm(\'Are you sure?\');' class='btn btn-danger' style='position: absolute; left: 40%; bottom: 6%;' href='$site_url/admin/controllers/manager.php?request=pagemanager-delete&row_id=$row_id'>Delete</a>";
            echo "<a role='button' onclick = 'deleteRow(3*$i+$j, $row_id);' class='btn btn-danger' style='position: absolute; left: 40%; bottom: 6%;'>Delete</a>";
            echo "<a role='button' class='btn btn-warning' style='position: absolute; left: 66.8%; bottom: 6%;' href='list-images/row/$row_id'>Images</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }

          echo "</div>";
        // row ends
        }
        ?>

      </div>
      <!--right-container ends-->

      <!--footer begins-->
      <div id="footer">
          <p class="footer-block"><?php echo $footer ?></p>
      </div>
      <!--footer ends-->
      
    </div>
    <!--container-fluid ends-->

  </body>
  <!--body ends-->

</html>


<script>
  function deleteRow(page_box_id, page_id) {
    var confirmResult = confirm("Are you sure?");

    if(confirmResult) {
      var site_url = "<?php echo $site_url; ?>";
      $.ajax({
        type: "post",
        url: site_url + '/admin/views/ajax-data.php',
        cache: false,
        data: {page_id: page_id},
        success: function(data) {
          if(data == 1)
          {
            var child = document.getElementById(page_box_id);
            child.parentNode.removeChild(child);
          }
        }
      });
    }
  }
</script>