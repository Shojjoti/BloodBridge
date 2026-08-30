document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loginForm');
    if (!form) return;

    const email = document.getElementById('email');
    const password = document.getElementById('password');

    const errors = {
        email: document.getElementById('emailError'),
        password: document.getElementById('passwordError')
    };

    function setError(input, errorEl, message) {
        input.classList.add('invalid');
        errorEl.textContent = message;
    }

    function clearError(input, errorEl) {
        input.classList.remove('invalid');
        errorEl.textContent = '';
    }

    function validateEmail() {
        const value = email.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (value === '') {
            setError(email, errors.email, 'Email is required.');
            return false;
        }
        if (!emailRegex.test(value)) {
            setError(email, errors.email, 'Please enter a valid email address.');
            return false;
        }
        clearError(email, errors.email);
        return true;
    }

    function validatePassword() {
        const value = password.value;
        if (value === '') {
            setError(password, errors.password, 'Password is required.');
            return false;
        }
        clearError(password, errors.password);
        return true;
    }

    // Real-time validation on blur
    email.addEventListener('blur', validateEmail);
    password.addEventListener('blur', validatePassword);

    // Final validation on submit
    form.addEventListener('submit', function (e) {
        const isEmailValid = validateEmail();
        const isPasswordValid = validatePassword();

        if (!isEmailValid || !isPasswordValid) {
            e.preventDefault();
        }
    });
});
