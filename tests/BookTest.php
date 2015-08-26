<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Book.php';

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Book::deleteAll();
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


    }

?>
