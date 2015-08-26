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


    }

?>
