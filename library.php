<?php
try {
    // Connect to the library database using PDO
    $pdo = new PDO(dsn: "mysql:host=localhost;dbname=library", username: "username", password: "", options: [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]); 

    // INSERT book
    $stmt = $pdo->prepare(query: "INSERT INTO books (title, author, genre, published_year) VALUES (:title, :author, :genre, :published_year)");
    $stmt->execute(params: ["title" => "Midnight Sun", "author" => "Stephenie Meyer", "genre" => "Romance Novel", "published_year" => 2020]);
    echo "Book 'Midnight Sun' added successfully.\n";

    // INSERT another book
    $stmt->execute(params: ["title" => "One Day", "author" => "David Nicholls", "genre" => "Romance Novel", "published_year" => 2009]);
    echo "Book 'One Day' added successfully.\n";

    // SELECT all books
    $stmt = $pdo->query(query: "SELECT * FROM books");
    $books = $stmt->fetchAll();
    echo "\nAll Books:\n";
    foreach ($books as $book) {
        echo "ID: {$book['id']}, Title: {$book['title']}, Author: {$book['author']}, Genre: {$book['genre']}, Year: {$book['published_year']}\n";
    }

    // UPDATE a book's details (example given: change genre of 'Midnight Sun')
    $stmt = $pdo->prepare(query: "UPDATE books SET genre = ? WHERE title = ?");
    $stmt->execute(params: ["Young Adult", "Midnight Sun"]);
    echo "\nUpdated genre for 'Midnight Sun' to Young Adult.\n";

    // SELECT all books again to show update
    $stmt = $pdo->query(query: "SELECT * FROM books");
    $books = $stmt->fetchAll();
    echo "\nUpdated Book List:\n";
    foreach ($books as $book) {
        echo "ID: {$book['id']}, Title: {$book['title']}, Author: {$book['author']}, Genre: {$book['genre']}, Year: {$book['published_year']}\n";
    }

    // DELETE a book
    $stmt = $pdo->prepare(query: "DELETE FROM books WHERE title = ?");
    $stmt->execute(params: ["One Day"]);
    echo "\nBook 'One Day' deleted successfully.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
//Close Connection
    $pdo = null;
}
?>