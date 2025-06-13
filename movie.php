<?php
try {
    // Connect to the video_store database using PDO
    $pdo = new PDO(dsn: "mysql:host=localhost;dbname=video_store", username: "username", password: "password", options: [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // INSERT a new movie
    $stmt = $pdo->prepare(query: "INSERT INTO movies (title, director, release_year, available) VALUES (:title, :director, :release_year, :available)");
    $stmt->execute(params: [
        "title" => "Twilight",
        "director" => "Stephenie Meyer",
        "release_year" => 2008,
        "available" => 1
    ]);
    echo "Movie 'Twilight' added successfully.\n";

    // SELECT all movies
    $stmt = $pdo->query(query: "SELECT * FROM movies");
    $movies = $stmt->fetchAll();
    echo "\nAll Movies:\n";
    foreach ($movies as $movie) {
        $availability = $movie['available'] ? "Available" : "Not Available";
        echo "ID: {$movie['id']}, Title: {$movie['title']}, Director: {$movie['director']}, Year: {$movie['release_year']}, Status: {$availability}\n";
    }

    // UPDATE a movie's availability
    $stmt = $pdo->prepare(query: "UPDATE movies SET available = ? WHERE title = ?");
    $stmt->execute(params: [0, "Twilight"]);
    echo "\nUpdated 'Twilight' availability to Not Available.\n";

    // SELECT all movies again to show update
    $stmt = $pdo->query(query: "SELECT * FROM movies");
    $movies = $stmt->fetchAll();
    echo "\nUpdated Movie List:\n";
    foreach ($movies as $movie) {
        $availability = $movie['available'] ? "Available" : "Not Available";
        echo "ID: {$movie['id']}, Title: {$movie['title']}, Director: {$movie['director']}, Year: {$movie['release_year']}, Status: {$availability}\n";
    }

    // DELETE a movie
    $stmt = $pdo->prepare(query: "DELETE FROM movies WHERE title = ?");
    $stmt->execute(params: ["Inception"]);
    echo "\nMovie 'Twilight' deleted successfully.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    //Close Connection
    $pdo = null;
}
?>