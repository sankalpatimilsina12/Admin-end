
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
  $query = "SELECT id, title, content, seo_title, meta_title, meta_keywords, added_date, is_active, images FROM posts";
  $result = mysqli_query($db->getConnection(), $query);
  $row = $result->fetch_all();

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
          <li class="nav-item">
            <a class="nav-link" href="page-manager.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Page Manager</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="image-manager.php"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Image Manager</a>
          </li>
          <li class="nav-item active">
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
                  Post Manager <small style="color: gray">Posts Editing</small>
              </h2>
          </div>
          <div class="col-sm-2">
            <a role="button" class="btn btn-success" href="add-post.php">Add new post <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-sm-12">
          <ol class="breadcrumb">
              <li class="active">
                  <i class="fa fa-file-text-o" aria-hidden="true"></i> Post Manager
              </li>
          </ol>
          </div>
        </div>

        <?php for($i = 0; $i < ceil(count($row)/2); $i++) {
          echo "<div class='row'>";

          for($j = 0; $j < 2; $j++) {

            if(!isset($row[2 * $i + $j][1]))
              break;

            $images = explode(",", $row[2 * $i + $j][8]);
            array_pop($images);

            $post_box_id = 2 * $i + $j;

            echo "<div id=\"$post_box_id\" class='col-sm-6'>";
            echo "<div class='card card-inverse' style='background-color:#ececd6;'>";
            echo "<div>";
            for($k = 0; $k < count($images); $k++) {
              echo "<img class='card-img-top' style='width: 50%; height: 35%' src='$site_url/admin/resources/static/images/uploads/{$images[$k]}' alt='img'>";
            }
            echo "</div>";
            echo "<div class='card-block'>";
            echo "<div class='row'>";
            echo "<div class='col-sm-6'>";
            echo "<p style='color: grey'><strong>Title: </strong>{$row[2 * $i + $j][1]}</p>";
            echo "<p style='color: grey'><strong>Description: </strong>{$row[2 * $i + $j][2]}</p>";
            echo "<p style='color: grey'><strong>Seo Title: </strong>{$row[2 * $i + $j][3]}</p>";
            echo "<p style='color: grey'><strong>Active: </strong>{$row[2 * $i + $j][7]}</p>";
            echo "</div>";
            echo "<div class='col-sm-6'>";
            echo "<p style='color: grey'><strong>Meta Title: </strong>{$row[2 * $i + $j][4]}</p>";
            echo "<p style='color: grey'><strong>Meta Keywords: </strong>{$row[2* $i + $j][5]}</p>";
            echo "<p style='color: grey'><strong>Added Date: </strong>{$row[2 * $i + $j][6]}</p>";
            echo "</div>";
            echo "</div>";
            $row_id = $row[2 * $i + $j][0];
            echo "<a role='button' class='btn btn-primary col-sm-5' style='left: 0%; ' href='$site_url/admin/views/edit-post.php?row_id=$row_id'>Edit Post</a>";
            echo "<a role='button' onclick = 'deleteRow(2 * $i + $j, $row_id);' class='btn btn-danger col-sm-5' style='right: -11%;'>Delete</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }

          echo "</div>";
          echo "<br>";
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
  function deleteRow(post_box_id, post_id) {
    var confirmResult = confirm("Are you sure?");

    if(confirmResult) {
      var site_url = "<?php echo $site_url; ?>";
      $.ajax({
        type: "post",
        url: site_url + '/admin/views/ajax-data.php',
        cache: false,
        data: {post_id: post_id},
        success: function(data) {
          if(data == 1)
          {
            var child = document.getElementById(post_box_id);
            child.parentNode.removeChild(child);
          }
        }
      });
    }
  }
</script>