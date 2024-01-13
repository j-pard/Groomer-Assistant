
// Hide navbar on scroll down.
let prevScrollPos = window.scrollY;
const navbar = document.getElementById('bottom-nav');
const secondaryNavbar = document.getElementById('secondary-nav');

// Check media queries to define screen size.
const isSmallScreen = () => {
    return window.matchMedia("(max-width: 768px)").matches;
}

// Open the navbar by setting the offset.
const openNav = () => {
    navbar.style.bottom = isSmallScreen() ? '1rem' : '2rem';
    navbar.style.cursor = 'default';
    navbar.classList.toggle('pt-2', false);
}

// Close the navbar by transletting it down.
const closeNav = () => {
    if (navbar.contains(secondaryNavbar)) {
        navbar.style.bottom = isSmallScreen() ? '-97px' : '-102px';
    } else {
        navbar.style.bottom = isSmallScreen() ? '-57px' : '-62px';
    }
    navbar.style.cursor = 'pointer';
    navbar.classList.toggle('pt-2', true);
}

// Hide navbar when scrolling down. Open it when scrolling up.
window.onscroll = function() {
    const currentScrollPos = window.scrollY;

    if (prevScrollPos > currentScrollPos) {
        openNav();
    } else {
        closeNav();
    }

    prevScrollPos = currentScrollPos;
}

// Re-open the nav when clicking on it.
navbar.addEventListener('click', () => {
    openNav();
});

