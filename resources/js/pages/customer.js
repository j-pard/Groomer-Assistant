const apptBtns = Array.from(document.getElementsByClassName('js-appt-modal'));
const apptModal = document.getElementById('apptModal');

// Appointments edit
apptBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        
        apptModal.querySelector('h5.modal-title').value = btn.querySelector('input[name="data-pet-name"]').value + ' - Détails';
        apptModal.querySelector('input[name="date"]').value = btn.querySelector('input[name="data-date"]').value;
        apptModal.querySelector('input[name="time"]').value = btn.querySelector('input[name="data-time"]').value;
        apptModal.querySelector('select[name="status"]').value = btn.querySelector('input[name="data-status"]').value;
        apptModal.querySelector('textarea[name="notes"]').value = btn.querySelector('input[name="data-notes"]').value;

        new bootstrap.Modal(apptModal).show();
    });
});