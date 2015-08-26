<?php

    class Patron
    {
        private $id;
        private $name;
        private $phone;

        function __construct($id = null, $name, $phone)
        {
            $this->id = $id;
            $this->name = $name;
            $this->phone = $phone;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function setPhone($new_phone)
        {
            $this->phone = $new_phone;
        }

        static function getAll()
        {
            $returned_patrons = $GLOBALS['DB']->query("SELECT * FROM patrons;");
            $patrons = array();
            foreach($returned_patrons as $patron){
                $name = $patron['name'];
                $id = $patron['id'];
                $phone = $patron['phone'];
                $new_name = new Patron($id, $name, $phone);
                array_push($patrons, $new_name);
            }
            return $patrons;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM patrons;");
            //$GLOBALS['DB']->exec("DELETE FROM checkouts;");
            //We commented this out because the librarian might want a history of book checkouts, even if the patron_id no longer points to a patron.
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO patrons (name, phone) VALUES ('{$this->getName()}', '{$this->getPhone()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }


    }



 ?>
