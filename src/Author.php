<?php

    Class Author
    {
        private $id;
        private $name;

        function __construct($id = null, $name)
        {
            $this->id = $id;
            $this->name = $name;
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

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO authors (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();

        }
        static function getAll()
        {
            $returned_authors = $GLOBALS['DB']->query("SELECT * FROM authors;");
            $authors = array();
            foreach($returned_authors as $author){
                $author_name = $author['name'];
                $id = $author['id'];
                $new_author = new Author($id, $author_name);
                array_push($authors, $new_author);
            }
            return $authors;
        }
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM authors;");
        }
    }

 ?>
