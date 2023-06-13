<?php
    if(isset($_POST['start_simulation'])){
        require_once("database-create.php");
        require_once("database-apocalypse-create.php");
        header("Location: insert-data.php");
    }
?>

<html lang="en">
    <head>
        <title>Zombie Apocalypse Simulation</title>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
    </head>
    <body>
        <div id="container" class="flexbox">
            <div id="main-window" class="flexbox">
                <h2>Welcome to my Zombie Apocalypse Simulator!</h2>
                <h2>To load necessary datas click button below.</h2>
                <button type="submit" onclick="runSimulation()">START</button>
            </div>
        </div>

        <script>
            function runSimulation() {
                // Submit the form when the button is clicked
                document.getElementById("simulation-form").submit();
            }
        </script>
        
        <form id="simulation-form" method="post">
            <input type="hidden" name="start_simulation" value="1">
        </form>
    </body>
</html>