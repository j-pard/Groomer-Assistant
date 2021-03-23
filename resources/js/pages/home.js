const customerSelect = document.getElementById('customerSelect');
const petSelect = document.getElementById('petSelect');
const getPetsUrl = document.getElementById('getPetsUrl').value;
const TOKEN = document.getElementsByName('_token')[0].value;

// Get pets for specified customer
customerSelect.addEventListener('change', (e) => {
    e.preventDefault();

    fetch(getPetsUrl, {
        method: 'POST',
        headers: new Headers({
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": TOKEN
        }),
        body: JSON.stringify({
                customerId: customerSelect.value
            })
    })
    .then((response) => {
        return response.json();
    })
    .then((response) => {
        resetOptions(petSelect);
        
        petSelect.disabled = false;
        for (const pet in response) {
            let newOption = new Option(response[pet], pet);
            petSelect.add(newOption);
        }
    })
    .catch((error) => {
        console.error(error);
    })
});

const resetOptions = (select) => {
    while (select.options.length > 0) {
        select.remove(0);
    }
    let newOption = new Option('---', -1);
    select.add(newOption);
}