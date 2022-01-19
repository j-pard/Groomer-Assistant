import { Modal } from 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    let clickedElement = null;
    const elModal = document.getElementById('modalConfirmation');
    const confirmationModal = new Modal(elModal);
    const confirmationModalBodyEl = document.querySelector('#modalConfirmation .js-confirmation-body');
    const confirmationModalButtonEl = document.querySelector('#modalConfirmation .js-confirmation-button');

    document.addEventListener('click', (e) => {
        // Loop parent nodes from the target to the delegation node
        for (let target = e.target; target && target != this; target = target.parentNode) {
            if ((target !== window.document) && target.matches('[data-confirm]')) {
                if (clickedElement !== null) {
                    // Hide the modal and let the click event go through
                    confirmationModal.hide();

                    if (target.matches('[data-confirm-action]')) {
                        e.preventDefault();
                        eval(target.getAttribute('data-confirm-action'));
                    }
                } else {
                    // Prevent the default click event
                    e.preventDefault();

                    // Save the clicked element
                    clickedElement = target;

                    // Show confirmation modal
                    confirmationModalBodyEl.textContent = target.getAttribute('data-confirm');
                    confirmationModalButtonEl.textContent = target.hasAttribute('data-confirm-button') ? target.getAttribute('data-confirm-button') : confirmationModalButtonEl.getAttribute('data-text');
                    confirmationModalButtonEl.setAttribute('data-href', target.getAttribute('href'));
                    confirmationModal.show();
                }

                break;
            }
        }
    }, false);

    elModal.addEventListener('hide.bs.modal', function () {
        // Reset the saved clicked element
        clickedElement = null;
    });

    confirmationModalButtonEl.addEventListener('click', (e) => {
        e.preventDefault();

        // Add a flag to bypass the confirmation modal on the original element and click on it
        clickedElement.setAttribute('data-bypass-confirm', '');

        clickedElement.click();

        if (clickedElement !== null) {
            clickedElement.removeAttribute('data-bypass-confirm');
        }
    });
});
