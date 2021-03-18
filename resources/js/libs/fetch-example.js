const TOKEN = document.getElementsByName('_token')[0].value;
const URL = document.getElementById('getBreedUrl').value;

SELECT.addEventListener('change', () => {

    fetch(URL, {
        method: 'POST',
        headers: new Headers({
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": TOKEN
        }),
        body: JSON.stringify({
                key: value
            })
    })
    .then((response) => {
        return response.json();
    })
    .then((response) => {
        console.log(response);
    })
    .catch((error) => {
        console.error(error);
    })
});
