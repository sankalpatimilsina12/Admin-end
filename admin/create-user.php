<html lang="en">
  <!--head begins-->
  <?php require_once("includes/head-components.php") ?>
  <script src="js/validate.js"></script>
  </head>
  <!--head ends-->

  <!--body begins-->
  <body>
    <div class="container">
      <form class="form-horizontal center-div" onsubmit="return validate();" novalidate="novalidate" role="form" method="post" action="admin-manager.php?request=new-user">
        <div class="form-group">
          <label class="control-label col-sm-2">Email:</label>
          <div class="col-sm-10">
            <input class="form-control" id="email" name="email" value="">
            <p id="email-error-message"></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2">Password:</label>
          <div class="col-sm-10">
            <input class="form-control" id="password" name="password" value="">
            <p id="password-error-message"></p>
          </div>
        </div>
        <div class="form-group"> 
          <div class="row col-sm-10">
            <div class="col-sm-offset-2 col-sm-3 hand-button">
              <button class="btn btn-large btn-primary" type="submit">Create</button>
            </div>
            <div class="col-sm-offset-2 col-sm-2 hand-button">
              <a id="cancel-button" class="btn btn-large btn-warning" role="button" href="admin-manager.php">Cancel</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </body>
  <!--body ends-->
  </html>