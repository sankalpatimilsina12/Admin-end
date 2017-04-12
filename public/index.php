<!--Get data to populate the charts-->
<?php session_start(); ?>

<?php
  if(!isset($_SESSION['logo'])) {
    header("Location: ../admin/controllers/data.php?request=logo-footer-siteurl&location=../../public/index.php");
    exit;
  }

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];
  $site_url = $_SESSION['site-url'];

  if(!isset($_SESSION['page_count'])) {
    header("Location: $site_url/admin/controllers/data.php?request=public-index");
    exit;
}
  $page_count = $_SESSION['page_count'];
  $image_count = $_SESSION['image_count'];

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
    <script src="<?php echo $site_url ?>/admin/resources/static/js/jquery-1.6.1.min.js" ></script>
    <script src="<?php echo $site_url ?>/admin/resources/static/js/bootstrap.min.js" ></script>
    <script src="<?php echo $site_url ?>/admin/resources/highcharts/highcharts.js" ></script>
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
          <i class="fa fa-envelope-o" aria-hidden="true"><span class="request-quote-text"> Request Quote</span></i>
        </a>
      </nav>

      <nav class="nav flex-column side-nav">
        <li class="nav-item active">
          <a class="nav-link" href="images.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a>
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
                <a role="button" class="btn btn-custom" href="#">Get Started</a>
              </div>
            </div>
          </div>
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
          <p class="footer-block">CMS &copy; CMS 2017</p>
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