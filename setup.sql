-- Week 6 - PHP & MySQL CRUD Application
-- Database Setup Script

-- Create database
CREATE DATABASE IF NOT EXISTS school_db;
USE school_db;

-- Create students table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    course VARCHAR(100) NOT NULL
);

-- Insert 5 sample student records
INSERT INTO students (name, email, course) VALUES
('John Doe', 'john.doe@email.com', 'Computer Science'),
('Jane Smith', 'jane.smith@email.com', 'Information Technology'),
('Michael Johnson', 'michael.j@email.com', 'Software Engineering'),
('Emily Brown', 'emily.brown@email.com', 'Data Science'),
('David Wilson', 'david.wilson@email.com', 'Cybersecurity');
