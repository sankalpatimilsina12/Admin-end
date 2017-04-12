
<!--Get data to populate the charts-->
<?php session_start(); ?>

<?php
  if(!isset($_SESSION['logo'])) {
    header("Location:../admin/controllers/data.php?request=logo-footer-siteurl&location=../../public/pages.php");
    exit;
  }

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];
  $site_url = $_SESSION['site-url'];

  if(!isset($_SESSION['row'])) {
    header("Location: $site_url/admin/controllers/data.php?request=public-pages");
    exit;
}

  $pages = $_SESSION['row'];


  unset($_SESSION['row']);
  unset($_SESSION['logo']);
  unset($_SESSION['footer']);
  unset($_SESSION['site-url']);

?>

<html lang="en">
  <!--head begins-->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo $site_url ?>/admin/resources/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $site_url ?>/admin/resources/static/css/style-public.css">
    <link rel="stylesheet" href="<?php echo $site_url ?>/admin/resources/font-awesome/css/font-awesome.min.css">
    <script src="<?php echo $site_url ?>/admin/resources/static/js/jquery-3.2.0.min.js" ></script>
    <script src="<?php echo $site_url ?>/admin/resources/static/js/bootstrap.min.js" ></script>
  </head>
  <!--head ends-->


  <!--body begins-->
  <body>
    <!--container-fluid begins-->
    <div class="container-fluid">

      <nav class="navbar navbar-toggleable-md navbar-light" style="background-color: #222; height: 50px;">
        <a class="navbar-brand" href="index.php">
          <img src="<?php echo $site_url ?>/admin/resources/static/images/logo.png" width="30" height="30" alt="cms-logo">
        </a>
      </nav>

      <nav class="nav flex-column side-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Pages Viewport
          </a>
          <div class="nav-item collapse" id="navbarToggleExternalContent" href="#">
            <?php for($i = 0; $i < count($pages); $i++) {
              // If not parent page, break
              if($pages[$i][3] != -1) 
                break;

            $x = "#navbarToggleExternalSubContent"."$i";
              $y = "navbarToggleExternalSubContent"."$i";
            ?>

              <a class="nav-link" role="button" href="#" onclick="updateContents(<?php echo $pages[$i][0]; ?>)" data-toggle="collapse" data-target="<?php echo $x ?>" aria-controls="<?php echo $y ?>" aria-expanded="false" aria-label="Toggle navigation" style="padding-left:13%">
                <i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;<?php echo $pages[$i][1]; ?>
              </a>
              <div class="nav-item collapse" id="<?php echo $y; ?>" href="#">
                <?php for($j = 0; $j < count($pages); $j++) { 
                  if($pages[$j][3] != $pages[$i][0])
                    continue;
                ?>

                  <a class="nav-link" role="button" href="#" onclick="updateContents(<?php echo $pages[$j][0]; ?>)" style="padding-left: 26%">
                    <i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;<?php echo $pages[$j][1]; ?>
                  </a>
                <?php } ?>
              </div>
            <?php } ?>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="images.php"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Images Viewport</a>
        </li>
      </nav>


      <!--right-container begins-->
      <div class="right-container" style="padding: 2%">
        <div class="row">
          <div class="col-sm-12">
              <h2 class="page-header">
                Pages
              </h2>
              <hr>
              <ol class="breadcrumb">
                  <li class="active">
                      <i class="fa fa-file-text-o"></i> Pages
                  </li>
              </ol>
          </div>
        </div>

        <br>

        <div id="pages-list">
        <?php for($i = 0; $i < ceil(count($pages)/3); $i++) {
          echo "<div class='row'>";

          for($j = 0; $j < 3; $j++) {

            if(!isset($pages[3 * $i + $j][0]))
              break;


            echo "<div class='col-sm-4' style='padding: 2%'>";
            echo "<div class='card card-inverse' style='background-color:#333;'>";
            echo "<div class='card-block' style='position: relative; height: 40%;'>";
            echo "<h3 class='card-title'>{$pages[3 * $i + $j][1]}</h3>";
            echo "<p class='card-text'>{$pages[3 * $i + $j][2]}</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }

          echo "</div>";
        // row ends
        }
        ?>
        </div>

      </div>
      <!--right-container ends-->
    </div>
    <!--container-fluid ends-->
    
    <!--footer begins-->
    <div id="footer">
      <div class="container-fluid">
        <p class="footer-block">CMS &copy; CMS 2017</p>
      </div>
    </div>
    <!--footer ends-->
  </body>
  <!--body ends-->
</html>

<script>
  function updateContents(page_id) {
    var site_url = "<?php echo $site_url; ?>";

    $.ajax({
      type: "POST",
      url: site_url + '/public/ajax-data.php',
      cache: false,
      data: {page_id: page_id},
      success: function(data) {
        document.getElementById("pages-list").innerHTML = data;
      }
    });

  }
</script>

<!--<script>
var content;
  $('a').click(function (e) {
    e.preventDefault();

    var page_id = $(this).attr("href");

    $.ajax({
      type: "POST",
      url: site_url + '/public/ajax-data.php',
      data: {page_id : page_id},
      success: function(data) {
        content = data;
      }
    });

    document.getElementById("pages-list").innerHTML = content;

  });
</script>;-->