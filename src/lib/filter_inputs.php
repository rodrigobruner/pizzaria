<?php

// Filter the inputs
function cleanInput($data) {
    // If the data is null, return an empty string
    if ($data === null) {
        return '';
    }

    if (is_array($data)) { // If the data is an array, clean each element
        $cleanedData = array_map('cleanInput', $data); // recursive call
    } else { // If the data is not an array, clean it
        $cleanedData = trim(htmlspecialchars(strip_tags($data))); // Clean the data
    }
    return $cleanedData;
}

// Filter the inputs
function cleanInputs($data) {
    $cleanedData = [];
    foreach ($data as $key => $value) {
        $cleanedData[$key] = cleanInput($value);
    }
    return $cleanedData;
}
?>