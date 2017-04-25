
<!--
  This page includes basic form components
  to contact admin/users by public users.
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
    <link rel="stylesheet" href="<?php echo $site_url ?>/admin/resources/static/css/bootstrap-datepicker.min.css">
    <script src="<?php echo $site_url ?>/admin/resources/static/js/jquery-3.2.0.min.js" ></script>
    <script src="<?php echo $site_url ?>/admin/resources/static/js/bootstrap.min.js" ></script>
    <script src="<?php echo $site_url ?>/admin/resources/static/js/bootstrap-datepicker.min.js" ></script>
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
          <i class="fa fa-users request-quote-text" aria-hidden="true"><span> Contact Us</span></i>
        </a>
      </nav>

      <nav class="nav flex-column side-nav">
        <li class="nav-item">
          <a class="nav-link" href="images.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Pages Viewport</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="images.php"><i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Images Viewport</a>
        </li>
      </nav>

      <!--right container begins-->
      <div class="right-container" style="padding: 2%">
        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-8">
                <h2 class="page-header">
                    Contact Us
                </h2>
              </div>
              <div class="col-sm-4">
                <p id="contact-attempt"></p>
              </div>
            </div>
            <hr>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-envelope-o"></i> Contact Us 
                </li>
            </ol>
          </div>
        </div>

        <hr>
        <br>


        <form onsubmit="return validate();" class="form-horizontal" novalidate="novalidate" role="form" method="post" action="<?php echo $site_url ?>/admin/controllers/manager.php?request=contact-us">
          <!--row begins-->
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-id-card-o" aria-hidden="true"></i><strong> Name:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" name="name" placeholder="Enter Name">
                  <p id="name-error" style="color: green"></p>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-id-card-o" aria-hidden="true"></i><strong> Email:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" name="email" placeholder="Enter Email">
                  <p id="email-error" style="color: green"></p>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-phone" aria-hidden="true"></i><strong> Phone:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" name="phone" placeholder="Enter Phone">
                  <p id="phone-error" style="color: green"></p>
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-pencil" aria-hidden="true"></i><strong> Message:</strong></label>
                <div class="col-sm-12">
                  <textarea class="form-control" name="message" rows="5" placeholder="Enter Message"></textarea>
                </div>
              </div>
            </div>
          </div>
          <!--row ends-->

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group"> 
                <button id="add-button" class="btn btn-primary" style="width: 95%; margin-left: 2.5%" type="submit">Submit</button>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <a id="cancel-button" class="btn btn-warning" style="width: 95%; margin-left: 2.5%" role="button" href="index.php">Cancel</a>
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

  </body>

  <script>
    $('.datepicker').datepicker({
        startDate: '-3d',
        todayHighlight: true
    });
  </script>

</html>


<!--Validation script-->
<script>
  function validate() {
    document.getElementById("name-error").innerHTML = "";
    document.getElementById("email-error").innerHTML = "";
    document.getElementById("phone-error").innerHTML = "";

    var flag = true;

    if(document.getElementsByName("name")[0].value == "") {
      document.getElementById("name-error").innerHTML = "Name required!";
      flag = false;
    }
    
    if(document.getElementsByName("email")[0].value == "") {
      document.getElementById("email-error").innerHTML = "Last name required!";
      flag = false;
    }

    if(!validatePhone(document.getElementsByName("phone")[0].value)) {
      document.getElementById("phone-error").innerHTML = "Invalid phone!";
      flag = false;
    }

    return flag;
  }
</script>


<script>
  function validatePhone(phone) {
    var re = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
    return re.test(phone);

  }
  
  function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
</script>

<script>
  window.onload = function() {
    var attempt = "<?php echo $attempt; ?>";

    if(attempt == "success")
    {
      var successBox = document.getElementById("contact-attempt");
      successBox.innerHTML = "SUCCESS";
      successBox.style.color = "green";
      successBox.style.fontSize = "20px";
    }
  }
</script>