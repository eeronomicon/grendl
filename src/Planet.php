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
            $first_percentage = rand(6, 10);
            $first_quantity = $first_percentage * 10;
            $second_quantity = 100 - $first_quantity;
            $GLOBALS['DB']->exec("UPDATE inventory SET quantity = {$first_quantity} WHERE id_planets = {$this->id} AND id_tradegoods = {$this->specialty};");
            $GLOBALS['DB']->exec("UPDATE inventory SET quantity = {$second_quantity} WHERE id_planets = {$this->id} AND id_tradegoods = {$this->regular};");
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
                $price = $inventory['price'];
                array_push($prices, $price);
            }
            return $prices;
        }

        function setMarketValues()
        {
            // calculate the price of a robot using the parameters
            // saves that to the Inventory Join Table
            $returned_inventories = $GLOBALS['DB']->query("SELECT * FROM inventory WHERE id_planets = {$this->id};");
            $returned_base_prices = $GLOBALS['DB']->query("SELECT price FROM tradegoods;");
            $returned_base_prices = $returned_base_prices->fetchAll(PDO::FETCH_ASSOC);
            $index = 1;
            foreach($returned_inventories as $inventory) {
                //gets the base price of the current inventory item
                $base_price = (int)$returned_base_prices[$index - 1]['price'];
                //sets the planet type factor to later calculate item market value
                $planet_type_factor;
                if ($this->type == 1 and $index < 5) {
                    $planet_type_factor = rand(25, 50) / 100;
                } else {
                    $planet_type_factor = rand(150, 200) / 100;
                }
                //sets population factor
                $population_factor; // pull from the database , assign random
                if ($this->population == 1) {
                    $population_factor = rand(50, 75) / 100;
                } elseif ($this->population == 2) {
                    $population_factor = 1;
                } else {
                    $population_factor = rand(150, 200) / 100;
                }
                //sets specialty factor
                $specialty_factor;
                if ($this->specialty == $inventory['id_tradegoods']) {
                    $specialty_factor = rand(25, 50) / 100;
                } else {
                    $specialty_factor = 1;
                }
                //sets controlled factor
                $controlled_factor;
                if ( $this->controlled == $inventory['id_tradegoods']) {
                    $controlled_factor = rand(150, 200) / 100;
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
