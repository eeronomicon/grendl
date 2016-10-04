<?php
    class Planet
    {
        private $x;
        private $y;
        private $type;
        private $population;
        private $specialty;
        private $regular;
        private $controlled;
        private $id;

        function __construct($x, $y, $type, $population, $regular, $specialty, $controlled, $id = null)
        {
            // based on population, specialty, and controlled, initial inventory levels will be set
            $this->x = $x;
            $this->y = $y;
            $this->type = $type;
            $this->population = $population;
            $this->specialty = $specialty;
            $this->regular = $regular;
            $this->controlled = $controlled;
            $this->id = $id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO planets (location_x, location_y, type, population, specialty, regular, controlled) VALUES ({$this->x}, {$this->y}, {$this->type}, {$this->population}, {$this->specialty}, {$this->regular}, {$this->controlled});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function setInitialInventory()
        {
            // sets initial inventory and saves initial Market Values to the join table
            $var_string = 'pop_' . $this->population . '_max_inventory';
            $returned_max_inventories = $GLOBALS['DB']->query("SELECT * FROM parameters WHERE name = '{$var_string}';");
            $returned_max_inventories = $returned_max_inventories->fetch(PDO::FETCH_BOTH);
            $max_inventory = (int)($returned_max_inventories['value'] * .8);
            $first_quantity = rand($max_inventory * .5, $max_inventory * .8);
            $second_quantity = $max_inventory - $first_quantity;
            $GLOBALS['DB']->exec("UPDATE inventory SET quantity = {$first_quantity} WHERE id_planets = {$this->id} AND id_tradegoods = {$this->specialty};");
            $GLOBALS['DB']->exec("UPDATE inventory SET quantity = {$second_quantity} WHERE id_planets = {$this->id} AND id_tradegoods = {$this->regular};");
        }

        function getQuantities()
        {
            // returns the inventory as an array of eight values
            $returned_inventories = $GLOBALS['DB']->query("SELECT * FROM inventory WHERE id_planets = {$this->id};");
            $quantities = array();
            foreach ($returned_inventories as $inventory) {
                $quantity = (int)$inventory['quantity'];
                $id = $inventory['id_tradegoods'];
                $name = Planet::getTradegoodNameById($id);
                $temp_array = array($name => $quantity);
                $quantities = array_merge($quantities, $temp_array);
            }
            return $quantities;
        }

        function buildMarket()
        {
            // when initialized, a planet builds a market
            for ($i = 1; $i < 9; $i++) {
                $GLOBALS['DB']->exec("INSERT INTO inventory (id_planets, id_tradegoods, quantity, price) VALUES ({$this->id}, {$i}, 0, 0);");
            }
        }

        function getMarketValues()
        {
            //return the trade goods market values as an array
            $returned_inventories = $GLOBALS['DB']->query("SELECT * FROM inventory WHERE id_planets = {$this->id};");
            $prices = array();
            foreach ($returned_inventories as $inventory) {
                $price = (int)$inventory['price'];
                $id = $inventory['id_tradegoods'];
                $name = Planet::getTradegoodNameById($id);
                $temp_array = array($name => $price);
                $prices = array_merge($prices, $temp_array);
            }
            return $prices;
        }

        function setMarketValues()
        {
            // if this is a fueling station or an empty planet, nothing happens
            if ($this->type == 0 || $this->type == 3) {
                return;
            }
            // calculate the price of a robot using the parameters
            // saves that to the Inventory Join Table
            $returned_inventories = $GLOBALS['DB']->query("SELECT * FROM inventory WHERE id_planets = {$this->id};");
            $returned_base_prices = $GLOBALS['DB']->query("SELECT price FROM tradegoods;");
            $returned_base_prices = $returned_base_prices->fetchAll(PDO::FETCH_ASSOC);
            $index = 1;
            // pulls factor mins and maxes from the parameters table
            $returned_factors = $GLOBALS['DB']->query("SELECT * FROM parameters WHERE type = 'type_factor' OR type = 'pop_factor' OR type = 'specialty_factor' OR type = 'controlled_factor';");
            $type_match_min_factor;
            $type_match_max_factor;
            $type_mismatch_min_factor;
            $type_mismatch_max_factor;
            $pop_1_min_factor;
            $pop_1_max_factor;
            $pop_2_min_factor;
            $pop_2_max_factor;
            $pop_3_min_factor;
            $pop_3_max_factor;
            $specialty_min_factor;
            $specialty_max_factor;
            $controlled_min_factor;
            $controlled_max_factor;
            foreach($returned_factors as $factor) {
                $name = $factor['name'];
                ${$name} = $factor['value'];
            }
            // runs through inventories and sets prices
            foreach($returned_inventories as $inventory) {
                //gets the base price of the current inventory item
                $base_price = (int)$returned_base_prices[$index - 1]['price'];
                //sets the planet type factor to later calculate item market value
                $planet_type_factor;
                if ($this->type == 1 and $index < 5) {
                    $planet_type_factor = rand($type_match_min_factor, $type_match_max_factor) / 100;
                } else {
                    $planet_type_factor = rand($type_mismatch_min_factor, $type_mismatch_max_factor) / 100;
                }
                //sets population factor
                $population_factor; // pull from the database , assign random
                if ($this->population == 1) {
                    $population_factor = rand($pop_1_min_factor, $pop_1_max_factor) / 100;
                } elseif ($this->population == 2) {
                    $population_factor = rand($pop_2_min_factor, $pop_2_max_factor) / 100;
                } else {
                    $population_factor = rand($pop_3_min_factor, $pop_3_max_factor) / 100;
                }
                //sets specialty factor
                $specialty_factor;
                if ($this->specialty == $inventory['id_tradegoods']) {
                    $specialty_factor = rand($specialty_min_factor, $specialty_max_factor) / 100;
                } else {
                    $specialty_factor = 1;
                }
                //sets controlled factor
                $controlled_factor;
                if ( $this->controlled == $inventory['id_tradegoods']) {
                    $controlled_factor = rand($controlled_min_factor, $controlled_max_factor) / 100;
                } else {
                    $controlled_factor = 1;
                }
                //calculate price using the above data
                $price = $base_price * $planet_type_factor * $population_factor * $specialty_factor * $controlled_factor;
                //push new price to the database
                $GLOBALS['DB']->exec("UPDATE inventory SET price = {$price} WHERE id_planets = {$this->id} AND id = {$inventory['id']};");
                //increments the index before running through loop again
                $index++;
            }
        }

        function incrementQuantities()
        {
            // get maximum inventory level
            $var_string = 'pop_' . $this->population . '_max_inventory';
            $returned_max_inventories = $GLOBALS['DB']->query("SELECT * FROM parameters WHERE name = '{$var_string}';");
            $returned_max_inventories = $returned_max_inventories->fetch(PDO::FETCH_BOTH);
            $max_inventory = (int)$returned_max_inventories['value'];
            // if maximum inventory level is already exceded, method stops here
            $inventories = $this->getQuantities();
            if (array_sum($inventories) >= $max_inventory) {
                return;
            }
            // get inventory increment parameters
            $returned_parameters = $GLOBALS['DB']->query("SELECT * FROM parameters WHERE type = 'increment_percent';");
            $inventory_increment_min_percent;
            $inventory_increment_max_percent;
            $increment_specialty_share;
            $increment_regular_share;
            foreach ($returned_parameters as $parameter) {
                ${$parameter['name']} = $parameter['value'];
            }
            // set increment amounts
            $rando = rand($inventory_increment_min_percent, $inventory_increment_max_percent);
            $increment_amount = (int)($max_inventory * ($rando / 100));
            $specialty_increment_amount = (int)(($increment_specialty_share / 100) * $increment_amount);
            $regular_increment_amount = $increment_amount - $specialty_increment_amount;
            // increment inventory values
            $GLOBALS['DB']->exec("UPDATE inventory SET quantity = quantity + {$specialty_increment_amount} WHERE id_tradegoods = {$this->specialty} AND id_planets = {$this->id};");
            $GLOBALS['DB']->exec("UPDATE inventory SET quantity = quantity + {$regular_increment_amount} WHERE id_tradegoods = {$this->regular} AND id_planets = {$this->id};");
        }

        // static functions
        static function findById($search_id)
        {
            $returned_planets = $GLOBALS['DB']->query("SELECT * FROM planets WHERE id = {$search_id};");
            foreach ($returned_planets as $planet) {
                $x = $planet['location_x'];
                $y = $planet['location_y'];
                $type = $planet['type'];
                $population = $planet['population'];
                $specialty = $planet['specialty'];
                $regular = $planet['regular'];
                $controlled = $planet['controlled'];
                $id = $planet['id'];
                $new_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled, $id);
                return $new_planet;
            }
        }

        static function getAllOccupiedPlanets()
        {
            $returned_planets = $GLOBALS['DB']->query("SELECT * FROM planets WHERE type = 1 OR type = 2 OR type = 3;");
            $planets = array();
            foreach ($returned_planets as $planet) {
                $x = $planet['location_x'];
                $y = $planet['location_y'];
                $type = $planet['type'];
                $population = $planet['population'];
                $specialty = $planet['specialty'];
                $regular = $planet['regular'];
                $controlled = $planet['controlled'];
                $id = $planet['id'];
                $new_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled, $id);
                array_push($planets, $new_planet);
            }
            return $planets;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM planets;");
        }

        static function getAll()
        {
            $returned_planets = $GLOBALS['DB']->query("SELECT * FROM planets;");
            $planets = array();
            foreach ($returned_planets as $planet) {

                $x = $planet['location_x'];
                $y = $planet['location_y'];
                $type = $planet['type'];
                $population = $planet['population'];
                $specialty = $planet['specialty'];
                $regular = $planet['regular'];
                $controlled = $planet['controlled'];
                $id = $planet['id'];
                $new_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled, $id);
                array_push($planets, $new_planet);
            }
            return $planets;
        }

        static function findByCoordinates($x, $y)
        {
            $returned_planets = $GLOBALS['DB']->query("SELECT * FROM planets WHERE location_x = {$x} AND location_y = {$y};");
            foreach($returned_planets as $planet) {
                return Planet::findById($planet['id']);
            }
        }

        static function getTradegoodNameById($id)
        {
            $returned_name = $GLOBALS['DB']->query("SELECT name FROM tradegoods WHERE id = {$id};");
            $name = $returned_name->fetch(PDO::FETCH_ASSOC);
            return $name['name'];
        }

        // getters and setters
        function getX()
        {
            return $this->x;
        }

        function getY()
        {
            return $this->y;
        }

        function getType()
        {
            return $this->type;
        }

        function getPopulation()
        {
            return $this->population;
        }

        function getSpecialty()
        {
            return $this->specialty;
        }

        function getControlled()
        {
            return $this->controlled;
        }

        function getId()
        {
            return $this->id;
        }

    }
 ?>
