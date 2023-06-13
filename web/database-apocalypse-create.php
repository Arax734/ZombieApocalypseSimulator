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
    $createDbQuery = "CREATE TABLE zombies (
        id INT PRIMARY KEY,
        damage INT,
        speed INT,
        health INT
      );

      CREATE TABLE weapons (
        id INT PRIMARY KEY,
        damage INT,
        accessibility INT,
        names varchar(255)
      );
      
      CREATE TABLE humans (
        id INT PRIMARY KEY,
        damage INT,
        speed INT,
        health INT,
        hunger INT,
        weapon_id INT,
        FOREIGN KEY (weapon_id) REFERENCES weapons(id)
      );
      
      CREATE TABLE medicals (
        id INT PRIMARY KEY,
        health INT,
        accessibility INT,
        names varchar(255)
      );
      
      CREATE TABLE food (
        id INT PRIMARY KEY,
        hunger INT,
        accessibility INT,
        names varchar(255)
      );
      ";
    $createDbResult = pg_query($conn, $createDbQuery);

    if(!$createDbResult){
        // Operation failed
        
    }else{
        // Operation successful
    }

    pg_close($conn);
}
?>
