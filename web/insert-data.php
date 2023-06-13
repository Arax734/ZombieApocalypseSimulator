<html lang="en">
    <head>
        <title>Zombie Apocalypse Simulation</title>
        <link rel="stylesheet" type="text/css" href="styles/main.css">
    </head>
    <body>
        <div id="container" class="flexbox">
            <div id="main-window" class="flexbox">
                <form id="apocdatas" class="flexbox" method="post" action="edit.php">
                    <div class="data-holder flexbox">
                        <a>Number of zombies:</a>
                        <input type="number" name="zombies_number" placeholder="Number from 1 to 10" min="1" max="10">
                    </div>
                    <div class="data-holder flexbox">
                        <a>Number of humans:</a>
                        <input type="number" name="humans_number" placeholder="Number from 1 to 10" min="1" max="10">
                    </div>
                    <button type="submit" name="confirm">CONFIRM</button>
                    <div id="description">
                        <h3>*Default value is 1.</h3>
                    </div>                           
                </form>
            </div>
        </div>
    </body>
</html>
