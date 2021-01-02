function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }
  
  function formValidation() {
    var email = document.forms["login-form"]["email"].value;
    var password = document.forms["login-form"]["password"].value;
    var error = document.getElementById("error");

    if (email == "") {
      error.textContent = "Email is empty!";
      return false;


    }
    if (password == "") {
      error.textContent = "Password is empty!";
      return false;
    }
    if (!validateEmail(email)) {
      error.textContent = "Email is not valid!";
      return false;
    }
    if (password.length < 8) {
      error.textContent = "Password length must be greater than 8 characters!";
      return false;
    }
  
}