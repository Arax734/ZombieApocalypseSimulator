<?php
    if(isset($_POST['start_simulation'])){
        require_once("clear-database.php");
        header("Location: index.php");
    }
?>

<html lang="en">
    <head>
        <title>Zombie Apocalypse Simulation</title>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
    </head>
    <body>
        <div id="container" class="flexbox">
            <div id="main-window" class="flexbox simulation">
            <?php
                    require_once("database-apocalypse-connect.php");
                    // Select number of humans
                    $numberQuery = "SELECT COUNT(*) as num FROM humans";
                    $numberResult = pg_query($conn, $numberQuery);
                    $number = pg_fetch_assoc($numberResult);

                    // Select number of zombies
                    $numberzQuery = "SELECT COUNT(*) as num FROM zombies";
                    $numberzResult = pg_query($conn, $numberzQuery);
                    $numberz = pg_fetch_assoc($numberzResult);

                    $canpick = array();

                    for($x=0; $x<$number['num']; $x++){

                        // Select one human and one zombie for interaction
                        $humanQuery = "SELECT * FROM humans ORDER BY RANDOM() LIMIT 1";
                        $zombieQuery = "SELECT * FROM zombies ORDER BY RANDOM() LIMIT 1";
                        $humanResult = pg_query($conn, $humanQuery);
                        $zombieResult = pg_query($conn, $zombieQuery);            

                        if ($humanResult && $zombieResult) {
                            $human = pg_fetch_assoc($humanResult);
                            $zombie = pg_fetch_assoc($zombieResult);

                            // Humans becoming more hungry
                            $query = "UPDATE humans SET hunger = hunger - 5 WHERE id = ".$human['id'].";";
                            $result = pg_query($conn, $query);

                            // 
                            if($human['hunger']<=0){
                                $queryid = "SELECT MAX(id)+1 as max FROM zombies";
                                $queryresult = pg_query($conn, $queryid);
                                $qs = pg_fetch_assoc($queryresult);
                                $qsnum = $qs['max'];
                                $damage = $human['damage'];
                                $speed = $human['speed'];

                                echo "<a><span style='color:orange; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>Human ".$human['id']."</span> died
                                from <span style='color:red; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>hunger</span> and turned
                                into <span style='color:green; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>zombie.</span></a>";

                                $query = "INSERT INTO zombies(id,damage,speed,health) VALUES
                                ('$qsnum','$damage', '$speed', 100);
                                
                                DELETE FROM humans WHERE id=".$human['id'].";";

                                $result = pg_query($conn, $query);
                                continue;
                            }

                            // Turning into zombie
                            if($human['health']<=0){
                                $queryid = "SELECT MAX(id)+1 as max FROM zombies";
                                $queryresult = pg_query($conn, $queryid);
                                $qs = pg_fetch_assoc($queryresult);
                                $qsnum = $qs['max'];
                                $damage = $human['damage'];
                                $speed = $human['speed'];

                                echo "<a><span style='color:orange; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>Human ".$human['id']."</span> turned
                                into <span style='color:green; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>zombie</span>.</a>";

                                $query = "INSERT INTO zombies(id,damage,speed,health) VALUES
                                ('$qsnum','$damage', '$speed', 100);
                                
                                DELETE FROM humans WHERE id=".$human['id'].";";

                                $result = pg_query($conn, $query);
                                continue;
                            }

                            // Zombie is dead
                            if ($zombie['health'] <= 0) {
                                if (!empty($zombie['id'])) {
                                    $query = "DELETE FROM zombies WHERE id=" . $zombie['id'] . ";";
                                    $result = pg_query($conn, $query);
                            
                                    if ($result) {
                                        echo "<a><span style='color:green; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>Zombie " . $zombie['id'] . "</span> has been <span style='color:red; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>killed</span></a>";
                                    } else {
                                        echo "Failed to delete the zombie.";
                                    }
                                } else {
                                    echo "";
                                }
                                
                                continue;
                            }                            
                            

                            // Fight simulation
                            if($human['speed']>$zombie['speed']){
                                $query = "UPDATE zombies SET health = health - ".$human['damage']." WHERE id = ".$zombie['id'].";";
                                $result = pg_query($conn, $query);
                                echo "<a><span style='color:orange; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>Human ".$human['id']."</span> inflicted 
                                <span style='color:red; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>".$human['damage']." 
                                </span>points of damage on <span style='color:green; 
                                text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>zombie ".$zombie['id']."</span>.</a>";
                            }
                            if($human['speed']<=$zombie['speed']){
                                $query = "UPDATE humans SET health = health - ".$zombie['damage']." WHERE id = ".$human['id'].";";
                                $result = pg_query($conn, $query);
                                echo "<a><span style='color:green; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>Zombie ".$zombie['id']."</span> inflicted 
                                <span style='color:red; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>".$zombie['damage']." 
                                </span>points of damage on <span style='color:orange; 
                                text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>human ".$human['id']."</span>.</a>";
                            }
                            
                            // Picking random ID of item which can be used
                            $randomNumber = rand(1, 50);

                            // Checking if medkit exist
                            $querymed = "SELECT * FROM medicals WHERE accessibility = $1 LIMIT 1";
                            $params = array($randomNumber);
                            $resultmed = pg_query_params($conn, $querymed, $params);
                            $qsmed = pg_fetch_assoc($resultmed);

                            if (pg_num_rows($resultmed) > 0) {
                                $query = "UPDATE humans SET health = health + ".$qsmed['health']." WHERE id = ".$human['id'].";";
                                $result = pg_query($conn, $query);
                                echo "<a><span style='color:orange; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>Human ".$human['id']."</span>
                                used <span style='color:plum; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>".$qsmed['names']."</span>.</a>";

                                $query = "DELETE FROM medicals WHERE id=".$qsmed['id'].";";
                                $result = pg_query($conn, $query);
                            }

                            // Checking if food exists
                            $queryfood = "SELECT * FROM food WHERE accessibility = $1 LIMIT 1";
                            $params = array($randomNumber);
                            $resultfood = pg_query_params($conn, $queryfood, $params);
                            $qsfood = pg_fetch_assoc($resultfood);

                            if (pg_num_rows($resultfood) > 0) {
                                $query = "UPDATE humans SET hunger = hunger + ".$qsfood['hunger']." WHERE id = ".$human['id'].";";
                                $result = pg_query($conn, $query);
                                echo "<a><span style='color:orange; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>Human ".$human['id']."</span>
                                ate <span style='color:yellow; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>".$qsfood['names']."</span>.</a>";

                                $query = "DELETE FROM food WHERE id=".$qsfood['id'].";";
                                $result = pg_query($conn, $query);
                            }

                            // Checking if human already has a weapon
                            $querycheck = "SELECT * FROM humans WHERE id = ".$human['id'];
                            $resultcheck = pg_query($conn, $querycheck);

                            

                            $weaponId = $row['weapon_id'];
                            if ($weaponId !== null) {
                                $canpick[] = $human['id'];
                            }

                            // Checking if weapon exist
                            $querywep = "SELECT * FROM weapons WHERE accessibility = $1 LIMIT 1";
                            $params = array($randomNumber);
                            $resultwep = pg_query_params($conn, $querywep, $params);
                            $qswep = pg_fetch_assoc($resultwep);

                            if (in_array($human['id'], $canpick)) {
                                continue;
                            }else{
                                if (pg_num_rows($resultwep) > 0 ){

                                    // Checking if wep is not taken
                                    $querytaken = "SELECT * FROM humans WHERE weapon_id = $1 LIMIT 1";
                                    $params = array($qswep['id']);
                                    $resulttaken = pg_query_params($conn, $querytaken, $params);
                                    $qstaken = pg_fetch_assoc($resulttaken);
    
                                    if (pg_num_rows($resulttaken) > 0) {
                                        continue;
                                    }
    
                                    $query = "UPDATE humans SET weapon_id = ".$qswep['id']." WHERE id = ".$human['id'].";";
                                    $result = pg_query($conn, $query);
                                    echo "<a><span style='color:orange; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>Human ".$human['id']."</span>
                                    took <span style='color:white; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>".$qswep['names']."</span>.</a>";
                                    $query2 = "UPDATE humans SET damage = damage + ".$qswep['damage']." WHERE id = ".$human['id'].";";
                                    $result2 = pg_query($conn, $query2);
                                }
                            }
                        }
                    }
                    // Select number of humans
                    $numberQuery = "SELECT COUNT(*) as num FROM humans";
                    $numberResult = pg_query($conn, $numberQuery);
                    $number = pg_fetch_assoc($numberResult);

                    // Select number of zombies
                    $numberZombiesQuery = "SELECT COUNT(*) as num FROM zombies";
                    $numberZombiesResult = pg_query($conn, $numberZombiesQuery);
                    $numberZombies = pg_fetch_assoc($numberZombiesResult);

                    if($numberZombies['num']<=0){
                        echo "<a><span style='color:orange; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>
                        Humans survived the apocalypse!</span></a>";
                        echo "<button type='submit' onclick='finishsimulation()'>FINISH</button>";
                    }
                    elseif($number['num']<=0){
                        echo "<a><span style='color:green; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>
                        There are no humans left. Zombies won!</span></a>";
                        echo "<button type='submit' onclick='finishsimulation()'>FINISH</button>";
                    }
                    else{
                        echo "<button type='submit' onclick='continuesimulation()'>CONTINUE</button>";
                    }
                ?>
                <form id="simulation-form" method="post">
                    <input type="hidden" name="start_simulation" value="1">
                </form>
            </div>
        </div>

        <script>
            function continuesimulation() {
                location.reload();
            }
            function finishsimulation() {
                document.getElementById("simulation-form").submit();
            }
        </script>
    </body>
</html>