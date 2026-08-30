document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('donorRegisterForm');

    const fullName = document.getElementById('fullName');
    const nid = document.getElementById('nid');
    const phone = document.getElementById('phone');
    const email = document.getElementById('email');
    const bloodGroup = document.getElementById('bloodGroup');
    const lastDonationDate = document.getElementById('lastDonationDate');
    const previousDonations = document.getElementById('previousDonations');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const terms = document.getElementById('terms');

    const errors = {
        fullName: document.getElementById('fullNameError'),
        nid: document.getElementById('nidError'),
        phone: document.getElementById('phoneError'),
        email: document.getElementById('emailError'),
        bloodGroup: document.getElementById('bloodGroupError'),
        lastDonationDate: document.getElementById('lastDonationDateError'),
        previousDonations: document.getElementById('previousDonationsError'),
        password: document.getElementById('passwordError'),
        confirmPassword: document.getElementById('confirmPasswordError'),
        terms: document.getElementById('termsError')
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

    function validateNid() {
        const value = nid.value.trim();
        if (value === '') {
            setError(nid, errors.nid, 'NID number is required.');
            return false;
        }
        if (!/^\d{10}$|^\d{13}$|^\d{17}$/.test(value)) {
            setError(nid, errors.nid, 'Enter a valid NID (10, 13, or 17 digits).');
            return false;
        }
        clearError(nid, errors.nid);
        return true;
    }

    function validatePhone() {
        const value = phone.value.trim();
        if (value === '') {
            setError(phone, errors.phone, 'Phone number is required.');
            return false;
        }
        if (!/^01[3-9]\d{8}$/.test(value)) {
            setError(phone, errors.phone, 'Enter a valid BD phone number (e.g. 01XXXXXXXXX).');
            return false;
        }
        clearError(phone, errors.phone);
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

    function validateBloodGroup() {
        if (bloodGroup.value === '') {
            setError(bloodGroup, errors.bloodGroup, 'Please select your blood group.');
            return false;
        }
        clearError(bloodGroup, errors.bloodGroup);
        return true;
    }

    function validateLastDonationDate() {
        // Optional field, but if filled, cannot be a future date
        if (lastDonationDate.value !== '') {
            const selectedDate = new Date(lastDonationDate.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            if (selectedDate > today) {
                setError(lastDonationDate, errors.lastDonationDate, 'Date cannot be in the future.');
                return false;
            }
        }
        clearError(lastDonationDate, errors.lastDonationDate);
        return true;
    }

    function validatePreviousDonations() {
        // Optional field, but if filled, must be a valid non-negative number
        const value = previousDonations.value.trim();
        if (value !== '') {
            if (isNaN(value) || parseInt(value) < 0) {
                setError(previousDonations, errors.previousDonations, 'Enter a valid number (0 or more).');
                return false;
            }
        }
        clearError(previousDonations, errors.previousDonations);
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

    function validateTerms() {
        if (!terms.checked) {
            errors.terms.textContent = 'You must agree to the terms and conditions.';
            return false;
        }
        errors.terms.textContent = '';
        return true;
    }

    // Real-time validation on blur/change
    fullName.addEventListener('blur', validateFullName);
    nid.addEventListener('blur', validateNid);
    phone.addEventListener('blur', validatePhone);
    email.addEventListener('blur', validateEmail);
    bloodGroup.addEventListener('change', validateBloodGroup);
    lastDonationDate.addEventListener('change', validateLastDonationDate);
    previousDonations.addEventListener('blur', validatePreviousDonations);
    password.addEventListener('blur', validatePassword);
    confirmPassword.addEventListener('blur', validateConfirmPassword);
    terms.addEventListener('change', validateTerms);

    // Final validation on submit
    form.addEventListener('submit', function (e) {
        const validations = [
            validateFullName(),
            validateNid(),
            validatePhone(),
            validateEmail(),
            validateBloodGroup(),
            validateLastDonationDate(),
            validatePreviousDonations(),
            validatePassword(),
            validateConfirmPassword(),
            validateTerms()
        ];

        if (validations.includes(false)) {
            e.preventDefault();
        }
    });
});