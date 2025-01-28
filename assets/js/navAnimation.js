const nav_accueil = document.querySelector('.accueil-nav');

window.addEventListener('scroll', () => {
    if(window.scrollY > 520){
        nav_accueil.classList.add('scroll');
    }
    else{
        nav_accueil.classList.remove('scroll');
    }
})