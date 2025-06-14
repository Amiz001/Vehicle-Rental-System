//-----------------login and signup button effect------------------------

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


//-----------------vehicle slider js------------------------

let currentSlide = 0;
const sliderTrack = document.querySelector('.slider-track');
const vehicleCards = document.querySelectorAll('.vehicle-card');
const totalSlides = vehicleCards.length;
const visibleSlides = 3;

function nextSlide() {
    currentSlide++;
    if (currentSlide >= totalSlides) {
      currentSlide = 0; 
    }
    updateSlider();
  }
  
  function updateSlider() {
    const slideWidth = vehicleCards[0].clientWidth;  
    if(currentSlide < 4)
    {
        sliderTrack.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
    }
    else
    {
        currentSlide = 0 ;
        sliderTrack.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
    }  
  }

setInterval(() => {
  nextSlide();
}, 6000);

