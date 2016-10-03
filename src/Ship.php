<?php
    class Ship
    {
        private $name;
        private $cargo_capacity;
        private $fuel_capacity;
        private $credits;
        private $location_x;
        private $location_y;
        private $id;

        function __construct($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $id = null)
        {
            $this->name = $name;
            $this->cargo_capacity = $cargo_capacity;
            $this->fuel_capacity = $fuel_capacity;
            $this->credits = $credits;
            $this->location_x = $location_x;
            $this->location_y = $location_y;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function save()
        {
          $GLOBALS['DB']->exec("INSERT INTO ships (name) VALUES ('{$this->getName()}')");
          $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_ship = $GLOBALS['DB']->query("SELECT * FROM ships ORDER BY name;");
            $ships = array();
            foreach($returned_ship as $ship) {
                $name = $ship['name'];
                $id = $ship['id'];
                $new_ship = new Ship($name, $id);
                array_push($ships, $new_ship);
            }
            return $ships;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM ships;");
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

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE ships SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM ships WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM cargo WHERE ship_id = {$this->getId()};");
        }

    }
?>
