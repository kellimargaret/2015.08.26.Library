<?php

    class Checkout
    {
        private $id;
        private $due_date;

        function __construct($id = null, $due_date)
        {
            $this->id = $id;
            $this->due_date = $due_date;
        }

        //Getters
        function getId()
        {
            return $this->id;
        }

        function getDueDate()
        {
            return $this->due_date;
        }

        //Setters
        function setDueDate($new_due_date)
        {
            $this->due_date = $new_due_date;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO checkouts (due_date) VALUES ('{$this->getDueDate()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($new_due_date)
        {
            $GLOBALS['DB']->exec("UPDATE checkouts SET due_date = '{$new_due_date}' WHERE id = {$this->getId()};");
            $this->setDueDate($new_due_date);
        }

        static function getAll()
        {
            $returned_checkouts = $GLOBALS['DB']->query("SELECT * FROM checkouts;");

            $checkouts = array();
            foreach($returned_checkouts as $checkout) {
                $id = $checkout['id'];
                $due_date = $checkout['due_date'];
                $new_checkout = new Checkout($id, $due_date);
                array_push($checkouts, $new_checkout);
            }
            return $checkouts;

        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM checkouts;");
        }

        static function find($search_id)
        {
            $found_checkout = null;
            $checkouts = Checkout::getAll();
            foreach ($checkouts as $checkout) {
                $checkout_id = $checkout->getId();
                if ($checkout_id == $search_id) {
                    $found_checkout = $checkout;
                }
            }
            return $found_checkout;
        }

    }








 ?>
