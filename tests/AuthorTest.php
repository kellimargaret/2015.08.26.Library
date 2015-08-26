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

    class AuthorTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Author::deleteAll();
            Book::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $id = null;
            $name = "Lemony Snicket";
            $test_author = new Author($id, $name);
            $test_author->save();

            //Act
            $result = Author::getAll();

            //Assert
            $this->assertEquals($test_author, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $id = null;
            $name = "Lemony Snicket";
            $test_author = new Author($id, $name);
            $test_author->save();

            $name2 = "J.R.R. Tolkien";
            $test_author2 = new Author($id, $name);
            $test_author2->save();

            //Act
            $result = Author::getAll();

            //Assert
            $this->assertEquals([$test_author, $test_author2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $id = null;
            $name = "Lemony Snicket";
            $test_author = new Author($id, $name);
            $test_author->save();

            $name2 = "J.R.R. Tolkien";
            $test_author2 = new Author($id, $name2);
            $test_author2->save();

            //Act
            Author::deleteAll();

            //Assert
            $result = Author::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $id = null;
            $name = "Lemony Snicket";
            $test_author = new Author($id, $name);
            $test_author->save();

            $name2 = "J.R.R. Tolkien";
            $test_author2 = new Author($id, $name2);
            $test_author2->save();

            //Act
            $result = Author::find($test_author->getId());

            //Assert
            $this->assertEquals($test_author, $result);
        }

        function testDeleteAuthor()
        {
            //Arrange
            $id = null;
            $name = "Lemony Snicket";
            $test_book = new Book($id, $name);
            $test_book->save();

            $name2 = "J.R.R. Tolkien";
            $test_author = new Author($id, $name2);
            $test_author->save();

            //Act
            $test_author->addBook($test_book);
            $test_author->delete();

            //Assert
            $this->assertEquals([], $test_book->getAuthors());
        }

        function testAddBook()
        {
            //Arrange
            $id = null;
            $name = "Lemony Snicket";
            $test_book = new Book($id, $name);
            $test_book->save();

            $name2 = "J.R.R. Tolkien";
            $test_author = new Author($id, $name2);
            $test_author->save();

            //Act
            $test_author->addBook($test_book);

            //Assert
            $this->assertEquals($test_author->getBooks(), [$test_book]);
        }

        function testGetBooks()
        {
            //Arrange
            $id = null;
            $name = "Lemony Snicket";
            $test_author = new Author ($id, $name);
            $test_author->save();

            $name2 = "Fresh Off The Boat";
            $test_book = new Book ($id, $name2);
            $test_book->save();
            $test_author->addBook($test_book);

            $name3 = "A Series of Unfortunate Events";
            $test_book2 = new Book ($id, $name3);
            $test_book2->save();
            $test_author->addBook($test_book2);


            //Act
            $result = $test_author->getBooks();

            //Assert
            $this->assertEquals([$test_book, $test_book2], $result);
        }

        function testUpdate()
        {
            //Arrange
            $id = null;
            $name = "lemony snicket";
            $test_author = new Author($id, $name);
            $test_author->save();

            $new_name = "Lemony Snicket";

            //Act
            $test_author->update($new_name);

            //Assert
            $this->assertEquals($test_author->getName(), $new_name);
        }


    }

?>
