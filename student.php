<?php
try {
    // Connect to the school database using PDO
    $pdo = new PDO(dsn: "mysql:host=localhost;dbname=school", username: "username", password: "password", options: [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // INSERT a new attendance record
    $stmt = $pdo->prepare(query: "INSERT INTO attendance (student_name, date, status) VALUES (?, ?, ?)");
    $stmt->execute(params: ["Kristine Garcia", "2025-06-12", "Present"]);
    echo "Attendance record for Kristine Garcia added successfully.\n";

    // SELECT all attendance records
    $stmt = $pdo->query(query: "SELECT * FROM attendance");
    $records = $stmt->fetchAll();
    echo "\nAll Attendance Records:\n";
    foreach ($records as $record) {
        echo "ID: {$record['id']}, Student: {$record['student_name']}, Date: {$record['date']}, Status: {$record['status']}\n";
    }

    // UPDATE an attendance record (e.g., change status to Late)
    $stmt = $pdo->prepare(query: "UPDATE attendance SET status = ? WHERE student_name = ? AND date = ?");
    $stmt->execute(params: ["Late", "Kristine Garcia", "2025-06-12"]);
    echo "\nUpdated Kristine Garcia's attendance status to Late.\n";

    // SELECT all attendance records again to show update
    $stmt = $pdo->query(query: "SELECT * FROM attendance");
    $records = $stmt->fetchAll();
    echo "\nUpdated Attendance Records:\n";
    foreach ($records as $record) {
        echo "ID: {$record['id']}, Student: {$record['student_name']}, Date: {$record['date']}, Status: {$record['status']}\n";
    }

    // DELETE an attendance record
    $stmt = $pdo->prepare(query: "DELETE FROM attendance WHERE student_name = ? AND date = ?");
    $stmt->execute(params: ["Kristine Garcia", "2025-06-12"]);
    echo "\nAttendance record for Kristine Garcia deleted successfully.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    //Close Connection
    $pdo = null;
}
?>