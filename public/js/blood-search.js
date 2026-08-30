document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('findBloodForm');
    if (!form) return;

    const bloodGroup = document.getElementById('bloodGroup');
    const locationInput = document.getElementById('location');
    const latInput = document.getElementById('lat');
    const lngInput = document.getElementById('lng');
    const radiusSelect = document.getElementById('radius');
    const geoBtn = document.getElementById('geoBtn');

    const errors = {
        bloodGroup: document.getElementById('bloodGroupError'),
        location: document.getElementById('locationError'),
        radius: document.getElementById('radiusError')
    };

    // Helper functions matching team validation standard
    function setError(input, errorEl, message) {
        if (input) input.classList.add('invalid');
        if (errorEl) errorEl.textContent = message;
    }

    function clearError(input, errorEl) {
        if (input) input.classList.remove('invalid');
        if (errorEl) errorEl.textContent = '';
    }

    // Validate Blood Group Selection
    function validateBloodGroup() {
        const validGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        const val = bloodGroup ? bloodGroup.value.trim() : '';

        if (val === '') {
            setError(bloodGroup, errors.bloodGroup, 'Please select a blood group.');
            return false;
        }

        if (!validGroups.includes(val)) {
            setError(bloodGroup, errors.bloodGroup, 'Invalid blood group selected.');
            return false;
        }

        clearError(bloodGroup, errors.bloodGroup);
        return true;
    }

    // Validate Location (either manual text or GPS coordinates)
    function validateLocation() {
        const val = locationInput ? locationInput.value.trim() : '';
        const hasCoords = latInput && lngInput && latInput.value !== '' && lngInput.value !== '';

        if (val === '' && !hasCoords) {
            setError(locationInput, errors.location, 'Please enter a location or use current GPS.');
            return false;
        }

        if (!hasCoords && val.length < 2) {
            setError(locationInput, errors.location, 'Location must be at least 2 characters.');
            return false;
        }

        clearError(locationInput, errors.location);
        return true;
    }

    // Validate Search Radius
    function validateRadius() {
        if (!radiusSelect) return true;
        const val = parseInt(radiusSelect.value, 10);

        if (isNaN(val) || val <= 0 || val > 100) {
            setError(radiusSelect, errors.radius, 'Please select a valid search radius.');
            return false;
        }

        clearError(radiusSelect, errors.radius);
        return true;
    }

    // Geolocation Handler
    if (geoBtn) {
        geoBtn.addEventListener('click', function () {
            if (!navigator.geolocation) {
                setError(locationInput, errors.location, 'Geolocation is not supported by your browser.');
                return;
            }

            geoBtn.classList.add('loading');
            clearError(locationInput, errors.location);

            navigator.geolocation.getCurrentPosition(
                function (position) {
                    geoBtn.classList.remove('loading');
                    const lat = position.coords.latitude.toFixed(6);
                    const lng = position.coords.longitude.toFixed(6);

                    if (latInput) latInput.value = lat;
                    if (lngInput) lngInput.value = lng;
                    if (locationInput) {
                        locationInput.value = '📍 Current Location (' + lat + ', ' + lng + ')';
                        clearError(locationInput, errors.location);
                    }
                },
                function (err) {
                    geoBtn.classList.remove('loading');
                    let message = 'Unable to retrieve location. Please enter your location manually.';
                    if (err.code === 1) {
                        message = 'Location permission denied. Please enter your area manually.';
                    } else if (err.code === 2) {
                        message = 'Position unavailable. Please type your location.';
                    } else if (err.code === 3) {
                        message = 'Location request timed out. Please type your location.';
                    }
                    setError(locationInput, errors.location, message);
                },
                { timeout: 8000, enableHighAccuracy: true }
            );
        });
    }

    // Clear GPS coordinates if user starts manually editing the text field
    if (locationInput) {
        locationInput.addEventListener('input', function () {
            if (latInput) latInput.value = '';
            if (lngInput) lngInput.value = '';
            validateLocation();
        });
        locationInput.addEventListener('blur', validateLocation);
    }

    // Real-time listeners
    if (bloodGroup) bloodGroup.addEventListener('change', validateBloodGroup);
    if (radiusSelect) radiusSelect.addEventListener('change', validateRadius);

    // Final Form Submission Validation
    form.addEventListener('submit', function (e) {
        const isBloodGroupValid = validateBloodGroup();
        const isLocationValid = validateLocation();
        const isRadiusValid = validateRadius();

        if (!isBloodGroupValid || !isLocationValid || !isRadiusValid) {
            e.preventDefault();
        }
    });

    // Recent search chips 1-click trigger
    const recentChips = document.querySelectorAll('.recent-chip');
    recentChips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            const group = chip.getAttribute('data-group');
            const loc = chip.getAttribute('data-location');
            const rad = chip.getAttribute('data-radius');

            if (latInput) latInput.value = '';
            if (lngInput) lngInput.value = '';
            if (bloodGroup && group) bloodGroup.value = group;
            if (locationInput && loc) locationInput.value = loc;
            if (radiusSelect && rad) radiusSelect.value = rad;

            if (form) form.submit();
        });
    });
});
