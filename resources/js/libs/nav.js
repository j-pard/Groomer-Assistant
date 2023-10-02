
// Hide navbar on scroll down.
let prevScrollPos = window.scrollY;
const navbar = document.getElementById('bottom-nav');

// Function to check the screen width and apply the style accordingly.
const setNavOffset = () => {
    if (window.matchMedia("(max-width: 768px)").matches) {
        navbar.style.bottom = '1rem';
    } else {
        navbar.style.bottom = '2rem';
    }
}

window.onscroll = function() {
    const currentScrollPos = window.scrollY;
    if (prevScrollPos > currentScrollPos) {
        setNavOffset();
    } else {
        navbar.style.bottom = '-90px';
    }

    prevScrollPos = currentScrollPos;
}