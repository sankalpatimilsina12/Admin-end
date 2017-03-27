function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function validatePassword(password) {
  return (password != "");
}

function validate() {
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var rememberToken = document.getElementById("remember-checkbox");

  if(!validateEmail(email)) {
    document.getElementById("email-error-message").innerHTML = "Invalid email address";
  }

  if(!validatePassword(password)) {
    document.getElementById("password-error-message").innerHTML = "Invalid password";

  }

  if(validateEmail(email) && validatePassword(password)) {

    if(rememberToken.checked) {
      if(!checkCookie(email) && !checkCookie(password)) {
        setCookie('email', email);
        setCookie('password', password);
      }
    }
    return true;
  }
  return false;
}