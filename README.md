# Library

##### A database storing a library, its books, and its patrons.

#### By Phillip Shannon, Adam Won, Marcos Moncivais

## Description

A database storing a library, its books, and its patrons.

## Setup

1. Clone repository from GitHub.
2. Run $ composer install in the terminal.
3. Setup mySQL databases. Instructions using MAMP as server:
  1. Enter $ /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
  2. Turn on servers in MAMP
  3. Access phpMyAdmin
  4. Import library.sql and library_test.sql from the GitHub project folder.
4. In another tab in the terminal, run $ cd ~/Path/To/Project/Folder
5. In order to get into the web directory, run $ cd web
6. In order to start a PHP server, run $ php -S localhost:8000
7. Direct browser to localhost:8000
8. Keep track of those stylists!

## Technologies Used

PHP, mySQL
This app uses the Silex framework to structure the app and Twig for the views.

### Legal

Copyright (c) 2015 Phillip Shannon, Adam Won, Marcos Moncivais

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
