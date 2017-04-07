<?php require_once("../controllers/connection.php") ?>
<?php require_once("../controllers/mail.php") ?>

<?php session_start(); ?>

<?php
  if(!isset($_SESSION['logo'])) {
    header("Location:../controllers/data.php?request=logo-footer-siteurl&location=index.php");
    exit;
  }

  $logo = $_SESSION['logo'];
  $footer = $_SESSION['footer'];
  $site_url = $_SESSION['site-url'];

?>

<?php
  $message = "PLEASE ENTER EMAIL TO RECOVER PASSWORD";

  if(isset($_POST['email'])) {
    $db = new Connect;
    $inputEmail = $_POST['email'];
    $query = "SELECT * FROM users WHERE email='$inputEmail'";
    $result = mysqli_query($db->getConnection(), $query);


    if($result->num_rows > 0) {
      // Generate random password for user.
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';

      for($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, strlen($characters)-1)];
      }

      // Send mail here
      $from = 'sankalpatimilsina12@gmail.com';
      $to = $inputEmail;
      $subject = 'CMS';
      $message = 'Use following password to login: ' . $randomString;

      sendMail($from, $to, $subject, $message);
      
      $enc = md5($randomString);

      // Update the database
      $query = "UPDATE users SET password = '$enc' WHERE email='$inputEmail'";
      $result = mysqli_query($db->getConnection(), $query);

      $message = "A mail has been sent to your account.";
    }
    else {
      $message = "Invalid email. Please enter a valid email.";
    }
  }
?>

<html>
  <!--head begins-->
  <?php require_once("head-components.php") ?>
  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <nav class="navbar navbar-toggleable-md navbar-light" style="background-color: #222; height: 50px;">
      <a class="navbar-brand" href="index.php">
        <img src="<?php echo $site_url ?>/admin/resources/static/images/logo.png" width="30" height="30" alt="cms-logo">
      </a>
    </nav>

    <div class="container-fluid">
      <h5 style="color: #fff; text-align: center; margin: 13% 0 2% 10%"><?php echo $message; ?></h5>
      <form action="" role="form" method="post" novalidate="novalidate" class="form-horizontal" style="margin-left: 25%">
        <div class="form-group">
          <div class="col-sm-10">
            <input class="form-control" name="email" placeholder="Email">
            <br>
          <button class="btn btn-primary col-sm-4" type="submit">Submit</button>
          &nbsp;
          &nbsp;
          <a role="button" class="btn btn-info col-sm-4" href="index.php">Login Now</a>
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