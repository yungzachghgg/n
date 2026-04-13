<?php
// Simple health check endpoint for Railway
header('Content-Type: application/json');

// Basic health check response
echo json_encode([
    'status' => 'healthy',
    'service' => 'KeyAuth',
    'timestamp' => date('Y-m-d H:i:s'),
    'version' => '1.0'
]);
?>
