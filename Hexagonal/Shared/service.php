<?php

if (!function_exists('get_features')) {
    function get_features() {
        $url = 'http://feature_flag_service'; // Replace with your desired endpoint path if necessary

        // Initialize a cURL session
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true, // Return the response as a string
            CURLOPT_TIMEOUT => 10, // Timeout in seconds
            CURLOPT_HTTPGET => true, // Make a GET request
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json', // Add headers as needed
            ],
        ]);

        // Execute the cURL request
        $response = curl_exec($curl);

        // Check for cURL errors
        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            return [
                'success' => false,
                'error' => $error,
            ];
        }

        // Get the HTTP status code
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // Close the cURL session
        curl_close($curl);

        // Return the response and status code
        return json_decode($response, true);
    }
}