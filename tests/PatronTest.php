<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Book.php';
    require_once 'src/Author.php';
    require_once 'src/Patron.php';

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class PatronTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Book::deleteAll();
            Author::deleteAll();
            Patron::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $id = null;
            $name = "Marcos";
            $phone = "4444";
            $test_patron = new Patron($id, $name, $phone);

            //Act
            $test_patron->save();

            //Assert
            $result = Patron::getAll();
            $this->assertEquals([$test_patron], $result);
        }

        function testGetAll()
        {
            //Arrange
            $id = null;
            $name = "Marcos";
            $phone = "4444";
            $test_patron = new Patron($id, $name, $phone);
            $test_patron->save();

            $name2 = "Phil";
            $phone2 = "5555";
            $test_patron2 = new Patron($id, $name2, $phone2);
            $test_patron2->save();

            //Act
            $result = Patron::getAll();

            //Assert
            $this->assertEquals([$test_patron, $test_patron2], $result);
        }
        function testDeleteAll()
        {
            //Arrange
            $id = null;
            $name = "Marcos";
            $phone = "4444";
            $test_patron = new Patron($id, $name, $phone);
            $test_patron->save();

            $name2 = "Phil";
            $phone2 = "5555";
            $test_patron2 = new Patron($id, $name2, $phone2);
            $test_patron2->save();

            //Act
            Patron::deleteAll();
            $result = Patron::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $id = null;
            $name = "Marcos";
            $phone = "4444";
            $test_patron = new Patron($id, $name, $phone);
            $test_patron->save();

            $name2 = "Phil";
            $phone2 = "5555";
            $test_patron2 = new Patron($id, $name2, $phone2);
            $test_patron2->save();

            //Act
            $result = Patron::find($test_patron->getId());

            //Assert
            $this->assertEquals($test_patron, $result);
        }

        function testUpdate()
        {
            //Arrange
            $id = null;
            $name = "Allen";
            $phone = "4444";
            $test_patron = new Patron($id, $name, $phone);

            $new_phone = "6666666";

            //Act
            $test_patron->update($new_phone);

            //Assert
            $result = $test_patron->getPhone();
            $this->assertEquals($new_phone, $result);        

        }
    }




 ?>
