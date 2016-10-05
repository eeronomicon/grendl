<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    **/

    require_once 'src/Planet.php';

    $server = 'mysql:host=localhost;dbname=space_truckin_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class PlanetTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Planet::deleteAll();
            $GLOBALS['DB']->exec("DELETE FROM inventory;");
        }

        function test_save()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);

            //Act
            $test_planet->save();
            $output = Planet::getAll();

            //Assert
            $this->assertEquals([$test_planet], $output);
        }

        function test_deleteAll()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();

            //Act
            Planet::deleteAll();
            $output = Planet::getAll();

            //Assert
            $this->assertEquals([], $output);
        }

        function test_findById()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();

            //Act
            $search_id = $test_planet->getId();
            $output = Planet::findById($search_id);

            //Assert
            $this->assertEquals($test_planet, $output);
        }

        function test_buildMarket()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();

            //Act
            $test_planet->buildMarket();
            $output = $test_planet->getMarketValues();

            //Assert
            $this->assertEquals(0, $output['Ore']);
        }

        function test_setMarketValues()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();
            $test_planet->buildMarket();

            //Act
            $test_planet->setMarketValues();
            $output = $test_planet->getMarketValues();

            //Assert
            $this->assertGreaterThan(10, $output['Consumer Goods']);
        }

        function test_getMarketValues()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();
            $test_planet->buildMarket();
            $test_planet->setMarketValues();

            //Act
            $output = $test_planet->getMarketValues();

            //Assert
            $this->assertEquals(8, sizeof($output));
        }

        function test_setInitialQuantities()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();
            $test_planet->buildMarket();
            $test_planet->setMarketValues();

            //Act
            $test_planet->setInitialInventory();
            $output = $test_planet->getQuantities();

            //Assert
            $this->assertGreaterThan(5, $output['Livestock']);
        }

        function test_getTradegoodNameById()
        {
            //Arrange
            $tradegood_id = 1;

            //Act
            $output = Planet::getTradegoodNameById($tradegood_id);

            //Assert
            $this->assertEquals('Ore', $output);
        }

        function test_findByCoordinate()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();

            //Act
            $output = Planet::findByCoordinates($x, $y);

            //Assert
            $this->assertEquals($test_planet, $output);
        }

        function test_getAllOccupiedPlanets()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();

            //Act
            $output = Planet::getAllOccupiedPlanets();

            //Assert
            $this->assertEquals([$test_planet], $output);
        }

        function test_incrementQuantities()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();
            $test_planet->buildMarket();
            $test_planet->setInitialInventory();
            $first_output = $test_planet->getQuantities();

            //Act
            $test_planet->incrementQuantities();
            $second_output = $test_planet->getQuantities();

            //Assert
            $this->assertGreaterThan($first_output['Livestock'], $second_output['Livestock']);
        }

        function test_quantityCheck()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();
            $test_planet->buildMarket();
            $test_planet->setInitialInventory();

            //Act
            $resource_name = 'Livestock';
            $amount = 1;
            $output = $test_planet->quantityCheck($resource_name, $amount);

            //Assert
            $this->assertEquals(true, $output);
        }

        function test_removeInventory()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();
            $test_planet->buildMarket();
            $test_planet->setInitialInventory();
            $first_output = $test_planet->getQuantities();

            //Act
            $resource_name = 'Livestock';
            $amount = 1;
            $test_planet->removeInventory($resource_name, $amount);
            $second_output = $test_planet->getQuantities();


            //Assert
            $this->assertLessThan($first_output, $second_output);
        }

        function test_priceGetters()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();
            $test_planet->buildMarket();
            $test_planet->setInitialInventory();
            $test_planet->setMarketValues();

            //Act
            $output1 = $test_planet->getOrePrice();
            $output2 = $test_planet->getLivestockPrice();
            $output3 = $test_planet->getGrainPrice();
            $output4 = $test_planet->getConsumablesPrice();
            $output5 = $test_planet->getConsumerGoodsPrice();
            $output6 = $test_planet->getHeavyMachineryPrice();
            $output7 = $test_planet->getMilitaryHardwarePrice();
            $output8 = $test_planet->getRobotsPrice();


            //Assert
            $this->assertGreaterThan(0, $output1);
            $this->assertGreaterThan(0, $output2);
            $this->assertGreaterThan(0, $output3);
            $this->assertGreaterThan(0, $output4);
            $this->assertGreaterThan(0, $output5);
            $this->assertGreaterThan(0, $output6);
            $this->assertGreaterThan(0, $output7);
            $this->assertGreaterThan(0, $output8);
        }

        function test_quantityGetters()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();
            $test_planet->buildMarket();
            $test_planet->setInitialInventory();
            $test_planet->setMarketValues();

            //Act
            $output1 = $test_planet->getOreQuantity();
            $output2 = $test_planet->getLivestockQuantity();
            $output3 = $test_planet->getGrainQuantity();
            $output4 = $test_planet->getConsumablesQuantity();
            $output5 = $test_planet->getConsumerGoodsQuantity();
            $output6 = $test_planet->getHeavyMachineryQuantity();
            $output7 = $test_planet->getMilitaryHardwareQuantity();
            $output8 = $test_planet->getRobotsQuantity();


            //Assert
            $this->assertEquals(0, $output1);
            $this->assertGreaterThan(0, $output2);
            $this->assertEquals(0, $output3);
            $this->assertGreaterThan(0, $output4);
            $this->assertEquals(0, $output5);
            $this->assertEquals(0, $output6);
            $this->assertEquals(0, $output7);
            $this->assertEquals(0, $output8);
        }

        function test_getName()
        {
            //Arrange
            $x = 5;
            $y = 6;
            $type = 2;
            $population = 1;
            $specialty = 3;
            $regular = 4;
            $controlled = 5;
            $name = 'test';
            $test_planet = new Planet($x, $y, $type, $population, $regular, $specialty, $controlled);
            $test_planet->save();
            $test_output = $test_planet->getName();
            $planets = Planet::getAll();

            //Act
            $output = $planets[0]->getName();


            //Assert
            $this->assertEquals($test_output, $output);
        }

    }
        // export PATH=$PATH:./vendor/bin first and then you will only have to run  $ phpunit tests
?>
