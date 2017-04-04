<!--
  This is the main login page which submits the login
  information to the validation routine for email and
  password field validation.
-->

<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location:dashboard.php");
    exit;
  }
?>

<html>
  <!--head starts-->
  <?php require_once("head-components.php") ?>
    <script src="../resources/static/js/cookiemanager.js"></script>
    <script src="../resources/static/js/validate.js"></script>
  </head>
  <!--head ends-->

  <!--body starts-->
  <body>
    <nav class="navbar navbar-toggleable-md navbar-light" style="background-color: #222; height: 50px;">
      <a class="navbar-brand" href="index.php">
        <img src="../resources/static/images/logo.png" width="30" height="30" alt="cms-logo">
      </a>
    </nav>

    <div class="container-fluid">
      <form id="login-form"  onsubmit="return validate();" class="form-horizontal center-div" novalidate="novalidate" role="form" method="post" action="verify-user-in-database.php">
        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Email:</label>
          <div class="row col-sm-12">
            <div class="col-sm-8">
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>
            <div class="col-sm-4">
              <span id="email-error-message" style="color: red;"></span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Password:</label>
          <div class="row col-sm-12">
            <div class="col-sm-8"> 
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            </div>
            <div class="col-sm-4">
              <span id="password-error-message" style="color: red;"></span>
            </div>
        </div>
        <div class="form-group"> 
          <div class="col-sm-10">
            <div class="checkbox">
              <label><input id="remember-checkbox" type="checkbox"> Remember me</label>
              <a role="button" href="forgot-password.php" class="btn btn-link" style="color: beige; cursor: pointer; font-size: 14px">Forgot Password?</a>
            </div>
          </div>
        </div>
        <div class="form-group"> 
          <div class="col-sm-12">
            <div class="row col-sm-12">
              <button type="submit" class="btn btn-primary">Submit</button>
              &nbsp;
              &nbsp;
              &nbsp;
              <p id="login-unsuccess-informer"></p>
            </div>
          </div>
        </div>
      </form>


    </div>
      <!--footer begins-->
      <div id="footer">
          <p class="footer-block">CMS &copy; CMS 2017</p>
      </div>
      <!--footer ends-->
  </body>
  <!--body ends-->
</html>

<!--
Displays error message for unsuccessful login attempts.
Populates the email and password form field if cookie is set.
-->
<script>
  window.onload = function() {
    var loginUnSuccess = "<?php echo isset($_GET['login_success']); ?>";

    if(loginUnSuccess) {
      document.getElementById("login-unsuccess-informer").innerHTML = "Invalid email or password";
    }

    document.getElementById("email").value = getCookie("email");
    document.getElementById("password").value = getCookie("password");
  }
</script>