const signUpButton = document.getElementById('sign-up');
const loginButton = document.getElementById('login');

function addHover() {
  signUpButton.style.backgroundColor = '#fca311';
  signUpButton.style.color = 'black';
  loginButton.style.backgroundColor = 'transparent';
  loginButton.style.color = 'white';
}

function removeHover() {
  signUpButton.style.backgroundColor = 'transparent';
  signUpButton.style.color = 'white';
  loginButton.style.backgroundColor = '#fca311';
  loginButton.style.color = 'black';
}

signUpButton.addEventListener('mouseenter', addHover);
signUpButton.addEventListener('mouseleave', removeHover);

loginButton.addEventListener('mouseenter', addHover);
loginButton.addEventListener('mouseleave', removeHover);
