<!--
  Request Quote allows public users to request the admin
  with various form details for differnet services.
-->

<?php require_once("../admin/controllers/site-contents.php") ?>

<!--Get data to populate the charts-->
<?php session_start(); ?>

<?php
  logoFooterSiteUrl(); 

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];
  $site_url = $_SESSION['site-url'];

  if(!isset($_SESSION['row'])) {
    header("Location: $site_url/admin/controllers/data.php?request=request-quote");
    exit;
  }

  $row = $_SESSION['row'];

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
          <i class="fa fa-envelope-o" aria-hidden="true"><span class="request-quote-text"> Request Quote</span></i>
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
              <h2 class="page-header">
                Request Quote 
              </h2>
              <hr>
              <ol class="breadcrumb">
                  <li class="active">
                      <i class="fa fa-envelope-o"></i> Request Quote 
                  </li>
              </ol>
          </div>
        </div>

        <hr>
        <br>


        <form onsubmit="return validate();" class="form-horizontal" novalidate="novalidate" role="form" method="post" action="<?php echo $site_url ?>/admin/controllers/manager.php?request=request-quote-mail">
          <!--row begins-->
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-id-card-o" aria-hidden="true"></i><strong> First Name:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" name="first-name" placeholder="Required">
                  <p id="first-name-error" style="color: green"></p>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-id-card-o" aria-hidden="true"></i><strong> Last Name:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" name="last-name" placeholder="Required">
                  <p id="last-name-error" style="color: green"></p>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-phone" aria-hidden="true"></i><strong> Phone:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" name="phone" placeholder="Required">
                  <p id="phone-error" style="color: green"></p>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-envelope" aria-hidden="true"></i><strong> Email:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" name="email" placeholder="Required">
                  <p id="email-error" style="color: green"></p>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-map-marker" aria-hidden="true"></i><strong> Address 1:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" name="address-1" placeholder="Optional">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-map-marker" aria-hidden="true"></i><strong> Address 2:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" name="address-2" placeholder="Optional">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-globe" aria-hidden="true"></i><strong> Country:</strong></label>
                <div class="col-sm-12">
                  <select class="form-control" name="country">
                    <option disabled selected>Select Country</option>
                    <?php for($i = 0; $i < count($row); $i++) {
                      if(isset($row[$i][0])) {
                        echo "<option>{$row[$i][0]} {$row[$i][1]}</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-location-arrow" aria-hidden="true"></i><strong> State/Province:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" name="state-province">
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-thumb-tack" aria-hidden="true"></i><strong> City:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" name="city" placeholder="Optional">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-envelope" aria-hidden="true"></i><strong> Postal Code:</strong></label>
                <div class="col-sm-12">
                  <input class="form-control" name="postal-code" placeholder="Optional">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-clock-o" aria-hidden="true"></i><strong> Date Response:</strong></label>
                <div class="col-sm-12">
                  <input class="datepicker" date-format="mm/dd/yyyy" style="width: 100%" name="date-response">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-address-card" aria-hidden="true"></i><strong> Contact Me:</strong></label>
                <div class="col-sm-12 checkbox" style="padding-top: 2%">
                  <label><input type="checkbox" style="width: 15; height: 15" name="checkbox-email" value="email">&nbsp;<i class="fa fa-envelope-o" aria-hidden="true"></i> Email</label>
                  &nbsp;&nbsp;&nbsp;
                  <label><input type="checkbox" style="width: 15; height: 15" name="checkbox-phone" value="phone">&nbsp;<i class="fa fa-phone" aria-hidden="true"></i> Phone</label>
                  &nbsp;&nbsp;&nbsp;
                  <label><input type="checkbox" style="width: 15; height: 15" name="checkbox-post" value="post">&nbsp;<i class="fa fa-clipboard" aria-hidden="true"></i> Post</label>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-mars-stroke" aria-hidden="true"></i><strong> Gender:</strong></label>
                <div class="col-sm-12 radio">
                  <label><input type="radio" style="width: 15; height: 15" class="form-control" name="gender" value="male"><i class="fa fa-male" aria-hidden="true"></i> Male</label>
                  &nbsp;
                  <label><input type="radio" style="width: 15; height: 15" class="form-control" name="gender" value="female"><i class="fa fa-female" aria-hidden="true"></i> Female</label>
                  &nbsp;
                  <label><input type="radio" style="width: 15; height: 15" class="form-control" name="gender" value="other"> Other</label>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-server" aria-hidden="true"></i><strong> Services Interested:</strong></label>
                <div class="col-sm-12">
                  <select name="services-interested[]" style="width: 100%; height: 10%" multiple="multiple">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-6"><i class="fa fa-comments" aria-hidden="true"></i><strong> Other Notes:</strong></label>
                <div class="col-sm-12">
                  <textarea class="form-control" rows="4" name="other-notes" placeholder="Optional"></textarea>
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
    document.getElementById("first-name-error").innerHTML = "";
    document.getElementById("last-name-error").innerHTML = "";
    document.getElementById("phone-error").innerHTML = "";
    document.getElementById("email-error").innerHTML = "";

    var flag = true;

    if(document.getElementsByName("first-name")[0].value == "") {
      document.getElementById("first-name-error").innerHTML = "First name required!";
      flag = false;
    }
    
    if(document.getElementsByName("last-name")[0].value == "") {
      document.getElementById("last-name-error").innerHTML = "Last name required!";
      flag = false;
    }

    if(!validatePhone(document.getElementsByName("phone")[0].value)) {
      document.getElementById("phone-error").innerHTML = "Invalid phone!";
      flag = false;
    }

    if(!validateEmail(document.getElementsByName("email")[0].value)) {
      document.getElementById("email-error").innerHTML = "Invalid email!";
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