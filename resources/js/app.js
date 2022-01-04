import * as bootstrap from 'bootstrap';
import './libs/confirmation';
import './libs/form-modal';
import './libs/toast';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.bootstrap = bootstrap;

// Include custom JS
if (document.body.getAttribute('data-page')) {
    require('./pages/' + document.body.getAttribute('data-page'));
}

// Remove .loading from body after content loaded
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        document.body.classList.remove('loading');
    }, 20);
});
