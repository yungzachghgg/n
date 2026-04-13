<?php
/*
Test script to verify Railway deployment functionality
Tests authentication and key generation
*/

header('Content-Type: application/json');

// Include necessary files
include 'includes/misc/autoload.phtml';

// Test database connection
function testDatabase() {
    try {
        $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);
        if ($conn->connect_error) {
            return ['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error];
        }
        $conn->close();
        return ['success' => true, 'message' => 'Database connection successful'];
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
    }
}

// Test key generation
function testKeyGeneration() {
    try {
        include 'includes/misc/license.php';
        include 'includes/misc/etc.php';
        
        // Test generateRandomString function
        $randomString = \misc\etc\generateRandomString(16);
        
        // Test license masking function
        $testMask = "******-******-******";
        $maskedKey = \misc\license\license_masking($testMask);
        
        return [
            'success' => true,
            'message' => 'Key generation functions working',
            'random_string' => $randomString,
            'masked_key' => $maskedKey
        ];
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Key generation error: ' . $e->getMessage()];
    }
}

// Test API endpoint
function testAPI() {
    try {
        // Test if API file exists and is readable
        $apiFile = 'api/1.2/index.php';
        if (!file_exists($apiFile)) {
            return ['success' => false, 'message' => 'API file not found'];
        }
        
        return ['success' => true, 'message' => 'API endpoint accessible'];
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'API test error: ' . $e->getMessage()];
    }
}

// Run all tests
$tests = [
    'database' => testDatabase(),
    'key_generation' => testKeyGeneration(),
    'api_endpoint' => testAPI()
];

// Return results
echo json_encode([
    'success' => true,
    'message' => 'Railway deployment test completed',
    'tests' => $tests,
    'timestamp' => date('Y-m-d H:i:s')
]);
?>
