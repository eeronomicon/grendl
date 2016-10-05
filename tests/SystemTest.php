<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    **/

    require_once 'src/Planet.php';
    require_once 'src/System.php';

    $server = 'mysql:host=localhost;dbname=space_truckin_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class SystemTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Planet::deleteAll();
            $GLOBALS['DB']->exec("DELETE FROM inventory;");
        }

        function test_buildAgriculturalPlanet()
        {
            // Arrange
            $test_system = new System();
            $first_output = Planet::getAll();

            // Act
            $test_system->buildAgriculturalPlanet(4, 4);
            $second_output = Planet::getAll();

            // Assert
            $this->assertGreaterThan(sizeof($first_output), sizeof($second_output));
        }

        function test_buildIndustrialPlanet()
        {
            // Arrange
            $test_system = new System();
            $first_output = Planet::getAll();

            // Act
            $test_system->buildIndustrialPlanet(4, 4);
            $second_output = Planet::getAll();

            // Assert
            $this->assertGreaterThan(sizeof($first_output), sizeof($second_output));
        }

        function test_buildEmptyPlanet()
        {
            // Arrange
            $test_system = new System();
            $first_output = Planet::getAll();

            // Act
            $test_system->buildEmptyPlanet(4, 4);
            $second_output = Planet::getAll();

            // Assert
            $this->assertGreaterThan(sizeof($first_output), sizeof($second_output));
        }

        function test_buildFuelingStation()
        {
            // Arrange
            $test_system = new System();
            $first_output = Planet::getAll();

            // Act
            $test_system->buildFuelingStation(4, 4);
            $second_output = Planet::getAll();

            // Assert
            $this->assertGreaterThan(sizeof($first_output), sizeof($second_output));
        }

        function test_nextTurn()
        {
            // Arrange
            $test_system = new System();
            $planets = Planet::getAllOccupiedPlanets();
            $first_output = $planets[0]->getQuantities();

            // Act
            System::nextTurn();
            $planets = Planet::getAllOccupiedPlanets();
            $second_output = $planets[0]->getQuantities();

            // Assert
            $this->assertGreaterThan($first_output, $second_output);
        }
    }
?>
