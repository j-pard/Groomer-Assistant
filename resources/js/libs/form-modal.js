window.addEventListener('form-modal-loaded', e => {
    const el = document.getElementById(e.detail.modalId);
    if (el !== null) {
        let modalInstance = bootstrap.Modal.getInstance(el);
        if (modalInstance === null) {
            modalInstance = new bootstrap.Modal(el);
        }

        modalInstance.show();
    }
});

window.addEventListener('form-modal-saved', e => {
    const el = document.getElementById(e.detail.modalId);
    if (el !== null) {
        const modalInstance = bootstrap.Modal.getInstance(el)
        if (modalInstance !== null) {
            modalInstance.hide();
        }
    }
});

// Auto focus the first visible input field of the modal
window.addEventListener('shown.bs.modal', function (event) {
    const firstInputField = event.target.querySelector('input:not([type=hidden]):not([type=button])');
    if (firstInputField !== null) {
        firstInputField.focus();
    }
});
