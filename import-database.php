<?php
/*
Database import script for Railway KeyAuth deployment
Run this script once to import the database schema
*/

header('Content-Type: text/plain');

// Include database configuration
include 'includes/credentials.php';

try {
    // Create database connection
    $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);
    
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    
    echo "Connected to database successfully!\n";
    
    // Read and execute SQL schema
    $sqlFile = __DIR__ . '/db_structure.sql';
    if (!file_exists($sqlFile)) {
        die("Error: db_structure.sql file not found!\n");
    }
    
    $sql = file_get_contents($sqlFile);
    
    // Execute SQL statements
    if ($conn->multi_query($sql)) {
        echo "Database schema imported successfully!\n";
        
        // Clear any remaining results
        do {
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->more_results() && $conn->next_result());
        
    } else {
        echo "Error importing schema: " . $conn->error . "\n";
    }
    
    // Test tables were created
    $tables = ['accounts', 'apps', 'keys', 'users', 'sessions'];
    echo "\nVerifying tables:\n";
    
    foreach ($tables as $table) {
        $result = $conn->query("SHOW TABLES LIKE '$table'");
        if ($result->num_rows > 0) {
            echo "✓ Table '$table' exists\n";
        } else {
            echo "✗ Table '$table' missing\n";
        }
    }
    
    $conn->close();
    echo "\nDatabase setup complete!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
