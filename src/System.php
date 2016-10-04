<?php
    class System
    {
        function __construct()
        {
            // deletes everything from planets table
            $GLOBALS['DB']->exec("DELETE FROM planets;");
            $GLOBALS['DB']->exec("DELETE FROM inventory;");
            // get the appropriate number of random numbers from 1-100
            // assign all numbers that aren't on the grid blank planets
            // get the appropriate number of ag planets
            // for each ag planet, pick a random number from the list and create an ag planet
            // for each ind planet, do the same
            // for each fueling station, do the same
        }

        function buildAgriculturalPlanet()
        {
            // gets all needed random values, and creates an agricultural planet
        }

        function buildIndustrialPlanet()
        {
            // gets all needed random values, and creates an industrial planet
        }

        function buildFuelingStation()
        {
            // creates a fueling station
        }

        function buildEmptyPlanet()
        {
            // creates an empty planet
        }

        function getRandomTaboo()
        {
            // gets a string naming the random taboo
            // the taboo is one of the inventory items
        }

        function getRandomSpecialty()
        {
            // gets a string naming the random specialty
            // the specialty is one of the inventory items
        }
    }
 ?>
