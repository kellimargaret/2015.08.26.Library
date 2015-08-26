<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Book.php';
    require_once 'src/Author.php';

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BookTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Book::deleteAll();
            Author::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $id = null;
            $name = "A Series of Unfortunate Events";
            $test_book = new Book($id, $name);

            //Act
            $test_book->save();

            //Assert
            $result = Book::getAll();
            $this->assertEquals([$test_book], $result);
        }

        function testGetAll()
        {
            //Arrange
            $id = null;
            $name = "A Series of Unfortunate Events";
            $test_book = new Book($id, $name);
            $test_book->save();

            $name2 = "Fresh Off the Boat";
            $test_book2 = new Book($id, $name2);
            $test_book2->save();

            //Act
            $result = Book::getAll();

            //Assert
            $this->assertEquals([$test_book, $test_book2], $result);
        }

        function testdeleteAll()
        {
            //Arrange
            $id = null;
            $name= "A Series of Unfortunate Events";
            $test_book = new Book($id, $name);
            $test_book->save();

            $name2 = "Fresh Off the Boat";
            $test_book2 = new Book($id, $name2);

            $test_book2->save();

            //Act
            Book::deleteAll();
            $result = Book::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $id = null;
            $name = "A Series of Unfortunate Events";
            $test_book = new Book($id, $name);
            $test_book->save();

            $name2 = "Fresh Off the Boat";
            $test_book2 = new Book($id, $name2);
            $test_book2->save();

            //Act
            $result = Book::find($test_book->getId());

            //Assert
            $this->assertEquals($test_book, $result);
        }

        function testUpdate()
        {
            //Arrange
            $id = null;
            $name = "A Series of Unfortunate Events";
            $test_book = new Book($id, $name);
            $test_book->save();

            $new_name = "An Unfortunate Event";

            //Act
            $test_book->update($new_name);

            //Assert
            $result = $test_book->getName();
            $this->assertEquals("An Unfortunate Event", $result);
        }

        function testDeleteBook()
        {
            //Arrange
            $id = null;
            $name = "A Series of Unfortunate Events";
            $test_book = new Book($id, $name);
            $test_book->save();

            $name2 = "Fresh Off the Boat";
            $test_book2 = new Book($id, $name2);
            $test_book2->save();

            //Act
            $test_book->delete();

            //Assert
            $this->assertEquals([$test_book2], Book::getAll());
        }

        function testAddAuthor()
        {
            //Arrange
            $id = null;
            $name = "J.R.R. Tolkien";
            $test_author = new Author($id, $name);
            $test_author->save();

            $name2 = "A Series of Unfortunate Events";
            $test_book = new Book($id, $name2);
            $test_book->save();

            //Act
            $test_book->addAuthor($test_author);

            //Assert
            $this->assertEquals($test_book->getAuthors(), [$test_author]);
        }

        function testGetAuthors()
        {
            //Arrange
            $id = null;
            $name = "A Series of Unfortunate Events";
            $test_book = new Book($id, $name);
            $test_book->save();

            $name2 = "Lemony Snicket";
            $test_author = new Author($id, $name2);
            $test_author->save();
            $test_book->addAuthor($test_author);

            $name3 = "J.R.R. Tolkien";
            $test_author2 = new Author($id, $name3);
            $test_author2->save();
            $test_book->addAuthor($test_author2);

            //Act
            $result = $test_book->getAuthors();

            //Assert
            $this->assertEquals([$test_author, $test_author2], $result);
        }




    }

?>
