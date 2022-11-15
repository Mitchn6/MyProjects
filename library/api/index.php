<?php
require 'Slim/Slim.php';
require 'book_db.php';
require 'database.php';
use Slim\Slim;
\Slim\Slim::registerAutoloader();

$app = new Slim();
$app->get('/books', 'getBooks');
$app->get('/books/:id',  'getBook');
$app->get('/books/search/:query', 'findByName');
$app->post('/books', 'addBook');
$app->delete('/books/:id',    'deleteBook');
$app->put('/books/:id', 'updateBook');
$app->run();
?>
