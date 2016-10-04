<?php
    class Ship
    {
        private $name;
        private $cargo_capacity;
        private $fuel_capacity;
        private $credits;
        private $location_x;
        private $location_y;
        private $current_fuel;
        private $id;

        function __construct($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id = null)
        {
            $this->name = $name;
            $this->cargo_capacity = $cargo_capacity;
            $this->fuel_capacity = $fuel_capacity;
            $this->credits = $credits;
            $this->location_x = $location_x;
            $this->location_y = $location_y;
            $this->current_fuel = $current_fuel;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function getCargoCapacity()
        {
            return $this->cargo_capacity;
        }

        function getFuelCapacity()
        {
            return $this->fuel_capacity;
        }

        function getCredits()
        {
            return $this->credits;
        }

        function getLocation()
        {
            return array($this->location_x, $this->location_y);
        }

        function getCurrentFuel()
        {
            return $this->current_fuel;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function setCapacities($new_cargo, $new_fuel)
        {
            $this->cargo_capacity = (int) $new_cargo;
            $this->fuel_capacity = (int) $new_fuel;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setCredits($new_credits)
        {
            $this->credits = (int) $new_credits;
        }

        function setLocation($new_x, $new_y)
        {
            $this->location_x = (int) $new_x;
            $this->location_y = (int) $new_y;
        }

        function setCurrentFuel($new_fuel)
        {
            $this->current_fuel = (int) $new_fuel;
        }

        function save()
        {
          $GLOBALS['DB']->exec("INSERT INTO ship (
            name,
            cargo_capacity,
            fuel_capacity,
            credits,
            location_x,
            location_y,
            current_fuel
          ) VALUES (
            '{$this->getName()}',
            {$this->getCargoCapacity()},
            {$this->getFuelCapacity()},
            {$this->getCredits()},
            {$this->getLocation()[0]},
            {$this->getLocation()[1]},
            {$this->getCurrentFuel()}
          );");
          $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_ships = $GLOBALS['DB']->query("SELECT * FROM ship;");
            $ships = array();
            foreach($returned_ships as $ship) {
                $id = $ship['id'];
                $name = $ship['name'];
                $cargo_capacity = $ship['cargo_capacity'];
                $fuel_capacity = $ship['fuel_capacity'];
                $credits = $ship['credits'];
                $location_x = $ship['location_x'];
                $location_y = $ship['location_y'];
                $current_fuel = $ship['current_fuel'];
                $new_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
                array_push($ships, $new_ship);
            }
            return $ships;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM ship;");
            $GLOBALS['DB']->exec("DELETE FROM cargo;");
        }

        static function find($search_id)
        {
            $found_ship = null;
            $ships = Ship::getAll();
            foreach($ships as $ship) {
                $ship_id = $ship->getId();
                if ($ship_id == $search_id) {
                  $found_ship = $ship;
                }
            }
            return $found_ship;
        }

        function update()
        {
            $GLOBALS['DB']->exec("UPDATE ship SET
            name = '{$this->getName()}',
            cargo_capacity = {$this->getCargoCapacity()},
            fuel_capacity = {$this->getFuelCapacity()},
            credits = {$this->getCredits()},
            location_x = {$this->getLocation()[0]},
            location_y = {$this->getLocation()[1]},
            current_fuel = {$this->getCurrentFuel()}
            WHERE id = {$this->getId()};");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM ship WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM cargo WHERE ship_id = {$this->getId()};");
        }

        function getDistance($destination_x, $destination_y)
        {
            $delta_x = abs($destination_x - $this->getLocation()[0]);
            $delta_y = abs($destination_y - $this->getLocation()[1]);
            return ceil(sqrt(pow($delta_x, 2) + pow($delta_y, 2)));
        }

        function checkTravelRange($destination_x, $destination_y)
        {
            $distance = $this->getDistance($destination_x, $destination_y);
            if ($distance * 10 <= $this->getCurrentFuel()) {
                return true;
            } else {
                return false;
            }
        }

        function travel($destination_x, $destination_y)
        {
            if ($this->checkTravelRange($destination_x, $destination_y)) {
                $distance = $this->getDistance($destination_x, $destination_y);
                $this->setLocation($destination_x, $destination_y);
                $this->current_fuel -= $distance * 10;
                $this->credits -= 2000;
            } else {
                return;
            }
        }

    }
?>
