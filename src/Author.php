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
            $GLOBALS['DB']->exec("DELETE FROM books_authors;");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM authors WHERE ID = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM books_authors WHERE author_id ={$this->getId()};");
        }

        function addBook($book)
        {
            $GLOBALS['DB']->exec("INSERT INTO books_authors (book_id, author_id) VALUES ({$book->getId()}, {$this->getId()});");

            $GLOBALS['DB']->exec("INSERT INTO copies book_id VALUES ({$book->getId()}, {$this->getId()};)");
        }

        function getBooks()
        {
            $results = $GLOBALS['DB']->query(
                "SELECT books.*FROM
                    authors JOIN books_authors ON (authors.id = books_authors.author_id)
                    JOIN books ON (books_authors.book_id = books.id)
                    WHERE authors.id = {$this->getId()};");
            $books = array();
            foreach ($results as $result){
                $id = $result['id'];
                $name = $result['name'];
                $new_name = new Book($id, $name);
                array_push($books, $new_name);
            }
            return $books;
        }

        static function find($search_id)
        {
            $found_author = null;
            $authors = Author::getAll();
            foreach ($authors as $author){
                $author_id = $author->getId();
                if ($author_id == $search_id){
                    $found_author = $author;
                }

            }
            return $found_author;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE authors SET name = '{$new_name}' WHERE author_id = {$this->getId()};");
            $this->setName($new_name);
        }
    }

 ?>
