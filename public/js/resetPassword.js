document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('resetPasswordForm');
    if (!form) return;

    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('confirm_password');

    const errors = {
        newPassword: document.getElementById('newPasswordError'),
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

    function validateNewPassword() {
        const value = newPassword.value;
        if (value === '') {
            setError(newPassword, errors.newPassword, 'Password is required.');
            return false;
        }
        if (value.length < 8) {
            setError(newPassword, errors.newPassword, 'Password must be at least 8 characters.');
            return false;
        }
        if (!/[A-Z]/.test(value) || !/[0-9]/.test(value)) {
            setError(newPassword, errors.newPassword, 'Password must include an uppercase letter and a number.');
            return false;
        }
        clearError(newPassword, errors.newPassword);
        return true;
    }

    function validateConfirmPassword() {
        const value = confirmPassword.value;
        if (value === '') {
            setError(confirmPassword, errors.confirmPassword, 'Please confirm your password.');
            return false;
        }
        if (value !== newPassword.value) {
            setError(confirmPassword, errors.confirmPassword, 'Passwords do not match.');
            return false;
        }
        clearError(confirmPassword, errors.confirmPassword);
        return true;
    }

    // Real-time validation on blur
    newPassword.addEventListener('blur', validateNewPassword);
    confirmPassword.addEventListener('blur', validateConfirmPassword);

    // Final validation on submit
    form.addEventListener('submit', function (e) {
        const isNewPasswordValid = validateNewPassword();
        const isConfirmPasswordValid = validateConfirmPassword();

        if (!isNewPasswordValid || !isConfirmPasswordValid) {
            e.preventDefault();
        }
    });
});
