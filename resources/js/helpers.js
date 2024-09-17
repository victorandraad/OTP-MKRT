// Function to animate elements using GSAP
export function animateElements(selector, options = {}) {
    const defaultOptions = {
        opacity: 0,
        y: 20,
        duration: 0.6,
        stagger: 0.1,
        ease: "power3.out"
    };
    gsap.from(selector, { ...defaultOptions, ...options });
}

// Function to handle form submission with validation
export function handleFormSubmit(formId, submitUrl, validationRules, onSuccess, onError) {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const errors = validateForm(formData, validationRules);

        if (Object.keys(errors).length > 0) {
            displayErrors(errors);
            return;
        }

        try {
            const response = await fetch(submitUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            if (data.success) {
                onSuccess(data);
            } else {
                onError(data.message || 'Unknown error');
            }
        } catch (error) {
            console.error('Error:', error);
            onError('An error occurred while submitting the form.');
        }
    });
}

// Function to validate form data
function validateForm(formData, rules) {
    const errors = {};
    for (const [field, rule] of Object.entries(rules)) {
        const value = formData.get(field);
        if (rule.required && !value) {
            errors[field] = `${field} is required`;
        } else if (rule.minLength && value.length < rule.minLength) {
            errors[field] = `${field} must be at least ${rule.minLength} characters`;
        } else if (rule.maxLength && value.length > rule.maxLength) {
            errors[field] = `${field} must be no more than ${rule.maxLength} characters`;
        }
    }
    return errors;
}

// Function to display form errors
export function displayErrors(errors) {
    // Clear existing error messages
    document.querySelectorAll('.error-message').forEach(el => el.remove());

    // Display new error messages
    for (const [field, message] of Object.entries(errors)) {
        const input = document.querySelector(`[name="${field}"]`);
        if (input) {
            const errorElement = document.createElement('div');
            errorElement.className = 'error-message text-red-500 text-sm mt-1';
            errorElement.textContent = message;
            input.parentNode.insertBefore(errorElement, input.nextSibling);
        }
    }
}

// Function to populate select options
export function populateSelect(selectId, options) {
    const select = document.getElementById(selectId);
    if (!select) return;

    select.innerHTML = '';
    options.forEach(option => {
        const optionElement = document.createElement('option');
        optionElement.value = option.value;
        optionElement.textContent = option.text;
        select.appendChild(optionElement);
    });
}

// Function to toggle element visibility
export function toggleElementVisibility(elementId, isVisible) {
    const element = document.getElementById(elementId);
    if (element) {
        element.classList.toggle('hidden', !isVisible);
    }
}
