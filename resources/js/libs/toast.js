import { Toast } from 'bootstrap';

window.groomer.showMessage = function (message, style = 'success') {
    // Create toast element
    const el = document.createElement('div');
    el.className = 'toast toast--' + style;
    el.setAttribute('role', 'alert');
    el.setAttribute('aria-live', 'assertive');
    el.setAttribute('aria-atomic', 'true');

    const body = document.createElement('div');
    let iconType = (style === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle');
    body.className = 'toast-body';
    body.innerHTML += '<i class="toast__icon ' + iconType + '"></i>';
    body.innerHTML += '<span class="w-100">' + message + '</span>';
    el.appendChild(body);

    const button = document.createElement('button');
    button.className = 'btn btn-icon';
    button.setAttribute('type', 'button');
    button.setAttribute('data-bs-dismiss', 'toast');
    button.setAttribute('aria-label', 'Close');
    button.innerHTML += '<i class="fa-solid fa-xmark"></i>';
    body.appendChild(button);

    // Append the new toast to the toasts container
    document.getElementById('toast-container').appendChild(el);

    // Show the toast
    const options = {};
    if (style === 'danger') {
        options.autohide = false;
    }

    (new Toast(el, options)).show();
}

// Delete the toast from the DOM when it is hidden.
document.addEventListener('hidden.bs.toast', (e) => {
    Toast.getInstance(e.target).dispose();
    e.target.parentElement.removeChild(e.target);
}, false);

// Display the toast on event.
window.addEventListener('show-toast', e => {
    const eData = e.detail[0];
    window.groomer.showMessage(eData?.message, eData?.style);
});
