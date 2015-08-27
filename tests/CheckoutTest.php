<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Book.php';
    require_once 'src/Author.php';
    require_once 'src/Patron.php';
    require_once 'src/Checkout.php';

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CheckoutTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Checkout::deleteAll();
            Book::deleteAll();
            Author::deleteAll();
            Patron::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $due_date = "2015-03-03";
            $new_checkout = new Checkout($id = null, $due_date);

            //Act
            $new_checkout->save();

            //Assert
            $result = Checkout::getAll();
            $this->assertEquals([$new_checkout], $result);
        }

        function testGetAll()
        {
            //Arrange
            $id = null;
            $due_date = "2012-12-12";
            $test_checkout = new Checkout($id, $due_date);
            $test_checkout->save();


            $due_date2 = "1990-07-26";
            $test_checkout2 = new Checkout($id, $due_date2);
            $test_checkout2->save();

            //Act
            $result = Checkout::getAll();

            //Assert
            $this->assertEquals([$test_checkout, $test_checkout2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $id = null;
            $due_date= "2012-12-12";
            $test_checkout = new Checkout($id, $due_date);
            $test_checkout->save();

            $due_date2 = "1989-09-04";
            $test_checkout2 = new Checkout($id, $due_date2);

            $test_checkout2->save();

            //Act
            Checkout::deleteAll();
            $result = Checkout::getAll();

            //Assert
            $this->assertEquals([], $result);
        }


        function testUpdate()
        {
            //Arrange
            $id = null;
            $due_date = "2012-12-12";
            $test_checkout = new Checkout($id, $due_date);
            $test_checkout->save();

            $new_due_date = "2013-03-05";

            //Act
            $test_checkout->update($new_due_date);

            //Assert
            $result = $test_checkout->getDueDate();
            $this->assertEquals($new_due_date, $result);
        }

        function testFind()
        {
            //Arrange
            $id = null;
            $due_date = "2012-12-12";
            $test_checkout = new Checkout($id, $due_date);
            $test_checkout->save();

            $due_date2 = "1989-09-04";
            $test_checkout2 = new Checkout($id, $due_date2);
            $test_checkout2->save();

            //Act
            $result = Checkout::find($test_checkout->getId());

            //Assert
            $this->assertEquals($test_checkout, $result);
        }
    }



 ?>
