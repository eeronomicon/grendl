<?php
    require_once "src/Class.php";
    class ClassTest extends PHPUnit_Framework_TestCase
    {
        function test_getYearCode()
        {
            //Arrange
            $test_Classs = new Classs;
            $year = 2016;

            //Act
            $output = $test_DayOfWeek->getYearCode($year);

            //Assert
            $this->assertEquals(6, $output);
        }

    }
        // export PATH=$PATH:./vendor/bin first and then you will only have to run  $ phpunit tests
?>
