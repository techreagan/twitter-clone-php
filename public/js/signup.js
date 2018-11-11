const firstName = document.querySelector('#firstName');
const lastName = document.querySelector('#lastName');
const email = document.querySelector('#email');
const username = document.querySelector('#username');
const dob = document.querySelector('#dob');
const password = document.querySelector('#password');
const confirmPassword = document.querySelector('#confirmPassword');
const form = document.querySelector('#form');

firstName.addEventListener('keyup', validateFirstName);
lastName.addEventListener('keyup', validateLastName);
email.addEventListener('keyup', validateEmail);
username.addEventListener('keyup', validateUsername);
dob.addEventListener('keyup', validateDob);
password.addEventListener('keyup', validatePassword);
confirmPassword.addEventListener('keyup', validateConfirmPassword);

function validateFirstName() {
 validateNames(firstName);
}

function validateLastName() {
  validateNames(lastName);
}

function validateNames(elem) {
  const text = elem.value;
  const re = /^[a-z]{3,15}$/i;
  
  if(!re.test(text) ) {
    elem.classList.add('is-invalid');
    return true;
  } else {
    elem.classList.remove('is-invalid');
    return false;
  }
}

function validateEmail(e) {
  const text = email.value;
  const re = /^[a-z]([\w\_\-\.])+@([\w\.])+\.(\w){2,5}$/i;
  
  if(!re.test(text)) {
    email.classList.add('is-invalid');
    return true;
  } else {
    email.classList.remove('is-invalid');
    return false;
  }
}

function validateUsername(e) {
  const text = username.value;
  const re = /^([\w\_]){3,10}$/i;
  
  if(!re.test(text)) {
    username.classList.add('is-invalid');
    return true;
  } else {
    username.classList.remove('is-invalid');
    return false;
  }
}

function validateDob(e) {
  const text = dob.value;
  const re = /^([\w\s])+\,(\s)([0-9]){4}$/i;
  
  if(!re.test(text)) {
    dob.classList.add('is-invalid');
    return true;
  } else {
    dob.classList.remove('is-invalid');
    return false;
  }
}

function validatePassword(e) {
  const text = password.value;
  const re = /^[\w]{6,}$/i;
  const uppercase = /[A-Z]/;
  const number = /[0-9]/;
  
  if(!re.test(text) || (text.search(uppercase) == '-1') || (text.search(number) == '-1')) {
    password.classList.add('is-invalid');
    return true;
  } else {
    password.classList.remove('is-invalid');
    return false;
  }
}

function validateConfirmPassword(e) {
  const text = confirmPassword.value;
  
  if(text !== password.value) {
    confirmPassword.classList.add('is-invalid');
    return true;
  } else {
    confirmPassword.classList.remove('is-invalid');
    return false;
  }
}

form.addEventListener('submit', (e) => {
  
  if(validateFirstName() || validateLastName() || validateUsername() || validateEmail() || validateDob() || validatePassword() || validateConfirmPassword()) {
    validateFirstName();
    validateLastName();
    validateEmail();
    validateUsername();
    validateDob();
    validatePassword();
    validateConfirmPassword();
  } else {
    return true;
  }
  e.preventDefault();
});

const date = new Date();

const monthsShort	=
[
  'Jan',
  'Feb',
  'Mar',
  'Apr',
  'May',
  'Jun',
  'Jul',
  'Aug',
  'Sep',
  'Oct',
  'Nov',
  'Dec'
];

const todaysDate = date.getDate() + ' ' + monthsShort[date.getMonth()] + ', ' + date.getFullYear(); 
const currentDate = new Date(todaysDate);
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelector('.datepicker');
  var instances = M.Datepicker.init(elems, {maxDate: currentDate});
  dob.addEventListener('focus', () => {
    instances.open();
  })
});
