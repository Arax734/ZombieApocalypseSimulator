# Zombie Apocalypse Simulator

# Building Application
Before starting, make sure that Docker, PHP (php.ini must be edited correctly to work on the PostgreSQL database) and PostgreSQL are installed on our computer.

The first step is to create the corresponding files in our project folder: dockerfile and docker-compose.yml. We need to configure these appropriately to create the images that will be used to build our container.

In our case, we need to configure the address of our database and Apache server. We define that both will run on localhost (Apache on port 8080, database on port 5432).

After saving the files properly, we can launch our folder in a terminal, where we type the following command:

    docker-compose up -d --build

To check that everything is working, we can view the state of the container in Docker:

![enter image description here](https://i.imgur.com/zUZIAdI.png)

We can now proceed to launch the application by entering "**localhost:8080**".

We will see a window that informs us that a database has been created. After clicking the button, the database and the corresponding table structures will be created.

In the next window, we need to provide information on the number of zombies and humans. In my simulation we can choose 1-10, but this is easily modifiable if we would like to change it.

We can then select specific values for each creature: speed and damage. In addition, we are able to determine how much food, first aid kits and weapons of specific types will be available.

**NOTE: Remember not to use the return arrow in the browser. This may lead to errors that we will have to fix manually by going to a specific file: deleting the database. To prevent this, you need to make additional safeguards, which have not been done in the current version of the project.**

# Simulation Principles:

The simulation rules work on simple rules. If we want them to work more advanced they need to be tweaked.

We start by choosing a random zombie and a human. We then check which one has the greater speed. Whoever has the greater speed attacks. During one turn, each human's hunger increases. If the hunger reaches 0, the human dies and, through a virus that also spreads through the air, turns into a zombie. The transformation records the speed and damage of the human. The same applies if a human is defeated by a zombie. Once a zombie dies, it cannot return to the living. 

Each item has a randomly generated number. During a turn, the human also draws its number. If such a number exists in the base for any item it is used. Food adds hunger points, first aid kits add life, raised weapons increase the damage dealt. 

**NOTE: In this simulation we recognise that hunger can exceed the value of 100 and thus a person can eat to spare. The same situation works with first aid kits.**

When the simulation is complete, a message is displayed telling us the result and we can press a button that will send us to the main page and clear the database.

**I recommend pressing it because otherwise when we start the simulation again we will get an error when creating the database because it will not be cleared.**
