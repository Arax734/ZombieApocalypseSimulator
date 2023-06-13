<html lang="en">
    <head>
        <title>Zombie Apocalypse Simulation</title>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
    </head>
    <body>
        <?php
            require_once("database-apocalypse-connect.php");
            $zombies_number = $_POST["zombies_number"];
            if($zombies_number == 0){
                $zombies_number++;
            }
            $humans_number = $_POST["humans_number"];
            if($humans_number == 0){
                $humans_number++;
            }
        ?>
        <div id="container" style="height: ;" class="flexbox">
            <div id="main-window" class="flexbox">
                <form id="apocdatas" class="flexbox" method="post" action="simulation-insert.php">
                <input type="hidden" name="zombies_number" value="<?php echo $zombies_number; ?>">
                <input type="hidden" name="humans_number" value="<?php echo $humans_number; ?>">
                    <div id="humanoids" class="flexbox">
                    <?php

                        for ($i=0; $i<$zombies_number; $i++){
                            echo "<div class='data-holder flexbox'>
                            <a style='color: green; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>Zombie ".($i+1).":</a>
                            <input type='number' name='zombie_damage".($i+1)."' placeholder='Damage (1-10)' min='1' max='10'>
                            <input type='number' name='zombie_speed".($i+1)."' placeholder='Speed (1-10)' min='1' max='10'>
                        </div>";
                        }

                        for ($i=0; $i<$humans_number; $i++){
                            echo "<div class='data-holder flexbox'>
                            <a style='color: orange; text-shadow: 2px 2px 5px rgba(0, 0, 0, 1);'>Human ".($i+1).":</a>
                            <input type='number' name='human_damage".($i+1)."' placeholder='Damage (1-10)' min='1' max='10'>
                            <input type='number' name='human_speed".($i+1)."' placeholder='Speed (1-10)' min='1' max='10'>
                        </div>";
                        }
                    ?>
                    </div>
                    <div class="data-holder flexbox">
                        <a>Number of large medkits:</a>
                        <input type="number" name="lmedkits_number" placeholder="Number from 0 to 10" min="0" max="10">
                    </div>
                    <div class="data-holder flexbox">
                        <a>Number of medium medkits:</a>
                        <input type="number" name="mmedkits_number" placeholder="Number from 0 to 10" min="0" max="10">
                    </div>
                    <div class="data-holder flexbox">
                        <a>Number of small medkits:</a>
                        <input type="number" name="smedkits_number" placeholder="Number from 0 to 10" min="0" max="10">
                    </div>
                    <div class="data-holder flexbox">
                        <a>Number of porks:</a>
                        <input type="number" name="porks_number" placeholder="Number from 0 to 10" min="0" max="10">
                    </div>
                    <div class="data-holder flexbox">
                        <a>Number of cheeses:</a>
                        <input type="number" name="cheeses_number" placeholder="Number from 0 to 10" min="0" max="10">
                    </div>
                    <div class="data-holder flexbox">
                        <a>Number of apples:</a>
                        <input type="number" name="apples_number" placeholder="Number from 0 to 10" min="0" max="10">
                    </div>
                    <div class="data-holder flexbox">
                        <a>Number of guns:</a>
                        <input type="number" name="guns_number" placeholder="Number from 0 to 10" min="0" max="10">
                    </div>
                    <div class="data-holder flexbox">
                        <a>Number of sticks:</a>
                        <input type="number" name="sticks_number" placeholder="Number from 0 to 10" min="0" max="10">
                    </div>
                    <div class="data-holder flexbox">
                        <a>Number of swords:</a>
                        <input type="number" name="swords_number" placeholder="Number from 0 to 10" min="0" max="10">
                    </div>
                    <button type="submit">CONFIRM</button>
                    <div id="description">
                        <h3>*For zombies and humans default value is 1. For other options default value is 0.</h3>
                    </div>                           
                </form>
            </div>
        </div>
    </body>
</html>