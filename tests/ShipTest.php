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

        function test_getId()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 50;
            $fuel_capacity = 50;
            $credits = 20000;
            $location_x = 0;
            $location_y = 0;
            $current_fuel = 20;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            // Act
            $result = $test_ship->getId();
            // Assert
            $this->assertEquals($id, $result);
        }

        function test_getName()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 50;
            $fuel_capacity = 50;
            $credits = 20000;
            $location_x = 0;
            $location_y = 0;
            $current_fuel = 20;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            // Act
            $result = $test_ship->getName();
            // Assert
            $this->assertEquals($name, $result);
        }

        function test_getCargoCapacity()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 50;
            $fuel_capacity = 50;
            $credits = 20000;
            $location_x = 0;
            $location_y = 0;
            $current_fuel = 20;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            // Act
            $result = $test_ship->getCargoCapacity();
            // Assert
            $this->assertEquals($cargo_capacity, $result);
        }

        function test_getFuelCapacity()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 0;
            $location_y = 0;
            $current_fuel = 20;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            // Act
            $result = $test_ship->getFuelCapacity();
            // Assert
            $this->assertEquals($fuel_capacity, $result);
        }

        function test_getCredits()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 0;
            $location_y = 0;
            $current_fuel = 20;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            // Act
            $result = $test_ship->getCredits();
            // Assert
            $this->assertEquals($credits, $result);
        }

        function test_getLocation()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 20;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            // Act
            $result = $test_ship->getLocation();
            // Assert
            $this->assertEquals([$location_x, $location_y], $result);
        }

        function test_getCurrentFuel()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 0;
            $location_y = 0;
            $current_fuel = 30;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            // Act
            $result = $test_ship->getCurrentFuel();
            // Assert
            $this->assertEquals($current_fuel, $result);
        }

        function test_setId()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 20;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $new_value = 6;
            // Act
            $test_ship->setId($new_value);
            $result = $test_ship->getId();
            // Assert
            $this->assertEquals($new_value, $result);
        }

        function test_setName()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 20;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $new_value = "Grendel";
            // Act
            $test_ship->setName($new_value);
            $result = $test_ship->getName();
            // Assert
            $this->assertEquals($new_value, $result);
        }

        function test_setCapacities()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 20;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $new_value1 = 30;
            $new_value2 = 70;
            // Act
            $test_ship->setCapacities($new_value1, $new_value2);
            $result = array($test_ship->getCargoCapacity(), $test_ship->getFuelCapacity());
            // Assert
            $this->assertEquals([$new_value1, $new_value2], $result);
        }

        function test_setCredits()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 20;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $new_value = 60000;
            // Act
            $test_ship->setCredits($new_value);
            $result = $test_ship->getCredits();
            // Assert
            $this->assertEquals($new_value, $result);
        }

        function test_setLocation()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 20;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $new_value_x = 6;
            $new_value_y = 3;
            // Act
            $test_ship->setLocation($new_value_x, $new_value_y);
            $result = $test_ship->getLocation();
            // Assert
            $this->assertEquals([$new_value_x, $new_value_y], $result);
        }

        function test_setCurrentFuel()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 20;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $new_value = 30;
            // Act
            $test_ship->setCurrentFuel($new_value);
            $result = $test_ship->getCurrentFuel();
            // Assert
            $this->assertEquals($new_value, $result);
        }

        function test_save()
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
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship->save();
            // Act
            $result = Ship::getAll();
            // Assert
            $this->assertEquals([$test_ship], $result);
        }

        function test_getAll()
        {
            // Arrange
            $id = null;
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 20;
            $id = 1;
            $test_ship1 = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship1->save();
            $name = "Grendel";
            $cargo_capacity = 30;
            $fuel_capacity = 70;
            $credits = 30000;
            $location_x = 1;
            $location_y = 2;
            $current_fuel = 30;
            $id = 2;
            $test_ship2 = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship2->save();
            // Act
            $result = Ship::getAll();
            // Assert
            $this->assertEquals([$test_ship1, $test_ship2], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $id = null;
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 20;
            $id = null;
            $test_ship1 = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship1->save();
            $name = "Grendel";
            $cargo_capacity = 30;
            $fuel_capacity = 70;
            $credits = 30000;
            $location_x = 1;
            $location_y = 2;
            $current_fuel = 30;
            $test_ship2 = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);            $test_ship2->save();
            // Act
            Ship::deleteAll();
            // Assert
            $this->assertEquals([], Ship::getAll());
        }

        function test_find()
        {
            // Arrange
            $id = null;
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 20;
            $id = null;
            $test_ship1 = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship1->save();
            $name = "Grendel";
            $cargo_capacity = 30;
            $fuel_capacity = 70;
            $credits = 30000;
            $location_x = 1;
            $location_y = 2;
            $current_fuel = 30;
            $test_ship2 = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship2->save();
            // Act
            $result = Ship::find($test_ship1->getId());
            // Assert
            $this->assertEquals($test_ship1, $result);
        }

        function test_delete()
        {
            // Arrange
            $id = null;
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 20;
            $id = null;
            $test_ship1 = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship1->save();
            $name = "Grendel";
            $cargo_capacity = 30;
            $fuel_capacity = 70;
            $credits = 30000;
            $location_x = 1;
            $location_y = 2;
            $current_fuel = 30;
            $test_ship2 = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);            $test_ship2->save();
            // Act
            $test_ship1->delete();
            $result = Ship::getAll();
            // Assert
            $this->assertEquals([$test_ship2], $result);
        }

        function test_update()
        {
            // Arrange
            $id = null;
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 20000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 20;
            $test_ship1 = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship1->save();
            $test_ship1->setName("Grendel");
            $test_ship1->setCapacities(30, 70);
            $test_ship1->setCredits(40000);
            $test_ship1->setLocation(4,6);
            $test_ship1->setCurrentFuel(30);
            // Act
            $test_ship1->update();
            $result = Ship::getAll();
            // Assert
            $this->assertEquals([$test_ship1], $result);
        }

        function test_getDistance()
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
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship->save();
            $destination_x = 4;
            $destination_y = 1;
            $distance = 3;
            // Act
            $result = $test_ship->getDistance($destination_x, $destination_y);
            // Assert
            $this->assertEquals($distance, $result);
        }

        function test_checkTravelRange()
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
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship->save();
            $destination_x = 4;
            $destination_y = 1;
            // Act
            $result = $test_ship->checkTravelRange($destination_x, $destination_y);
            // Assert
            $this->assertEquals(true, $result);
        }

        function test_travel()
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
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship->save();
            $destination_x = 4;
            $destination_y = 1;
            $destination_fuel = 0;
            $destination_credits = 18000; // Reflects 2000 Credit deduction for Overhead Costs
            $destination_status = array([$destination_x, $destination_y], $destination_fuel, $destination_credits);
            // Act
            $test_ship->travel($destination_x, $destination_y);
            $test_ship->update();
            $results = array($test_ship->getLocation(), $test_ship->getCurrentFuel(), $test_ship->getCredits());
            // Assert
            $this->assertEquals($destination_status, $results);
        }

        function test_nonTravel()
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
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);            $test_ship->save();
            $destination_x = 2;
            $destination_y = 3;
            $destination_fuel = 30;
            $destination_credits = 18000; // Reflects 2000 Credit deduction for Overhead Costs
            $destination_status = array([$destination_x, $destination_y], $destination_fuel, $destination_credits);
            // Act
            $test_ship->travel($destination_x, $destination_y);
            $test_ship->update();
            $results = array($test_ship->getLocation(), $test_ship->getCurrentFuel(), $test_ship->getCredits());
            // Assert
            $this->assertEquals($destination_status, $results);
        }

        function test_purchaseFuelCheck1()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 500;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 30;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);            $test_ship->save();
            $fuel_price = 100;
            $fuel_purchase_amount = 10;
            // Act
            $result = $test_ship->purchaseFuelCheck($fuel_purchase_amount, $fuel_price);
            // Assert
            $this->assertEquals(false, $result);
        }

        function test_purchaseFuelCheck2()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 5000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 40;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);            $test_ship->save();
            $fuel_price = 100;
            $fuel_purchase_amount = 10;
            // Act
            $result = $test_ship->purchaseFuelCheck($fuel_purchase_amount, $fuel_price);
            // Assert
            $this->assertEquals(false, $result);
        }

        function test_purchaseFuel()
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
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);            $test_ship->save();
            $fuel_price = 100;
            $fuel_purchase_amount = 10;
            $new_credit_balance = $credits - ($fuel_price * $fuel_purchase_amount);
            $new_fuel_level = $current_fuel + $fuel_purchase_amount;
            // Act
            $test_ship->purchaseFuel($fuel_purchase_amount, $fuel_price);
            $results = array($test_ship->getCurrentFuel(), $test_ship->getCredits());
            // Assert
            $this->assertEquals([$new_fuel_level, $new_credit_balance], $results);
        }

        function test_getCargoManifest()
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
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship->save();
            $ship_inventory = array(
                ["Ore", 0],
                ["Grain", 0],
                ["Livestock", 0],
                ["Consumables", 0],
                ["Consumer Goods", 0],
                ["Heavy Machinery", 0],
                ["Military Hardware", 0],
                ["Robots", 0]
            );
            // Act
            $test_ship->initializeCargo();
            $manifest = $test_ship->getCargoManifest();
            $result = array();
            foreach ($manifest as $cargo) {
                array_push($result, [TradeGood::find($cargo->getTradeGoodsId())->getName(), $cargo->getQuantity()]);
            }
            // Assert
            $this->assertEquals($ship_inventory, $result);
        }

        function test_creditCheck()
        {
            // Arrange
            $name = "Beowulf";
            $cargo_capacity = 60;
            $fuel_capacity = 40;
            $credits = 2000000;
            $location_x = 2;
            $location_y = 3;
            $current_fuel = 30;
            $id = 1;
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship->save();
            $tradegood = "Robots";
            $unit_price = 1000;
            $purchase_quantity = 100;
            // Act
            $result = $test_ship->creditCheck($unit_price, $purchase_quantity);
            // Assert
            $this->assertEquals(true, $result);
        }

        function test_getCargo()
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
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship->save();
            $test_ship->initializeCargo();
            $cargo_type = "Robots";
            // Act
            $cargo = $test_ship->findCargo($cargo_type);
            $result = $cargo->getQuantity();
            // Assert
            $this->assertEquals(0, $result);
        }

        function test_addCargo()
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
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
            $test_ship->save();
            $test_ship->initializeCargo();
            $cargo_type = "Robots";
            $cargo_quantity = 10;
            // Act
            $test_ship->addCargo($cargo_type, $cargo_quantity);
            $cargo = $test_ship->findCargo($cargo_type);
            $result = $cargo->getQuantity();
            // Assert
            $this->assertEquals($cargo_quantity, $result);
        }

        function test_getCargoLoad()
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
            $test_ship = new Ship($name, $cargo_capacity, $fuel_capacity, $credits, $location_x, $location_y, $current_fuel, $id);
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
            $total_cargo = 0;
            foreach ($ship_inventory as $line_item) {
                $cargo = $test_ship->findCargo($line_item[0]);
                $cargo->update($line_item[1]);
                $total_cargo += $line_item[1];
            }
            // Act
            $result = $test_ship->getCargoLoad();
            // Assert
            $this->assertEquals($total_cargo, $result);
        }

    }
?>
