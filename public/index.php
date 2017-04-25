<!--
  The index page shows the basic site interface
  to public users.
-->

<?php require_once("../admin/controllers/site-contents.php") ?>
<?php require_once("../admin/controllers/connection.php") ?>

<!--Get data to populate the charts-->
<?php session_start(); ?>

<?php
  $db = new Connect;
  $query = "SELECT image FROM slides";
  $result = mysqli_query($db->getConnection(), $query);
  $images = $result->fetch_all();

  logoFooterSiteUrl(); 
  footerPages();

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];
  $site_url = $_SESSION['site-url'];
  $footer_pages = $_SESSION['footer-pages'];

  if(!isset($_SESSION['page_count'])) {
    header("Location: $site_url/admin/controllers/data.php?request=public-index");
    exit;
  }
  $page_count = $_SESSION['page_count'];
  $image_count = $_SESSION['image_count'];
  $latest_posts = $_SESSION['latest_posts'];



  unset($_SESSION['latest_posts']);
  unset($_SESSION['page_count']);
  unset($_SESSION['image_count']);
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
    <script src="<?php echo $site_url ?>/admin/resources/highcharts/highcharts.js" ></script>

  <style>
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
    }
  </style>

  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <div class="container-fluid">

      <nav class="navbar navbar-toggleable-md navbar-light" style="background-color: #222; height: 50px;">
        <a class="navbar-brand" href="index.php">
          <img src="<?php echo $site_url ?>/admin/resources/static/images/logo.png" width="30" height="30" alt="cms-logo">
        </a>

        <a href="request-quote.php" class="request-quote">
          <i class="fa fa-envelope-o request-quote-text" aria-hidden="true"><span> Request Quote</span></i>
        </a>
        <a href="contact-us.php" class="contact-us">
          <i class="fa fa-users contact-us-text" aria-hidden="true"><span> Contact Us</span></i>
        </a>
      </nav>

      <nav class="nav flex-column side-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Pages Viewport</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="images.php"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Images Viewport</a>
        </li>
      </nav>

      <div class="right-container" style="padding: 2%">

        <div class="row">
          <div class="col-sm-12">
              <h2 class="page-header">
                  Dashboard <small style="color: gray">Statistics Overview</small>
              </h2>
              <hr>
              <ol class="breadcrumb">
                  <li class="active">
                      <i class="fa fa-dashboard"></i> Dashboard
                  </li>
              </ol>
          </div>
        </div>
        <br>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="<?php echo $site_url; ?>/admin/resources/static/images/uploads/<?php echo $images[0][0]; ?>" alt="img" style="width: 100%; height: 60%">
            </div>
          <?php for($i = 1; $i < count($images); $i++) { ?>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="<?php echo $site_url; ?>/admin/resources/static/images/uploads/<?php echo $images[$i][0]; ?>" alt="img" style="width: 100%; height: 60%">
            </div>
          <?php } ?>
          </div>
          <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <br>
        <br>

        <div class="row">
          <div class="col-sm-4">
            <div class="card card-inverse" style="background-color: #6666ff;">
              <div class="card-block">
                <h3 class="card-title">Pages Overview</h3>
                <p class="card-text">Discusses all the general pages of different users.</p>
                <a role="button" class="btn btn-custom" href="pages.php">Pages board</a>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card card-inverse" style="background-color: #333;">
              <div class="card-block">
                <h3 class="card-title">Images Overview</h3>
                <p class="card-text">Shows our collection of images for different pages.</p>
                <a role="button" class="btn btn-custom" href="images.php">Images board</a>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card card-inverse" style="background-color: #808000;">
              <div class="card-block">
                <h3 class="card-title">Get Started</h3>
                <p class="card-text">Join us today to get awesome content management.</p>
                <a role="button" class="btn btn-custom" href="newsletter-subscription.php">Subscribe</a>
              </div>
            </div>
          </div>
        </div>

        <br>
        <br>

        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li class="active">
                <div class="row">
                <div class="col-sm-10"><i class="fa fa-clock-o"></i> Latest Posts</div>
                <div class="col-sm-2"><i class="fa fa-list"></i><a href="posts-list.php" style="color: #333; cursor: pointer; text-decoration: none;" > View All Posts</a></div>
                </div>
              </li>
            </ol>
          </div>
        </div>
        <br>
        <div class="row">
          <?php for($i = 0; $i < count($latest_posts); $i++) { 
              $words = explode(" ", $latest_posts[$i][2]);
              $images = explode(",", $latest_posts[$i][3]);
              array_pop($images);
              $background = array("#6666ff", "#333", "#808000"); ?>
              <div class="col-sm-4">
                <div class="card card-inverse" style="background-color: <?php echo $background[$i]; ?>">
                  <div class="card-block">
                    <h3 class="card-title"><?php echo $latest_posts[$i][1]; ?></h3>
                    <div>
                      <img class'card-img-top' style='width: 70%; height: 35%' src='<?php echo $site_url; ?>/admin/resources/static/images/uploads/<?php echo $images[0]; ?>' alt='img'>
                    </div>
                    <br>
                    <div class="row" style="padding-left: 5%">
                      <?php for($j = 0; $j < 5; $j++) { 
                        if(!isset($words[$j]))
                          break; ?>
                          <p class="card-text"><?php echo $words[$j]; ?>&nbsp;</p>
                      <?php } ?>
                      <p>........</p>
                    </div>
                    <a style="color: #fff; text-decoration: none;" href="post-details.php?post_id=<?php echo $latest_posts[$i][0] ?>">Read More</a>
                  </div>
                </div>
              </div>
          <?php } ?>
        </div>
        <br>
        <br>
        <div class="row">
          <div class="col-sm-12" id="bar" style="width: 100%; height: 300px; background-color: "></div>
        </div>

      </div>
      <!--right-container ends-->

      <!--footer begins-->
      <div id="footer">
        <div class="row">
            <p class="footer-block col-sm-2">CMS &copy; CMS 2017</p>
          <div style="padding-top: 1%;">
            <?php for($i = 0; $i < count($footer_pages); $i++)
            {
              echo "<a href='#' style='color: #fff; text-decoration: none;'>&nbsp;{$footer_pages[$i][0]}&nbsp;&nbsp;</a>";
            }
            ?>
          </div>
        </div>
      </div>
      <!--footer ends-->
      
    </div>
    <!--container-fluid ends-->

  </body>
  <!--body ends-->
</html>

<script>
$(function () {
    var myChart = Highcharts.chart('bar', {
        chart: {
            type: 'bar',
        },
        title: {
            text: 'Database Statistics'
        },
        xAxis: {
            categories: ['Pages', 'Images']
        },
        yAxis: {
            title: {
                text: 'Count'
            }
        },
        series: [{
            data: [<?php echo $page_count ?>, 0]
        }, {
            data: [0, <?php echo $image_count ?>]
        }]
    });
});
</script>