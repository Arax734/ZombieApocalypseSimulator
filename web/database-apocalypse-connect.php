<?php
$host = 'database';
$port = '5432';
$dbname = 'apocalypse'; 
$user = 'postgres';
$password = 'postgres';

$connString = "host=$host port=$port dbname=$dbname user=$user password=$password";

$conn = pg_connect($connString);

if (!$conn) {
    echo "Connection failed.";
} else {
    //Connection successful

}
?>
