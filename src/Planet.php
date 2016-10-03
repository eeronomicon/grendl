<?php
    class Planet
    {
        private $x;
        private $y;
        private $type;
        private $population;
        private $specialty;
        private $taboo;
        private $ore;
        private $grain;
        private $livestock;
        private $consumables;
        private $consumer_goods;
        private $heavy_machinery;
        private $military_hardware;
        private $robots;

        function __construct($x, $y, $type, $population, $specialty, $taboo)
        {
            // based on population, specialty, and taboo, initial inventory levels will be set
        }

        function sell($inventory_type)
        {
            // remove inventory from planet
        }

        function save()
        {

        }

        function update()
        {

        }


        // static functions
        static function findById()
        {

        }

        static function deleteAll()
        {

        }

        static function getAll()
        {

        }

        // getters and setters
    }
 ?>
