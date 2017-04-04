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

  var flag = true;

  if(!validateEmail(email)) {
    document.getElementById("email-error-message").innerHTML = "Invalid email";
    flag = false;
  }

  if(!validatePassword(password)) {
    document.getElementById("password-error-message").innerHTML = "Invalid password";
    flag = false;

  }

  if(flag) {

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