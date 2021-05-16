const customerSelect = document.getElementById('customerSelect');
const petSelect = document.getElementById('petSelect');
const getPetsUrl = document.getElementById('getPetsUrl').value;
const TOKEN = document.getElementsByName('_token')[0].value;

const petBtns = Array.from(document.getElementsByClassName('js-pet-modal'));
const petModal = document.getElementById('petModal');

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

// Pet Modal
petBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        
        let data = JSON.parse(btn.querySelector('.js-values').value);
        
        document.getElementById('petModalLabel').textContent = data.pet;
        petModal.querySelector('input[name="id"]').value = data.id;
        petModal.querySelector('input[name="date"]').value = data.date;
        petModal.querySelector('input[name="time"]').value = data.hours;
        petModal.querySelector('input[name="customerName"]').value = data.customer;
        petModal.querySelector('select[name="status"]').value = data.status;
        petModal.querySelector('textarea[name="notes"]').value = data.notes;

        new bootstrap.Modal(petModal).show();
    });
});