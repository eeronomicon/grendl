<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Ship.php";
    require_once "src/Cargo.php";
    require_once "src/TradeGood.php";

    $server = 'mysql:host=localhost;dbname=space_truckin_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ShipTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Ship::deleteAll();
            Cargo::deleteAll();
        }

        function test_buyTradeGood()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 30;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $turn = 1, $id);
            $test_ship->save();
            $test_ship->initializeCargo();
            $ship_inventory = array(
                ["Ore", 10],
                ["Grain", 0],
                ["Livestock", 10],
                ["Consumables", 0],
                ["Consumer Goods", 10],
                ["Heavy Machinery", 10],
                ["Military Hardware", 10],
                ["Robots", 0]
            );
            foreach ($ship_inventory as $line_item) {
                $cargo = $test_ship->findCargo($line_item[0]);
                $cargo->update($line_item[1]);
            }
            $type = "Livestock";
            $quantity = 10;
            $unit_price = 100;
            // Act
            $test_ship->buyTradeGood($type, $quantity, $unit_price);
            $result = array($test_ship->findCargo($type)->getQuantity(), $test_ship->getCredits());
            // Assert
            $this->assertEquals([20, $credits - ($quantity * $unit_price)], $result);
        }

        function test_sellTradeGood()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 30;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $turn = 1, $id);
            $test_ship->save();
            $test_ship->initializeCargo();
            $ship_inventory = array(
                ["Ore", 10],
                ["Grain", 0],
                ["Livestock", 10],
                ["Consumables", 0],
                ["Consumer Goods", 0],
                ["Heavy Machinery", 0],
                ["Military Hardware", 30],
                ["Robots", 0]
            );
            foreach ($ship_inventory as $line_item) {
                $cargo = $test_ship->findCargo($line_item[0]);
                $cargo->update($line_item[1]);
            }
            $type = "Military Hardware";
            $quantity = 10;
            $unit_price = 10000;
            // Act
            $test_ship->sellTradeGood($type, $quantity, $unit_price);
            $result = array($test_ship->findCargo($type)->getQuantity(), $test_ship->getCredits());
            // Assert
            $this->assertEquals([20, $credits + ($quantity * $unit_price)], $result);
        }

    }
?>
