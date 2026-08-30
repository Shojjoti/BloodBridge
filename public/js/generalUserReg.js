document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registerForm');

    const fullName = document.getElementById('fullName');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');

    const errors = {
        fullName: document.getElementById('fullNameError'),
        email: document.getElementById('emailError'),
        password: document.getElementById('passwordError'),
        confirmPassword: document.getElementById('confirmPasswordError')
    };

    function setError(input, errorEl, message) {
        input.classList.add('invalid');
        errorEl.textContent = message;
    }

    function clearError(input, errorEl) {
        input.classList.remove('invalid');
        errorEl.textContent = '';
    }

    function validateFullName() {
        const value = fullName.value.trim();
        if (value === '') {
            setError(fullName, errors.fullName, 'Full name is required.');
            return false;
        }
        if (value.length < 3) {
            setError(fullName, errors.fullName, 'Full name must be at least 3 characters.');
            return false;
        }
        if (!/^[A-Za-z\s.'-]+$/.test(value)) {
            setError(fullName, errors.fullName, 'Full name can only contain letters and spaces.');
            return false;
        }
        clearError(fullName, errors.fullName);
        return true;
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
        if (value.length < 8) {
            setError(password, errors.password, 'Password must be at least 8 characters.');
            return false;
        }
        if (!/[A-Z]/.test(value) || !/[0-9]/.test(value)) {
            setError(password, errors.password, 'Password must include an uppercase letter and a number.');
            return false;
        }
        clearError(password, errors.password);
        return true;
    }

    function validateConfirmPassword() {
        const value = confirmPassword.value;
        if (value === '') {
            setError(confirmPassword, errors.confirmPassword, 'Please confirm your password.');
            return false;
        }
        if (value !== password.value) {
            setError(confirmPassword, errors.confirmPassword, 'Passwords do not match.');
            return false;
        }
        clearError(confirmPassword, errors.confirmPassword);
        return true;
    }

    // Real-time validation on blur
    fullName.addEventListener('blur', validateFullName);
    email.addEventListener('blur', validateEmail);
    password.addEventListener('blur', validatePassword);
    confirmPassword.addEventListener('blur', validateConfirmPassword);

    // Final validation on submit
    form.addEventListener('submit', function (e) {
        const isFullNameValid = validateFullName();
        const isEmailValid = validateEmail();
        const isPasswordValid = validatePassword();
        const isConfirmPasswordValid = validateConfirmPassword();

        if (!isFullNameValid || !isEmailValid || !isPasswordValid || !isConfirmPasswordValid) {
            e.preventDefault();
        }
    });
});