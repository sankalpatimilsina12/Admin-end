<?php require_once("connection.php") ?>
<?php require_once("mail.php") ?>

<?php

  $db = new Connect();

  if(isset($_GET['request'])) {

    switch($_GET['request']) {
      case 'addpages':

                  if(isset($_POST['page_title'])) {
                    $selected_page = $db->getConnection()->real_escape_string($_POST['page_title']);
                    $query = "SELECT id from pages WHERE title='$selected_page'";
                    $result = mysqli_query($db->getConnection(), $query);
                    $row = $result->fetch_all();
                    $parent_id = $row[0][0];

                  } else {
                    $parent_id = -1;
                  }

                  $title = $db->getConnection()->real_escape_string($_POST['title']);
                  $content = $db->getConnection()->real_escape_string($_POST['content']);
                  $query = "INSERT INTO pages (title, text, parent_id) VALUES ('$title', '$content', $parent_id)";
                  $location = "../views/page-manager.php";
                  break;

      case 'editpages':
                  $title = $db->getConnection()->real_escape_string($_POST['title']);
                  $content = $db->getConnection()->real_escape_string($_POST['content']);
                  $row_id = (int)$_GET['row_id'];
                  $query = "UPDATE pages SET title='$title', text='$content' WHERE id=$row_id";
                  $location = "../views/page-manager.php";
                  break;

      case 'pagemanager-delete':
                  $row_id = (int)$_GET['row_id'];
                  $query = "DELETE FROM pages WHERE pages.id=$row_id";
                  $location = "../views/page-manager.php";
                  break;

      case 'imagemanager-delete':
                  $row_id = $_GET['row_id'];
                  $query = "DELETE FROM images WHERE images.id=$row_id";
                  $location = "../views/image-manager.php";
                  break;

      case 'list-images-delete':
                  $row_id = $_GET['row_id'];
                  $image_row_id = $_GET['image_row_id'];
                  $query = "DELETE FROM images WHERE images.id=$image_row_id";
                  $location = "../views/list-images.php?row_id=$row_id";
                  break;

      case 'create-user':
                  $email = $db->getConnection()->real_escape_string($_POST['email']);
                  $password = $db->getConnection()->real_escape_string($_POST['password']);
                  $enc = md5($password);

                  $query = "INSERT INTO users (email, password) VALUES ('$email', '$enc')";
                  $location = "../views/admin-manager.php";
                  break;

      case 'edit-user':
                  $email = $db->getConnection()->real_escape_string($_POST['email']);
                  $password = $db->getConnection()->real_escape_string($_POST['password']);
                  $enc = md5($password);

                  $row_id = (int)$_GET['row_id'];
                  $query = "UPDATE users SET email='$email', password='$enc' WHERE id=$row_id";
                  $location = "../views/admin-manager.php";
                  break;

      case 'delete-user':
                  $row_id = $_GET['row_id'];
                  $query = "DELETE FROM users WHERE users.id=$row_id";
                  $location = "../views/admin-manager.php";
                  break;

      case 'imagemanager-upload':
                    $file = $_FILES['fileToUpload']['name'];
                    $file_loc = $_FILES['fileToUpload']['tmp_name'];
                    $folder="../resources/static/images/uploads/";
                    move_uploaded_file($file_loc,$folder.$file);

                    $page_title = $_POST['page_title'];
                    $query = "SELECT id FROM pages WHERE title='$page_title'";
                    $result = mysqli_query($db->getConnection(), $query);
                    $row = $result->fetch_all();
                    $row_id = $row[0][0];

                    $query="INSERT INTO images(image, page_id) VALUES ('$file', $row_id)";

                    $location = "../views/image-manager.php";
                    break;

      case 'list-images-upload':
                    $file = $_FILES['fileToUpload']['name'];
                    $file_loc = $_FILES['fileToUpload']['tmp_name'];
                    $folder="../resources/static/images/uploads/";
                    move_uploaded_file($file_loc,$folder.$file);

                    $row_id = $_GET['row_id'];
                    $location = "list-images.php?row_id=$row_id";

                    $query="INSERT INTO images(image, page_id) VALUES ('$file', $row_id)";

                    $location = "../views/list-images.php?row_id=$row_id";
                    break;

      case 'settings-logo':
                    $file = $_FILES['fileToUpload']['name'];
                    $file_loc = $_FILES['fileToUpload']['tmp_name'];
                    $folder="../resources/static/images/uploads/";
                    move_uploaded_file($file_loc,$folder.$file);

                    $query="INSERT INTO settings (id, logo) VALUES (1, '$file')
                            ON DUPLICATE KEY UPDATE logo='$file'";

                    $location = "../views/settings.php";
                    break;


      case 'settings-footer':
                    $footer = $db->getConnection()->real_escape_string($_POST['footer']);

                    $query = "INSERT INTO settings (id, footer) VALUES (2, '$footer')
                              ON DUPLICATE KEY UPDATE footer='$footer'";

                    $location = "../views/settings.php";
                    break;

      case 'request-quote-mail':
                    $firstName = $_POST['first-name'];
                    $lastName = $_POST['last-name'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];
                    $addressFirst = (function() {
                      if(isset($_POST['address-1']) && $_POST['address-1'] != "") 
                        return $_POST['address-1'];

                        return "null";
                    })();

                    $addressSecond = (function() {
                      if(isset($_POST['address-2']) && $_POST['address-2'] != "") 
                        return $_POST['address-2'];

                        return "null";
                    })();

                    $country = (function() {
                      if(isset($_POST['country']) && $_POST['country'] != "Select Country")
                        return $_POST['country'];

                        return "null";
                    })();

                    $stateprovince =  (function() {
                      if($_POST['state-province'] != "")
                        return $_POST['state-province'];

                        return "null";
                    })();

                    $city = (function() {
                      if($_POST['city'] != "")
                        return $_POST['city'];

                        return "null";
                    })();

                    $postalcode = (function() {
                      if($_POST['postal-code'] != "")
                        return $_POST['postal-code'];

                        return "null";
                    })();

                    $dateResponse = (function() {
                      if($_POST['date-response'] != "")
                        return $_POST['date-response'];

                        return "null";
                    })();

                    $contactMe = (function() {
                      $choices = array();

                      if(isset($_POST['checkbox-email']) && $_POST['checkbox-email'] == 'email')
                        array_push($choices, "email");
                      else 
                        array_push($choices, null);

                      if(isset($_POST['checkbox-phone']) && $_POST['checkbox-phone'] == 'phone')
                        array_push($choices, "phone");
                      else 
                        array_push($choices, null);

                      if(isset($_POST['checkbox-post']) && $_POST['checkbox-post'] == 'post')
                        array_push($choices, "post");
                      else 
                        array_push($choices, null);

                      $nullFlag = false;

                      foreach($choices as $x) {
                        if($x == null) {
                          $nullFlag = true;
                        }
                      }

                      if($nullFlag) {
                        return "null";
                      }

                      return $choices;
                    })();

                    $gender = (function() {
                      if(isset($_POST['gender'])) 
                        return $_POST['gender'];

                      return "null";
                    })();

                    $servicesInterested = (function() {
                      if(isset($_POST['services-interested']))
                        return $_POST['services-interested'];

                      $numServicesSelected = count($servicesInterested);
                      for($i = 0; $i < 3; $i++) {
                        if(!isset($servicesInterested[$i]))
                          $servicesInterested[$i] = null;
                      }
                      
                      return "null";
                    })();


                    $otherNotes = (function() {
                      if(isset($_POST['other-notes']) && $_POST['other-notes'] != "")
                        return $_POST['other-notes'];

                      return "null";
                    })();

                    // Send Mail
                    $from = "sankalpatimilsina12@gmail.com";
                    $to = "sankalpatimilsina12@gmail.com";
                    $message = "Hi Admin, <br>
                    You’ve received a quote request from website on: [date/time]. Details below:<br>
                    First Name = $firstName<br>
                    Last Name = $lastName<br>
                    Phone = $phone<br>
                    Email = $email<br>
                    Address1 = $addressFirst<br>
                    Address2 = $addressSecond<br>
                    Country = $country<br>
                    State/Province = $stateprovince<br>
                    City = $city<br>
                    Postal Code = $postalcode<br>
                    Response Date = $dateResponse<br>
                    ContactMeVia = $contactMe[0] $contactMe[1] $contactMe[2]<br>
                    Gender = $gender<br>
                    Services Interested = $servicesInterested[0] $servicesInterested[1] $servicesInterested[2]<br>
                    Other Notes = $otherNotes<br>
                    <br>
                    Thank you,<br>
                    CMS";

                    $subject = "Quote Request From CMS";

                    $replyTo = $email;

                    sendMail($from, $to, $subject, $message, $replyTo);

                    $query = "";
                    $location = "../../public/request-quote.php";
                    
                    break;

    }

    $result = mysqli_query($db->getConnection(), $query);
  }

  header("Location: $location");
  exit;

?>