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
    }



 ?>
