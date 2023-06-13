<?php
$host = 'database';
$port = '5432';
$dbname = 'postgres'; 
$user = 'postgres';
$password = 'postgres';

$connString = "host=$host port=$port dbname=$dbname user=$user password=$password";

$conn = pg_connect($connString);

if (!$conn) {
    // Connection failed
} else {
    // Connection successful
    
    // Check if "apocalypse" database exists
    $checkDbQuery = "SELECT datname FROM pg_catalog.pg_database WHERE datname = 'apocalypse'";
    $checkDbResult = pg_query($conn, $checkDbQuery);
    
    if (!$checkDbResult) {
        // Operation failed
    } else {
        if (pg_num_rows($checkDbResult) == 0) {
            $createDbQuery = "CREATE DATABASE apocalypse";
            $createDbResult = pg_query($conn, $createDbQuery);
            
            if (!$createDbResult) {
                // Failed to create database
            } else {
                // Database has been created
            }
        } else {
            // Database already exists
        }
    }

    pg_close($conn);
}
?>