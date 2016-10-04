<?php
    class System
    {
        function __construct()
        {
            // deletes everything from planets table
            $GLOBALS['DB']->exec("DELETE FROM planets;");
            $GLOBALS['DB']->exec("DELETE FROM inventory;");
            // get parameters from table
            $returned_parameters = $GLOBALS['DB']->query("SELECT * FROM parameters WHERE type = 'system_setup';");
            $min_planet_density;
            $max_planet_density;
            $universe_size_sqrt;
            $ag_planet_share;
            $in_planet_share;
            $fuel_planet_share;
            foreach ($returned_parameters as $parameter) {
                ${$parameter['name']} = $parameter['value'];
            }
            // set universe size and number of planets
            $universe_size = $universe_size_sqrt * $universe_size_sqrt;
            $rando = rand($min_planet_density, $max_planet_density);
            $number_of_planets = ($rando / 100) * $universe_size;
            // get the appropriate number of random numbers from 1-100
            $possible_planet_locations = array();
            while (sizeof($possible_planet_locations) < $number_of_planets) {
                $rando1 = rand(1, $universe_size_sqrt);
                $rando2 = rand(1, $universe_size_sqrt);
                if (!in_array([$rando1, $rando2], $possible_planet_locations)) {
                    array_push($possible_planet_locations, [$rando1, $rando2]);
                }
            }
            // assign all numbers that aren't on the grid blank planets
            for ($i = 1; $i <= $universe_size_sqrt; $i++) {
                for ($j = 1; $j <= $universe_size_sqrt; $j++) {
                    if (!in_array([$i, $j], $possible_planet_locations)) {
                        $this->buildEmptyPlanet($i, $j);
                    }
                }
            }
            // get the appropriate number of ag planets and create them
            $number_of_ag_planets = (int)$number_of_planets * ($ag_planet_share / 100);
            for($i = 0; $i < $number_of_ag_planets; $i++) {
                $location = array_pop($possible_planet_locations);
                // create an ag planet
                $this->buildAgriculturalPlanet($location[0], $location[1]);
            }
            // for each ind planet, do the same
            $number_of_in_planets = (int)$number_of_planets * ($in_planet_share / 100);
            for($i = 0; $i < $number_of_in_planets; $i++) {
                $location = array_pop($possible_planet_locations);
                // create an in planet
                $this->buildIndustrialPlanet($location[0], $location[1]);
            }
            // for each fueling station, do the same
            $number_of_fuel_planets = $number_of_planets - $number_of_in_planets - $number_of_ag_planets;
            for($i = 0; $i < $number_of_fuel_planets; $i++) {
                $location = array_pop($possible_planet_locations);
                // create a fuel planet
                $this->buildFuelingStation($location[0], $location[1]);
            }
        }

        function buildAgriculturalPlanet($x, $y)
        {
            // get needed random values
            $type = 1;
            $population = rand(1, 3);
            $regular = rand(1, 8);
            $specialty = rand(1, 4);
            while ($specialty == $regular) {
                $specialty = rand(1, 4);
            }
            $controlled = rand(5, 8);
            while ($controlled == $regular) {
                $regular = rand(5, 8);
            }
            // create the planet
            $new_ag_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $new_ag_planet->save();
            // set the initial values
            $new_ag_planet->buildMarket();
            $new_ag_planet->setInitialInventory();
            $new_ag_planet->setMarketValues();
        }

        function buildIndustrialPlanet($x, $y)
        {
            // get needed random values
            $type = 2;
            $population = rand(1, 3);
            $regular = rand(1, 8);
            $specialty = rand(5, 8);
            while ($specialty == $regular) {
                $specialty = rand(5, 8);
            }
            $controlled = rand(1, 4);
            while ($controlled == $regular) {
                $regular = rand(1, 4);
            }
            // create the planet
            $new_in_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $new_in_planet->save();
            // set the initial values
            $new_in_planet->buildMarket();
            $new_in_planet->setInitialInventory();
            $new_in_planet->setMarketValues();
        }

        function buildFuelingStation($x, $y)
        {
            // creates a fueling station
            $type = 3;
            $new_fuel_planet = new Planet($x, $y, $type, 0, 0, 0, 0);
            $new_fuel_planet->save();
        }

        function buildEmptyPlanet($x, $y)
        {
            // creates an empty planet
            $type = 0;
            $new_empty_planet = new Planet($x, $y, $type, 0, 0, 0, 0);
            $new_empty_planet->save();
        }
    // static functions
        static function nextTurn()
        {
            $occupied_planets = Planet::getAllOccupiedPlanets();
            foreach($occupied_planets as $planet) {
                $planet->incrementQuantities();
                $planet->setMarketValues();
            }
        }

    }
 ?>
