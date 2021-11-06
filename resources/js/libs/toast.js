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
    button.innerHTML += '<img src="/images/close.svg"/>';
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

document.addEventListener('hidden.bs.toast', (e) => {
    // Delete the toast from the DOM when it is hidden
    Toast.getInstance(e.target).dispose();
    e.target.parentElement.removeChild(e.target);
}, false);

window.addEventListener('show-toast', e => {
    window.groomer.showMessage(e.detail.message, e.detail.style);
});
