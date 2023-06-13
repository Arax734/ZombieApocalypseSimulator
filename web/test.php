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
    // Connection successful
    $query = "SELECT * FROM zombies";
    $result = pg_query($conn, $query);

    if (!$result) {
        // Query execution failed
        echo "Error executing the query: " . pg_last_error($conn);
    } else {
        // Query executed successfully
        if (pg_num_rows($result) > 0) {
            // Iterate over the result set
            while ($row = pg_fetch_assoc($result)) {
                $zombieId = $row['id'];
                $zombieDamage = $row['damage'];
                $zombieSpeed = $row['speed'];
                $zombieHealth = $row['health'];

                // Display the zombie data
                echo "<span style='color:green;'><strong>Zombie ID:</strong> " . $zombieId . "</span><br>";
                echo "Damage: " . $zombieDamage . "<br>";
                echo "Speed: " . $zombieSpeed . "<br>";
                echo "<span style='color:lime;'>Health: " . $zombieHealth . "</span><br><br>";
            }
        } else {
            echo "No zombies found.";
        }
    }
    echo "---------------------------------------------<br>";

    $query = "SELECT * FROM humans";
    $result = pg_query($conn, $query);

    if (!$result) {
        // Query execution failed
        echo "Error executing the query: " . pg_last_error($conn);
    } else {
        // Query executed successfully
        if (pg_num_rows($result) > 0) {
            // Iterate over the result set
            while ($row = pg_fetch_assoc($result)) {
                $humanId = $row['id'];
                $humanDamage = $row['damage'];
                $humanSpeed = $row['speed'];
                $humanHealth = $row['health'];
                $humanHunger = $row['hunger'];
                $humanWeapon = $row['weapon_id'];

                // Display the zombie data
                echo "<span style='color:orange;'><strong>Human ID:</strong> " . $humanId . "</span><br>";
                echo "Damage: " . $humanDamage . "<br>";
                echo "Speed: " . $humanSpeed . "<br>";
                echo "<span style='color:lime;'>Health: " . $humanHealth . "</span><br>";
                echo "Hunger: " . $humanHunger . "<br>";
                echo "Weapon_id: " . $humanWeapon . "<br><br>";
            }
        } else {
            echo "No humans found.";
        }
    }
    echo "---------------------------------------------<br>";

    $query = "SELECT * FROM food";
    $result = pg_query($conn, $query);

    if (!$result) {
        // Query execution failed
        echo "Error executing the query: " . pg_last_error($conn);
    } else {
        // Query executed successfully
        if (pg_num_rows($result) > 0) {
            // Iterate over the result set
            while ($row = pg_fetch_assoc($result)) {
                $foodid = $row['id'];
                $foodhunger = $row['hunger'];
                $foodaccess = $row['accessibility'];
                $foodname = $row['names'];

                // Display the zombie data
                echo "Food ID: " . $foodid . "<br>";
                echo "Hunger: " . $foodhunger . "<br>";
                echo "Access: " . $foodaccess . "<br>";
                echo "Name: " . $foodname . "<br><br>";
            }
        } else {
            echo "No food found.";
        }
    }
    echo "---------------------------------------------<br>";

    $query = "SELECT * FROM medicals";
    $result = pg_query($conn, $query);

    if (!$result) {
        // Query execution failed
        echo "Error executing the query: " . pg_last_error($conn);
    } else {
        // Query executed successfully
        if (pg_num_rows($result) > 0) {
            // Iterate over the result set
            while ($row = pg_fetch_assoc($result)) {
                $medid = $row['id'];
                $medhealth = $row['health'];
                $medaccess = $row['accessibility'];
                $medname = $row['names'];

                // Display the zombie data
                echo "Med ID: " . $medid . "<br>";
                echo "Health: " . $medhealth . "<br>";
                echo "Access: " . $medaccess . "<br>";
                echo "Name: " . $medname . "<br><br>";
            }
        } else {
            echo "No medicals found.";
        }
    }
    echo "---------------------------------------------<br>";

    $query = "SELECT * FROM weapons";
    $result = pg_query($conn, $query);

    if (!$result) {
        // Query execution failed
        echo "Error executing the query: " . pg_last_error($conn);
    } else {
        // Query executed successfully
        if (pg_num_rows($result) > 0) {
            // Iterate over the result set
            while ($row = pg_fetch_assoc($result)) {
                $weaponid = $row['id'];
                $weapondamage = $row['damage'];
                $weaponaccess = $row['accessibility'];
                $weaponname = $row['names'];

                // Display the zombie data
                echo "Weapon ID: " . $weaponid . "<br>";
                echo "Damage: " . $weapondamage . "<br>";
                echo "Access: " . $weaponaccess . "<br>";
                echo "Name: " . $weaponname . "<br><br>";
            }
        } else {
            echo "No food weapons.";
        }
    }
    pg_close($conn);
}
?>
