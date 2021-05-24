const apptBtns = Array.from(document.getElementsByClassName('js-appt-modal'));
const apptModal = document.getElementById('apptModal');
const deleteBtns = Array.from(document.getElementsByClassName('js-confirm-delete'));
const deleteModal = document.getElementById('deletePetModal');

// Detach Pet Modal
apptBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        
        apptModal.querySelector('input[name="id"]').value = btn.querySelector('input[name="data-id"]').value;
        apptModal.querySelector('input[name="date"]').value = btn.querySelector('input[name="data-date"]').value;
        apptModal.querySelector('input[name="time"]').value = btn.querySelector('input[name="data-time"]').value;
        apptModal.querySelector('select[name="status"]').value = btn.querySelector('input[name="data-status"]').value;
        apptModal.querySelector('textarea[name="notes"]').value = btn.querySelector('input[name="data-notes"]').value;

        new bootstrap.Modal(apptModal).show();
    });
});

// Delete Pet Modal
deleteBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        
        deleteModal.querySelector('input[name="petId"]').value = btn.getAttribute('data-pet-id');
        new bootstrap.Modal(deleteModal).show();
    });
});