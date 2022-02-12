console.log('script is working..');
const toggle_menu = document.getElementById('toggle');
const aside = document.querySelector('.aside');
const main_container = document.querySelector('.main_container')
// const masterEntery = document.getElementById('masterEntery');
const childList = document.getElementById('childList');
// const ul = document.querySelectorAll('.parent > li');



toggle_menu.addEventListener('click', (e) => {
    aside.classList.toggle('min_aside');
    main_container.classList.toggle('max-container');
    // aside.children[1].classList.toggle('.min_parent');
    // console.log(aside.children[1],aside)

})




      





