CREATE DATABASE IF NOT EXISTS school;
USE school;
CREATE TABLE IF NOT EXISTS attendance(
id INT PRIMARY KEY AUTO_INCREMENT,
student_name VARCHAR(255) NOT NULL,
date DATE NOT NULL,
status ENUM('Present', 'Absent', 'Late') NOT NULL
);