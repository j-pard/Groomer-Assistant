let overlayContainers = Array.from(document.querySelectorAll('div.overlay-images'));
let overlays = Array.from(document.querySelectorAll('div.overlay'));

overlayContainers.forEach(container => {
    container.addEventListener('click', function (event) {
        event.stopPropagation(); 
        let el = container.querySelector('.overlay');
        
        el.classList.toggle('overlay--show');
        el.classList.toggle('overlay--hide');
    })
});

overlays.forEach(overlay => {
    overlay.addEventListener('click', function (event) {
        event.stopPropagation();
    })
});