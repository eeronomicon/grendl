<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/TradeGood.php";

    $server = 'mysql:host=localhost;dbname=space_truckin_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class TradeGoodTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            // TradeGood::deleteAll();
        }

        function test_getId()
        {
            // Arrange
            $id = 2;
            $name = "Robots";
            $price = 10;
            $buy_at = 2;
            $sell_at = 1;
            $test_cargo = new TradeGood($name, $price, $buy_at, $sell_at, $id);
            // Act
            $result = $test_cargo->getId();
            // Assert
            $this->assertEquals($id, $result);
        }

        function test_getName()
        {
            // Arrange
            $id = null;
            $name = "Robots";
            $price = 10;
            $buy_at = 2;
            $sell_at = 1;
            $test_cargo = new TradeGood($name, $price, $buy_at, $sell_at, $id);
            // Act
            $result = $test_cargo->getName();
            // Assert
            $this->assertEquals($name, $result);
        }

        function test_getPrice()
        {
            // Arrange
            $id = null;
            $name = "Robots";
            $price = 10;
            $buy_at = 2;
            $sell_at = 1;
            $test_cargo = new TradeGood($name, $price, $buy_at, $sell_at, $id);
            // Act
            $result = $test_cargo->getPrice();
            // Assert
            $this->assertEquals($price, $result);
        }

        function test_getBuyAt()
        {
            // Arrange
            $id = null;
            $name = "Robots";
            $price = 10;
            $buy_at = 2;
            $sell_at = 1;
            $test_cargo = new TradeGood($name, $price, $buy_at, $sell_at, $id);
            // Act
            $result = $test_cargo->getBuyAt();
            // Assert
            $this->assertEquals($buy_at, $result);
        }

        function test_getSellAt()
        {
            // Arrange
            $id = null;
            $name = "Robots";
            $price = 10;
            $buy_at = 2;
            $sell_at = 1;
            $test_cargo = new TradeGood($name, $price, $buy_at, $sell_at, $id);
            // Act
            $result = $test_cargo->getSellAt();
            // Assert
            $this->assertEquals($sell_at, $result);
        }

        function test_getAllNames()
        {
            // Arrange
            $tradegoods = ["Ore","Grain","Livestock","Consumables","Consumer Goods","Heavy Machinery","Military Hardware","Robots"];
            $result = array();
            // Act
            $all_tradegoods = TradeGood::getAll();
            foreach ($all_tradegoods as $tradegood) {
                array_push($result, $tradegood->getName());
            }
            // Assert
            $this->assertEquals($tradegoods, $result);
        }

        function test_getAllPrices()
        {
            // Arrange
            $tradegoods = [10,10,10,10,10,10,10,10];
            $result = array();
            // Act
            $all_tradegoods = TradeGood::getAll();
            foreach ($all_tradegoods as $tradegood) {
                array_push($result, $tradegood->getPrice());
            }
            // Assert
            $this->assertEquals($tradegoods, $result);
        }

        function test_getAllBuyAt()
        {
            // Arrange
            $tradegoods = [1,1,1,1,2,2,2,2];
            $result = array();
            // Act
            $all_tradegoods = TradeGood::getAll();
            foreach ($all_tradegoods as $tradegood) {
                array_push($result, $tradegood->getBuyAt());
            }
            // Assert
            $this->assertEquals($tradegoods, $result);
        }

        function test_getAllSellAt()
        {
            // Arrange
            $tradegoods = [2,2,2,2,1,1,1,1];
            $result = array();
            // Act
            $all_tradegoods = TradeGood::getAll();
            foreach ($all_tradegoods as $tradegood) {
                array_push($result, $tradegood->getSellAt());
            }
            // Assert
            $this->assertEquals($tradegoods, $result);
        }

        function test_find()
        {
            // Arrange
            $tradegoods = ["Ore","Grain","Livestock","Consumables","Consumer Goods","Heavy Machinery","Military Hardware","Robots"];
            $result = array();
            // Act
            $all_tradegoods = TradeGood::getAll();
            foreach ($all_tradegoods as $tradegood) {
                array_push($result, $tradegood->find($tradegood->getId())->getName());
            }            // Assert
            $this->assertEquals($tradegoods, $result);
        }

    }
?>
