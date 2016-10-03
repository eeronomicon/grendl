<?php
    class Cargo
    {
        private $tradegoods_id;
        private $ship_id;
        private $quantity;
        private $id;

        function __construct($tradegoods_id, $ship_id, $quantity, $id = null)
        {
            $this->tradegoods_id = $tradegoods_id;
            $this->ship_id = $ship_id;
            $this->quantity = $quantity;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getTradeGoodsId()
        {
          return $this->tradegoods_id;
        }

        function getShipId()
        {
          return $this->ship_id;
        }

        function getQuantity()
        {
            return $this->quantity;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function setTradegoodsId($new_id)
        {
            $this->tradegoods_id = (int) $new_id;
        }

        function setShipId($new_id)
        {
            $this->ship_id = (int) $new_id;
        }

        function setQuantity($new_qty)
        {
            $this->quantity = (int) $new_qty;
        }

        function save()
        {
          $GLOBALS['DB']->exec("INSERT INTO cargo (id_tradegoods, id_ship, quantity) VALUES ({$this->getTradeGoodsId()}, {$this->getShipId()}, {$this->getQuantity()})");
          $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_cargo = $GLOBALS['DB']->query("SELECT * FROM cargo;");
            $cargos = array();
            foreach($returned_cargo as $cargo) {
                $tradegoods_id = $cargo['id_tradegoods'];
                $ship_id = $cargo['id_ship'];
                $quantity = $cargo['quantity'];
                $id = $cargo['id'];
                $new_cargo = new Cargo($tradegoods_id, $ship_id, $quantity, $id);
                array_push($cargos, $new_cargo);
            }
            return $cargos;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cargo;");
        }

        static function find($search_id)
        {
            $found_cargo = null;
            $cargos = Cargo::getAll();
            foreach($cargos as $cargo) {
                $cargo_id = $cargo->getId();
                if ($cargo_id == $search_id) {
                  $found_cargo = $cargo;
                }
            }
            return $found_cargo;
        }

        function update($new_qty)
        {
            $GLOBALS['DB']->exec("UPDATE cargo SET quantity = {$new_qty} WHERE id = {$this->getId()};");
            $this->setQuantity($new_qty);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM cargo WHERE id = {$this->getId()};");
        }

    }
?>
