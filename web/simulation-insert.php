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

    $lmedkits_number = $_POST["lmedkits_number"];
    $mmedkits_number = $_POST["mmedkits_number"];
    $smedkits_number = $_POST["smedkits_number"];
    $porks_number = $_POST["porks_number"];
    $cheeses_number = $_POST["cheeses_number"];
    $apples_number = $_POST["apples_number"];
    $guns_number = $_POST["guns_number"];
    $sticks_number = $_POST["sticks_number"];
    $swords_number = $_POST["swords_number"];
    
    $zombies_number = $_POST["zombies_number"];
    $humans_number = $_POST["humans_number"];

    // Insert zombies
    for ($i = 1; $i <= $zombies_number; $i++) {
      $damage = $_POST["zombie_damage".$i];
      if($damage == 0){
        $damage++;
      }
      $speed = $_POST["zombie_speed".$i];
      if($speed == 0){
        $speed++;
      }
      $health = 100;

      $query = "INSERT INTO zombies (id, damage, speed, health) VALUES ('$i', '$damage', '$speed', '$health')";

      $result = pg_query($conn, $query);
      
      if (!$result) {
          echo "Error inserting data for zombie $i.";
          break;
      }
    }

    // Insert humans
    for ($i = 1; $i <= $humans_number; $i++) {
      $damage = $_POST["human_damage".$i];
      if($damage == 0){
        $damage++;
      }
      $speed = $_POST["human_speed".$i];
      if($speed == 0){
        $speed++;
      }
      $health = 100;
      $hunger = 100;

      $query = "INSERT INTO humans (id, damage, speed, health, hunger, weapon_id) VALUES ('$i', '$damage', '$speed', '$health','$hunger',null)";

      $result = pg_query($conn, $query);
      
      if (!$result) {
          echo "Error inserting data for humans $i.";
          break;
      }
    }

    $idmedkits = 1;
    // Insert large medkits
    for ($i = 1; $i <= $lmedkits_number; $i++) {
      $name = "large medkit";
      $randomNumber = rand(1, 50);

      $query = "INSERT INTO medicals (id, health, accessibility, names) VALUES ('$idmedkits', 100, '$randomNumber', '$name')";
      $idmedkits++;

      $result = pg_query($conn, $query);
      
      if (!$result) {
          echo "Error inserting data for large medkits $i.";
          break;
      }
    }

    // Insert medium medkits
    for ($i = 1; $i <= $mmedkits_number; $i++) {
      $name = "medium medkit";
      $randomNumber = rand(1, 50);

      $query = "INSERT INTO medicals (id, health, accessibility, names) VALUES ('$idmedkits', 50, '$randomNumber', '$name')";
      $idmedkits++;

      $result = pg_query($conn, $query);
      
      if (!$result) {
          echo "Error inserting data for medium medkits $i.";
          break;
      }
    }

    // Insert small medkits
    for ($i = 1; $i <= $mmedkits_number; $i++) {
      $name = "small medkit";
      $randomNumber = rand(1, 50);

      $query = "INSERT INTO medicals (id, health, accessibility, names) VALUES ('$idmedkits', 25, '$randomNumber', '$name')";
      $idmedkits++;

      $result = pg_query($conn, $query);
      
      if (!$result) {
          echo "Error inserting data for small medkits $i.";
          break;
      }
    }

    $foodid = 1;
    // Insert porks
    for ($i = 1; $i <= $porks_number; $i++) {
      $name = "pork";
      $randomNumber = rand(1, 50);

      $query = "INSERT INTO food (id, hunger, accessibility, names) VALUES ('$foodid', 75, '$randomNumber', '$name')";
      $foodid++;

      $result = pg_query($conn, $query);
      
      if (!$result) {
          echo "Error inserting data for porks $i.";
          break;
      }
    }

    // Insert cheeses
    for ($i = 1; $i <= $cheeses_number; $i++) {
      $name = "cheese";
      $randomNumber = rand(1, 50);

      $query = "INSERT INTO food (id, hunger, accessibility, names) VALUES ('$foodid', 50, '$randomNumber', '$name')";
      $foodid++;

      $result = pg_query($conn, $query);
      
      if (!$result) {
          echo "Error inserting data for cheeses $i.";
          break;
      }
    }

    // Insert apples
    for ($i = 1; $i <= $apples_number; $i++) {
      $name = "apple";
      $randomNumber = rand(1, 50);

      $query = "INSERT INTO food (id, hunger, accessibility, names) VALUES ('$foodid', 25, '$randomNumber', '$name')";
      $foodid++;

      $result = pg_query($conn, $query);
      
      if (!$result) {
          echo "Error inserting data for apples $i.";
          break;
      }
    }

    $wepid = 1;
    // Insert guns
    for ($i = 1; $i <= $guns_number; $i++) {
      $name = "gun";
      $randomNumber = rand(1, 50);

      $query = "INSERT INTO weapons (id, damage, accessibility, names) VALUES ('$wepid', 20, '$randomNumber', '$name')";
      $wepid++;

      $result = pg_query($conn, $query);
      
      if (!$result) {
          echo "Error inserting data for guns $i.";
          break;
      }
    }

    // Insert swords
    for ($i = 1; $i <= $swords_number; $i++) {
      $name = "sword";
      $randomNumber = rand(1, 50);

      $query = "INSERT INTO weapons (id, damage, accessibility, names) VALUES ('$wepid', 10, '$randomNumber', '$name')";
      $wepid++;

      $result = pg_query($conn, $query);
      
      if (!$result) {
          echo "Error inserting data for swords $i.";
          break;
      }
    }

    // Insert sticks
    for ($i = 1; $i <= $sticks_number; $i++) {
      $name = "stick";
      $randomNumber = rand(1, 50);

      $query = "INSERT INTO weapons (id, damage, accessibility, names) VALUES ('$wepid', 10, '$randomNumber', '$name')";
      $wepid++;

      $result = pg_query($conn, $query);
      
      if (!$result) {
          echo "Error inserting data for sticks $i.";
          break;
      }
    }
    pg_close($conn);
    header("Location: simulation.php");
}
?>
