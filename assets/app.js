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
    980: {
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

// Search Field

window.onload = () => {
  const searchInput = document.querySelector("#search-field")
// on lance une fonction à chaque touche écrite dans le champ recherche
  searchInput.addEventListener("keyup", () => {
      let searchResult = searchInput.value;
      // on récupère l'url actuel
      const Url = new URL(window.location.href);
      fetch(Url.pathname + "?search=" + searchResult + "&ajax=1", {
          headers: {
              "X-Requested-Width": "XMLHttpRequest"
          }
      }).then(response => 
          response.json()
          ).then(data => {
          const content = document.querySelector('#body-content');
          // ici on envoie la data qu'on a récupérer dans la réponse vers notre div
          content.innerHTML = data.content;
          // ici on envoie a l'url la recherche pour que le php la récupère en request
          history.pushState({}, null, Url.pathname + "?search=" + searchResult)
      }).catch(e => alert(e));

  })
}
