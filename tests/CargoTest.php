<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cargo.php";

    $server = 'mysql:host=localhost;dbname=space_truckin_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CargoTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cargo::deleteAll();
        }

        function test_getId()
        {
            // Arrange
            $tradegoods_id = 1;
            $ship_id = 2;
            $quantity = 10;
            $id = 3;
            $test_cargo = new Cargo($tradegoods_id, $ship_id, $quantity, $id);
            // Act
            $result = $test_cargo->getId();
            // Assert
            $this->assertEquals($id, $result);
        }

        function test_getTradeGoodsId()
        {
            // Arrange
            $tradegoods_id = 1;
            $ship_id = 2;
            $quantity = 10;
            $id = 3;
            $test_cargo = new Cargo($tradegoods_id, $ship_id, $quantity, $id);
            // Act
            $result = $test_cargo->getTradeGoodsId();
            // Assert
            $this->assertEquals($tradegoods_id, $result);
        }

        function test_getShipId()
        {
            // Arrange
            $tradegoods_id = 1;
            $ship_id = 2;
            $quantity = 10;
            $id = 3;
            $test_cargo = new Cargo($tradegoods_id, $ship_id, $quantity, $id);
            // Act
            $result = $test_cargo->getShipId();
            // Assert
            $this->assertEquals($ship_id, $result);
        }

        function test_getQuantity()
        {
            // Arrange
            $tradegoods_id = 1;
            $ship_id = 2;
            $quantity = 10;
            $id = 3;
            $test_cargo = new Cargo($tradegoods_id, $ship_id, $quantity, $id);
            // Act
            $result = $test_cargo->getQuantity();
            // Assert
            $this->assertEquals($quantity, $result);
        }

        function test_setId()
        {
            // Arrange
            $tradegoods_id = 1;
            $ship_id = 2;
            $quantity = 10;
            $id = 3;
            $test_cargo = new Cargo($tradegoods_id, $ship_id, $quantity, $id);
            $new_value = 6;
            // Act
            $test_cargo->setId($new_value);
            $result = $test_cargo->getId();
            // Assert
            $this->assertEquals($new_value, $result);
        }

        function test_setTradeGoodsId()
        {
            // Arrange
            $tradegoods_id = 1;
            $ship_id = 2;
            $quantity = 10;
            $id = 3;
            $test_cargo = new Cargo($tradegoods_id, $ship_id, $quantity, $id);
            $new_value = 6;
            // Act
            $test_cargo->setTradegoodsId($new_value);
            $result = $test_cargo->getTradeGoodsId();
            // Assert
            $this->assertEquals($new_value, $result);
        }

        function test_setShipId()
        {
            // Arrange
            $tradegoods_id = 1;
            $ship_id = 2;
            $quantity = 10;
            $id = 3;
            $test_cargo = new Cargo($tradegoods_id, $ship_id, $quantity, $id);
            $new_value = 6;
            // Act
            $test_cargo->setShipId($new_value);
            $result = $test_cargo->getShipId();
            // Assert
            $this->assertEquals($new_value, $result);
        }

        function test_setQuantity()
        {
            // Arrange
            $tradegoods_id = 1;
            $ship_id = 2;
            $quantity = 10;
            $id = 3;
            $test_cargo = new Cargo($tradegoods_id, $ship_id, $quantity, $id);
            $new_value = 6;
            // Act
            $test_cargo->setQuantity($new_value);
            $result = $test_cargo->getQuantity();
            // Assert
            $this->assertEquals($new_value, $result);
        }

        function test_getAll()
        {
            // Arrange
            $id = null;
            $tradegoods_id1 = 1;
            $ship_id1 = 2;
            $quantity1 = 10;
            $test_cargo1 = new Cargo($tradegoods_id1, $ship_id1, $quantity1, $id);
            $test_cargo1->save();
            $tradegoods_id2 = 1;
            $ship_id2 = 2;
            $quantity2 = 10;
            $test_cargo2 = new Cargo($tradegoods_id2, $ship_id2, $quantity2, $id);
            $test_cargo2->save();
            // Act
            $result = Cargo::getAll();
            // Assert
            $this->assertEquals([$test_cargo1, $test_cargo2], $result);
        }

        function test_save()
        {
            // Arrange
            $id = null;
            $tradegoods_id1 = 1;
            $ship_id1 = 2;
            $quantity1 = 10;
            $test_cargo1 = new Cargo($tradegoods_id1, $ship_id1, $quantity1, $id);
            $test_cargo1->save();
            // Act
            $result = Cargo::getAll();
            // Assert
            $this->assertEquals([$test_cargo1], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $id = null;
            $tradegoods_id1 = 1;
            $ship_id1 = 2;
            $quantity1 = 10;
            $test_cargo1 = new Cargo($tradegoods_id1, $ship_id1, $quantity1, $id);
            $test_cargo1->save();
            $tradegoods_id2 = 1;
            $ship_id2 = 2;
            $quantity2 = 10;
            $test_cargo2 = new Cargo($tradegoods_id2, $ship_id2, $quantity2, $id);
            $test_cargo2->save();
            // Act
            Cargo::deleteAll();
            // Assert
            $this->assertEquals([], Cargo::getAll());
        }

        function test_find()
        {
            // Arrange
            $id = null;
            $tradegoods_id1 = 1;
            $ship_id1 = 2;
            $quantity1 = 10;
            $test_cargo1 = new Cargo($tradegoods_id1, $ship_id1, $quantity1, $id);
            $test_cargo1->save();
            $tradegoods_id2 = 1;
            $ship_id2 = 2;
            $quantity2 = 10;
            $test_cargo2 = new Cargo($tradegoods_id2, $ship_id2, $quantity2, $id);
            $test_cargo2->save();
            // Act
            $result = Cargo::find($test_cargo1->getId());
            // Assert
            $this->assertEquals($test_cargo1, $result);
        }

        function test_update()
        {
            // Arrange
            $id = null;
            $tradegoods_id1 = 1;
            $ship_id1 = 2;
            $quantity1 = 10;
            $test_cargo1 = new Cargo($tradegoods_id1, $ship_id1, $quantity1, $id);
            $test_cargo1->save();
            $new_qty = 20;
            // Act
            $test_cargo1->update($new_qty);
            $result = Cargo::find($test_cargo1->getId())->getQuantity();
            // Assert
            $this->assertEquals($new_qty, $result);
        }

        function test_delete()
        {
            // Arrange
            $id = null;
            $tradegoods_id1 = 1;
            $ship_id1 = 2;
            $quantity1 = 10;
            $test_cargo1 = new Cargo($tradegoods_id1, $ship_id1, $quantity1, $id);
            $test_cargo1->save();
            $tradegoods_id2 = 1;
            $ship_id2 = 2;
            $quantity2 = 10;
            $test_cargo2 = new Cargo($tradegoods_id2, $ship_id2, $quantity2, $id);
            $test_cargo2->save();
            // Act
            $test_cargo1->delete();
            $result = Cargo::getAll();
            // Assert
            $this->assertEquals([$test_cargo2], $result);
        }
    }
?>
