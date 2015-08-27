<?php

    class Checkout
    {
        private $id;
        private $patron_id;
        private $copy_id;
        private $due_date;

        function __construct($id = null, $patron_id = null, $copy_id = null, $due_date)
        {
            $this->id = $id;
            $this->patron_id = $patron_id;
            $this->copy_id = $copy_id;
            $this->due_date = $due_date;
        }

        //Getters
        function getId()
        {
            return $this->id;
        }

        function getPatronId()
        {
            return $this->patron_id;
        }

        function getCopyId()
        {
            return $this->copy_id;
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
            $GLOBALS['DB']->exec("INSERT INTO checkouts (patron_id, copy_id, due_date) VALUES ({$this->getPatronId()}, {$this->getCopyId()}, '{$this->getDueDate()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($new_due_date)
        {
            $GLOBALS['DB']->exec("UPDATE checkouts SET due_date = '{$new_due_date}' WHERE id = {$this->getId()};");
            $this->setDueDate($new_due_date);
        }

        // function addPatron($patron)
        // {
        //     $GLOBALS['DB']->exec("INSERT INTO checkouts (copy_id, patron_id) VALUES ({$this->getId()}, {$patron->getId()});");
        // }
        //
        // function getPatron()
        // {
        //     $results = $GLOBALS['DB']->query(
        //         "SELECT * FROM patrons WHERE id = {$this->getPatronId()};");
        //
        //     $checkouts = array();
        //
        //     foreach($results as $checkout) {
        //         $id = $checkout['id'];
        //         $patron_id = $checkout['patron_id'];
        //         $copy_id = $checkout['copy_id'];
        //         $due_date = $checkout['due_date'];
        //         $new_checkout = new Checkout($id, $patron_id, $copy_id, $due_date);
        //         array_push($checkouts, $new_checkout);
        //     }
        //     return $checkouts;
        // }


        static function getAll()
        {
            $returned_checkouts = $GLOBALS['DB']->query("SELECT * FROM checkouts;");

            $checkouts = array();
            foreach($returned_checkouts as $checkout) {
                $id = $checkout['id'];
                $patron_id = $checkout['patron_id'];
                $copy_id = $checkout['copy_id'];
                $due_date = $checkout['due_date'];
                $new_checkout = new Checkout($id, $patron_id, $copy_id, $due_date);
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
