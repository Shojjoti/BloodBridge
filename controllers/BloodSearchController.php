<?php
session_start();

// Handle Search Submission
if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET;

    $errors = [];

    // Sanitize Inputs
    $bloodGroup = trim($data['blood_group'] ?? '');
    $location   = trim(strip_tags($data['location'] ?? ''));
    $radius     = trim($data['radius'] ?? '5');
    $lat        = trim($data['lat'] ?? '');
    $lng        = trim($data['lng'] ?? '');

    // 1. Validate Blood Group against Whitelist
    $validBloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    if ($bloodGroup === '') {
        $errors['bloodGroup'] = 'Please select a blood group.';
    } elseif (!in_array($bloodGroup, $validBloodGroups, true)) {
        $errors['bloodGroup'] = 'Selected blood group is invalid.';
    }

    // 2. Validate GPS Coordinates or Manual Location Text
    $hasValidCoords = false;
    if ($lat !== '' && $lng !== '') {
        $latVal = filter_var($lat, FILTER_VALIDATE_FLOAT);
        $lngVal = filter_var($lng, FILTER_VALIDATE_FLOAT);

        if ($latVal !== false && $lngVal !== false && $latVal >= -90 && $latVal <= 90 && $lngVal >= -180 && $lngVal <= 180) {
            $hasValidCoords = true;
        } else {
            $lat = '';
            $lng = '';
        }
    }

    if (!$hasValidCoords) {
        if ($location === '') {
            $errors['location'] = 'Please enter a location or enable GPS location.';
        } elseif (mb_strlen($location) < 2) {
            $errors['location'] = 'Location must be at least 2 characters.';
        } elseif (mb_strlen($location) > 100) {
            $errors['location'] = 'Location text is too long.';
        }
    }

    // 3. Validate Search Radius
    $radiusInt = filter_var($radius, FILTER_VALIDATE_INT);
    $validRadii = [5, 10, 25];
    if ($radiusInt === false || !in_array($radiusInt, $validRadii, true)) {
        $radiusInt = 5; // Default safe fallback
    }

    // If validation errors exist, send back to findBlood.php
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_search'] = [
            'blood_group' => $bloodGroup,
            'location'    => $location,
            'radius'      => $radiusInt,
            'lat'         => $lat,
            'lng'         => $lng
        ];
        header('Location: ../views/blood/findBlood.php');
        exit;
    }

    // 4. Set Persistent Cookies (Valid for 30 Days)
    $cookieExpire = time() + (86400 * 30);
    setcookie('bb_last_blood_group', $bloodGroup, $cookieExpire, '/');
    if ($location !== '') {
        setcookie('bb_last_location', $location, $cookieExpire, '/');
    }
    setcookie('bb_last_radius', (string)$radiusInt, $cookieExpire, '/');

    // Update Recent Searches Cookie (JSON array of max 3 items)
    $recentSearches = [];
    if (!empty($_COOKIE['bb_recent_searches'])) {
        $decoded = json_decode($_COOKIE['bb_recent_searches'], true);
        if (is_array($decoded)) {
            $recentSearches = $decoded;
        }
    }

    $newSearchItem = [
        'group'    => $bloodGroup,
        'location' => $location !== '' ? $location : 'Current Location',
        'radius'   => $radiusInt
    ];

    // Filter out duplicates and keep top 3
    $recentSearches = array_filter($recentSearches, function ($item) use ($newSearchItem) {
        return !($item['group'] === $newSearchItem['group'] && $item['location'] === $newSearchItem['location']);
    });
    array_unshift($recentSearches, $newSearchItem);
    $recentSearches = array_slice($recentSearches, 0, 3);
    setcookie('bb_recent_searches', json_encode($recentSearches), $cookieExpire, '/');

    // 5. Store Search Parameters in Session
    $_SESSION['last_search'] = [
        'blood_group' => $bloodGroup,
        'location'    => $location,
        'radius'      => $radiusInt,
        'lat'         => $lat,
        'lng'         => $lng,
        'time'        => time()
    ];

    // Build URL query string and forward to search results
    $queryParams = http_build_query([
        'blood_group' => $bloodGroup,
        'location'    => $location,
        'radius'      => $radiusInt,
        'lat'         => $lat,
        'lng'         => $lng
    ]);

    header('Location: ../views/blood/searchResult.php?' . $queryParams);
    exit;

} else {
    header('Location: ../views/blood/findBlood.php');
    exit;
}
