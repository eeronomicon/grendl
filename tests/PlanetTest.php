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

        function test_constructor()
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
            $output = $test_planet->getMarketValues();

            //Assert
            $this->assertEquals([0], $output);
        }

    }
        // export PATH=$PATH:./vendor/bin first and then you will only have to run  $ phpunit tests
?>
