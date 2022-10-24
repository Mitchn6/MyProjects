<?php
function getBooks() {
	$query = "select * FROM books ORDER BY name";
	try {
	global $db;
		$books = $db->query($query);  
		$books = $books->fetchAll(PDO::FETCH_ASSOC);
		header("Content-Type: application/json", true);
		echo '{"books": ' . json_encode($books) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getBook($id) {
	$query = "SELECT * FROM books WHERE id = '$id'";
    try {
		global $db;
		$books = $db->query($query);  
		$book = $books->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json", true);
        echo json_encode($book);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function findByName($name) {
$query = "SELECT * FROM books WHERE UPPER(name) LIKE ". '"%'.$name.'%"'." ORDER BY name";
    try {
		global $db;
		$books = $db->query($query);  
		$book = $books->fetch(PDO::FETCH_ASSOC);
        header("Content-Type: application/json", true);
        echo json_encode($book);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function addBook() {
    global $app;
	$request = $app->request();
	$book = json_decode($request->getBody());
	$name = $book->name;
	$author = $book->author;
	$pages = $book->pages;
	$genre = $book->genre;
	$year = $book->year;
	$description = $book->description;
	$query= "INSERT INTO books
                 (name, year, author, pages, genre, description)
              VALUES
                 ('$name', '$author', '$pages', '$genre', '$year', '$description')";
	try {
		global $db;
		$db->exec($query);
		$book->id = $db->lastInsertId();
		echo json_encode($book); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
function deleteBook($id) {
	$query = "DELETE FROM books WHERE id=:id";
	try {
		global $db;
		$db->exec($query);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function updateBook($id) {
	global $app;
	$request = $app->request();
	$book = json_decode($request->getBody());
	$name = $book->name;
	$author = $book->author;
	$pages = $book->pages;
	$genre = $book->genre;
	$year = $book->year;
	$description = $book->description;
	$query = "UPDATE books SET name='$name', author='$author', pages='$pages', genre='$genre', year='$year', description='$description' WHERE id='$id'";
	try {
		global $db;
		$db->exec($query);
		echo json_encode($book); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

?>