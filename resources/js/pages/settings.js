// UPDATE
const TOKEN = document.getElementsByName('_token')[0].value;
const URL = document.getElementById('breedForm').getAttribute('action');
const BTNS = document.querySelectorAll('.js-breed-btn');

BTNS.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        let id = btn.getAttribute('data-breed')
    
        let data = {
            id: id,
            breed: document.getElementById('breed_' + id).value,
            size: document.getElementById('size_' + id).value,
        }
    
        fetch(URL, {
            method: 'POST',
            headers: new Headers({
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": TOKEN
            }),
            body: JSON.stringify(data)
        })
        .then((response) => {
            return response.json();
        })
        .then((response) => {
            console.log(response);
            btn.querySelector('i').classList.toggle('text-pink', false);
            btn.querySelector('i').classList.toggle('text-green', true);
        })
        .catch((error) => {
            console.error(error);
        })
    });
});
