import './bootstrap';
import Alpine from 'alpinejs';
import * as helpers from './helpers';

window.Alpine = Alpine;
Alpine.start();

// Expose helper functions globally
window.animateElements = helpers.animateElements;
window.handleFormSubmit = helpers.handleFormSubmit;
window.displayErrors = helpers.displayErrors;
window.populateSelect = helpers.populateSelect;
window.toggleElementVisibility = helpers.toggleElementVisibility;
