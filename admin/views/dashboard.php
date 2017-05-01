<!--
  This is the landing page for successfully logged in users/admin.
-->
<?php require_once("../controllers/site-contents.php") ?>

<?php session_start(); ?>

<?php
  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    header("Location:index.php");
    exit;
  }
?>

<!--Get data to populate the charts-->

<?php
  logoFooterSiteUrl();

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];
  $site_url = $_SESSION['site-url'];

  if(!isset($_SESSION['page_count'])) {
    $location = "$site_url" . "/admin/controllers/data.php?request=dashboard";
    header("Location: $location");
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
    <?php require_once("head-components.php") ?>
    <link rel="stylesheet" href="<?php echo $site_url ?>/admin/resources/font-awesome/css/font-awesome.min.css">
    <script src="<?php echo $site_url ?>/admin/resources/highcharts/highcharts.js" ></script>
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
          <li class="nav-item active">
            <a class="nav-link" href="dashboard.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a>
          </li>
          <li class="nav-item">
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
          <div class="col-sm-12">
              <h2 class="page-header">
                  Dashboard <small style="color: gray">Statistics Overview</small>
              </h2>
              <hr>
              <ol class="breadcrumb">
                  <li class="active">
                      <i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard
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
                <a role="button" class="btn btn-custom" href="page-manager.php">Pages board</a>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card card-inverse" style="background-color: #333;">
              <div class="card-block">
                <h3 class="card-title">Images Overview</h3>
                <p class="card-text">Shows our collection of images for different pages.</p>
                <a role="button" class="btn btn-custom" href="image-manager.php">Images board</a>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card card-inverse" style="background-color: #808000;">
              <div class="card-block">
                <h3 class="card-title">Admin Manager</h3>
                <p class="card-text">This pages is used to create and update users in database.</p>
                <a role="button" class="btn btn-custom" href="admin-manager.php">Admin Panel</a>
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
          <p class="footer-block"><?php echo $footer ?></p>
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