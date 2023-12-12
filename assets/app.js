/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/conciergerie.css';
// import './styles/bootstrap.min.css';

require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

console.log('test')

window.addEventListener('load',()=>{
    const body = document.body

    const burger = document.querySelector(".burger")
    const menuResponsive = document.querySelector('#menuResponsive')

    const items = document.querySelectorAll('#menuResponsive ul li')
    console.log(items)

    // gestion du menu burger 
    burger.addEventListener('click', function(){
        console.log('burger')
        menuResponsive.classList.toggle("open")
    })

    // gestion de changement de pages menu 
    items.forEach(item=>{
        item.addEventListener('click',function(){
            console.log('menu')
            menuResponsive.classList.remove("open")
        })
    })
})

   