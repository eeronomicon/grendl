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
            // Planet::deleteAll();
        }

        function test_buildAgriculturalPlanet()
        {
            // Arrange
            $test_system = new System();

            // Act

            // Assert
        }

        function test_buildIndustrialPlanet()
        {

        }

        function test_buildEmptyPlanet()
        {

        }

        function test_buildFuelingStation()
        {

        }
    }
?>
