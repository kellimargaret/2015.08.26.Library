<?php

    class Book
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

        function getAuthors()
        {
            $results = $GLOBALS['DB']->query(
                "SELECT authors.* FROM
                    books JOIN books_authors ON (books.id = books_authors.book_id)
                    JOIN authors ON (books_authors.author_id = authors.id)
                    WHERE books.id = {$this->getId()};");
            $authors = array();
            foreach ($results as $result){
                $id = $result['id'];
                $name = $result['name'];
                $new_name = new Author($id, $name);
                array_push($authors, $new_name);
            }
            return $authors;
        }

        function addAuthor($author)
        {
            $GLOBALS['DB']->exec("INSERT INTO books_authors (book_id, author_id) VALUES ({$this->getId()}, {$author->getId()});");
        }
        

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO books (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_books = $GLOBALS['DB']->query("SELECT * FROM books;");
            $books = array();
            foreach($returned_books as $book) {
                $name = $book['name'];
                $id = $book['id'];
                $new_book = new Book($id, $name);
                array_push($books, $new_book);
            }
            return $books;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM books;");
            $GLOBALS['DB']->exec("DELETE FROM books_authors;");
        }

        static function find($search_id)
        {
            $found_book = null;
            $books = Book::getAll();
            foreach ($books as $book) {
                $book_id = $book->getId();
                if ($book_id == $search_id) {
                    $found_book = $book;
                }
            }
            return $found_book;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE books SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM books WHERE ID = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM books_authors WHERE book_id = {$this->getId()};");
        }

    }





  ?>
