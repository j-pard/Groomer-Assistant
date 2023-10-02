
// Hide navbar on scroll down.
let prevScrollPos = window.scrollY;
const navbar = document.getElementById('bottom-nav');
const secondaryNavbar = document.getElementById('secondary-nav');

// Function to check the screen width and apply the style accordingly.
const setNavOffset = () => {
    if (window.matchMedia("(max-width: 768px)").matches) {
        navbar.style.bottom = '1rem';
    } else {
        navbar.classList.toggle('pt-1', false);
        navbar.style.bottom = '2rem';
    }
    navbar.style.cursor = 'default';
}

window.onscroll = function() {
    const currentScrollPos = window.scrollY;
    
    if (prevScrollPos > currentScrollPos) {
        setNavOffset();
    } else {
        navbar.style.cursor = 'pointer';
        if (navbar.contains(secondaryNavbar)) {
            navbar.style.bottom = '-90px';
        } else {
            navbar.classList.toggle('pt-1', true);
            navbar.style.bottom = '-55px';
        }
    }

    prevScrollPos = currentScrollPos;
}

navbar.addEventListener('click', (e) => {
    setNavOffset();
})