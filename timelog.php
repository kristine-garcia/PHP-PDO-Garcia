<?php
try {
    // Connect to the company_db database using PDO
    $pdo = new PDO(dsn: "mysql:host=localhost;dbname=company_db", username: "username", password: "password", options: [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // INSERT a new timelog
    $stmt = $pdo->prepare(query: "INSERT INTO timelogs (employee_name, log_date, log_time, type) VALUES (:employee_name, :log_date, :log_time, :type)");
    $stmt->execute(params: [
        "employee_name" => "Kristine Garcia",
        "log_date" => "2025-06-12",
        "log_time" => "09:00:00",
        "type" => "IN"
    ]);
    echo "Timelog for Kristine Garcia added successfully.\n";

    // SELECT all timelogs
    $stmt = $pdo->query(query: "SELECT * FROM timelogs");
    $timelogs = $stmt->fetchAll();
    echo "\nAll Timelogs:\n";
    foreach ($timelogs as $log) {
        echo "ID: {$log['id']}, Employee: {$log['employee_name']}, Date: {$log['log_date']}, Time: {$log['log_time']}, Type: {$log['type']}\n";
    }

    // UPDATE a timelog's type
    $stmt = $pdo->prepare(query: "UPDATE timelogs SET type = ? WHERE employee_name = ? AND log_date = ? AND log_time = ?");
    $stmt->execute(params: ["OUT", "Kristine Garcia", "2025-06-12", "09:00:00"]);
    echo "\nUpdated Kristine Garcia's timelog type to OUT.\n";

    // SELECT all timelogs again to show update
    $stmt = $pdo->query(query: "SELECT * FROM timelogs");
    $timelogs = $stmt->fetchAll();
    echo "\nUpdated Timelogs:\n";
    foreach ($timelogs as $log) {
        echo "ID: {$log['id']}, Employee: {$log['employee_name']}, Date: {$log['log_date']}, Time: {$log['log_time']}, Type: {$log['type']}\n";
    }

    // DELETE a timelog
    $stmt = $pdo->prepare(query: "DELETE FROM timelogs WHERE employee_name = ? AND log_date = ? AND log_time = ?");
    $stmt->execute(params: ["Kristine Garcia", "2025-06-12", "09:00:00"]);
    echo "\nTimelog for Kristine Garcia deleted successfully.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    //Close Connection
    $pdo = null;
}
?>