/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

// MENU BURGER
let link = document.querySelector('.burger')
let burger = document.querySelector('.burger-icon')
let ul = document.querySelector('.menu-burger')

link.addEventListener('click', function() {
  burger.classList.toggle('open')
  ul.classList.toggle('open')
});

//Swipper
const swiper = new Swiper('.swiper', {
  slidesPerView: 1,
  spaceBetween: 30,
  autoplay: {
    delay: 4000
  },
  breakpoints: {

    720: {
      slidesPerView: 2,
      spaceBetween: 50
    },
    900: {
      slidesPerView: 3,
      spaceBetween: 50
    }
  },
  // Optional parameters
  direction: 'horizontal',
  loop: true,

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});
