<?php
    class TradeGood
    {
        private $name;
        private $price;
        private $buy_at;
        private $sell_at;
        private $id;

        function __construct($name, $price, $buy_at, $sell_at, $id = null)
        {
            $this->name = $name;
            $this->price = $price;
            $this->buy_at = $buy_at;
            $this->sell_at = $sell_at;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
          return $this->name;
        }

        function getPrice()
        {
          return $this->price;
        }

        function getBuyAt()
        {
            return $this->buy_at;
        }

        function getSellAt()
        {
            return $this->sell_at;
        }

        static function getAll()
        {
            $returned_tradegoods = $GLOBALS['DB']->query("SELECT * FROM tradegoods;");
            $tradegoods = array();
            foreach($returned_tradegoods as $tradegood) {
                $id = $tradegood['id'];
                $name = $tradegood['name'];
                $price = $tradegood['price'];
                $buy_at = $tradegood['buy_at'];
                $sell_at = $tradegood['sell_at'];
                $new_tradegood = new TradeGood($name, $price, $buy_at, $sell_at, $id);
                array_push($tradegoods, $new_tradegood);
            }
            return $tradegoods;
        }

        static function find($search_id)
        {
            $found_tradegood = null;
            $tradegoods = TradeGood::getAll();
            foreach($tradegoods as $tradegood) {
                $tradegood_id = $tradegood->getId();
                if ($tradegood_id == $search_id) {
                  $found_tradegood = $tradegood;
                }
            }
            return $found_tradegood;
        }

    }
?>
