const username = document.querySelector('#username');
const password = document.querySelector('#password');
const form = document.querySelector('form');

username.addEventListener('keyup', validateUsername);
password.addEventListener('keyup', validatePassword);

function validateUsername(e) {
  const text = username.value;
  
  if(text == '') {
    username.classList.add('is-invalid');
    return true;
  } else {
    username.classList.remove('is-invalid');
    return false;
  }
}

function validatePassword(e) {
  const text = password.value;
  const re = /^[\w]{6,}$/i;
  const uppercase = /[A-Z]/;
  const number = /[0-9]/;
  
  if(text == '') {
    password.classList.add('is-invalid');
    return true;
  } else {
    password.classList.remove('is-invalid');
    return false;
  }
}

form.addEventListener('submit', (e) => {
  
  if( validateUsername() || validatePassword()) {
    validateUsername();
    validatePassword();
  } else {
    return true;
  }
  e.preventDefault();
});

document.addEventListener('DOMContentLoaded', function() {
  var sidenav = document.querySelectorAll('.sidenav');
  var sideNavInstances = M.Sidenav.init(sidenav);
});