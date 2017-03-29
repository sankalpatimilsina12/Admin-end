<?php require_once("includes/connection.php") ?>
<?php require_once("includes/send-mail.php") ?>

<?php session_start(); ?>

<?php
  $message = "Enter email to recover password";

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
      $message = $randomString;

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
  <?php require_once("includes/head-components.php") ?>
  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <div class="container">
      <h5 style="color: green; text-align: center; margin-top: 15%;"><?php echo $message; ?></h5>
      <form action="" role="form" method="post" novalidate="novalidate" class="form-horizontal center-div" style="margin: 3% 30%;">
        <div class="form-group">
          <div class="col-sm-10">
            <input class="form-control" name="email" placeholder="Email">
            <br>
          <button class="btn btn-primary" type="submit">Submit</button>
          &nbsp;
          &nbsp;
          <a role="button" class="btn btn-info" href="index.php">Login Now</a>
          </div>
        </div>
      </form>
    </div>
  </body>
  <!--body ends-->
</html>