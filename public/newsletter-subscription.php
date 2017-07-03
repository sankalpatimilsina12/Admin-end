
<!--
  This page gives the subscription option to the 
  new users.
-->

<?php require_once("../admin/controllers/site-contents.php") ?>

<!--Get data to populate the charts-->
<?php session_start(); ?>


<?php
  if(isset($_GET['attempt']))
    $attempt = "success";
  else
    $attempt = "failure";
?>

<?php

  logoFooterSiteUrl(); 

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];
  $site_url = $_SESSION['site-url'];

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
            <div class="row">
              <div class="col-sm-8">
                <h2 class="page-header">
                    Newsletter Subscription <small style="color: gray">Get Started</small>
                </h2>
              </div>
              <div class="col-sm-4">
                <p id="subscription-attempt"></p>
              </div>
            </div>
            <hr>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-check"></i> Subscription
                </li>
            </ol>
          </div>
        </div>
        <br>

        <form id="form" class="form-horizontal" onsubmit="return validate();" role="form" method="post" action="<?php echo $site_url ?>/admin/controllers/manager.php?request=newsubscription">
          <div class="form-group">
            <label class="control-label col-sm-2" for="email"><strong>Email: </strong></label>
            <div class="col-sm-12">
              <input class="form-control" id="email" name="email" placeholder="Enter email">
              <p id="email-error" style="color: green"></p>
            </div>
          </div>

          <div class="form-group" style="padding: 1%"> 
            <div class="row">
              <div class="col-sm-6">
                <button id="add-button" class="btn btn-success" style="width: 100%" type="submit">Subscribe</button>
              </div>
              <div class="col-sm-6">
                <a id="cancel-button" class="btn btn-danger" style="width: 100%" role="button" href="index.php">Cancel</a>
              </div>
            </div>
          </div>
        </form>

      </div>
      <!--right-container ends-->

      <!--footer begins-->
      <div id="footer">
          <p class="footer-block">CMS &copy; CMS 2017</p>
      </div>
      <!--footer ends-->
      
    </div>
    <!--container-fluid ends-->

    <script>
      window.onload = function() {
        var attempt = "<?php echo $attempt; ?>";

        if(attempt == "success")
        {
          var successBox = document.getElementById("subscription-attempt");
          successBox.innerHTML = "SUBSCRIPTION ADDED";
          successBox.style.color = "green";
          successBox.style.fontSize = "20px";
        }
      }
    </script>

    <!--Email Validation-->
    <script>
    function validate() {
      var email = document.getElementById("email").value;

      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

      var isEmailValid = re.test(email);

      if(!isEmailValid)
        document.getElementById("email-error").innerHTML = "Invalid email";

      return re.test(email);
    }
    </script>
  </body>
  <!--body ends-->
</html>

