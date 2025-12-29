# Week 6 - PHP & MySQL CRUD Application

## Student List Management System

A complete CRUD (Create, Read, Update, Delete) application for managing student records using PHP and MySQL.

## 📁 Project Structure

```
wsp6/
├── setup.sql          # Database setup script
├── db.php            # Database connection file
├── index.php         # Main page - Display all students (Read)
├── create.php        # Add new student form (Create)
├── edit.php          # Edit student form (Update)
└── delete.php        # Delete student confirmation (Delete)
```

## 🚀 Setup Instructions

### 1. Database Setup

1. Start XAMPP (Apache and MySQL services)
2. Open phpMyAdmin (http://localhost/phpmyadmin)
3. Import the `setup.sql` file, or run the following SQL commands:

```sql
CREATE DATABASE IF NOT EXISTS school_db;
USE school_db;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    course VARCHAR(100) NOT NULL
);

INSERT INTO students (name, email, course) VALUES
('John Doe', 'john.doe@email.com', 'Computer Science'),
('Jane Smith', 'jane.smith@email.com', 'Information Technology'),
('Michael Johnson', 'michael.j@email.com', 'Software Engineering'),
('Emily Brown', 'emily.brown@email.com', 'Data Science'),
('David Wilson', 'david.wilson@email.com', 'Cybersecurity');
```

### 2. Configure Database Connection

The database connection is already configured in `db.php` with default XAMPP settings:

- **Host:** localhost
- **Database:** school_db
- **Username:** root
- **Password:** (empty)

### 3. Access the Application

Open your browser and navigate to:

```
http://localhost/wsp6/
```

## ✨ Features

### ✅ Security Features

- **Prepared Statements:** All database queries use PDO prepared statements to prevent SQL injection
- **Input Validation:** Form inputs are validated before processing
- **Email Validation:** Email addresses are validated using PHP's filter_var()
- **XSS Prevention:** All output is escaped using htmlspecialchars()
- **Error Handling:** Comprehensive try-catch blocks for database operations

### 📋 CRUD Operations

#### Create (Add Student)

- Navigate to "Add New Student" button on the main page
- Fill in the form with name, email, and course
- Click "Add Student" to save the record

#### Read (View Students)

- The main page displays all students in a table
- Shows student ID, name, email, and course
- Displays total count of students

#### Update (Edit Student)

- Click the "Edit" button next to any student
- Modify the student information
- Click "Update Student" to save changes

#### Delete (Remove Student)

- Click the "Delete" button next to any student
- Confirm the deletion on the confirmation page
- Student record is permanently removed

## 🎨 Design Features

- Modern gradient background
- Responsive design
- Clean and intuitive user interface
- Color-coded buttons for different actions
- Hover effects on interactive elements
- Success and error message alerts
- Confirmation page for delete operations

## 🛡️ Security Implementation

All database operations use PDO prepared statements with named placeholders:

```php
// Example: Insert query
$stmt = $pdo->prepare("INSERT INTO students (name, email, course) VALUES (:name, :email, :course)");
$stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':course' => $course
]);
```

## 📝 Available Courses

- Computer Science
- Information Technology
- Software Engineering
- Data Science
- Cybersecurity
- Web Development
- Mobile Development

## 🔧 Technologies Used

- **Backend:** PHP 7+
- **Database:** MySQL
- **Frontend:** HTML5, CSS3
- **Database Layer:** PDO (PHP Data Objects)

## 📱 Pages Overview

1. **index.php** - Main dashboard showing all students
2. **create.php** - Form to add new students
3. **edit.php** - Form to update existing student information
4. **delete.php** - Confirmation page before deleting a student
5. **db.php** - Database connection configuration

## 🎯 Learning Outcomes

This project demonstrates:

- PHP and MySQL integration using PDO
- CRUD operations implementation
- Prepared statements for SQL injection prevention
- Form handling and validation
- Session-less application design
- Error handling and user feedback
- Modern web design principles

---

**Developed for Week 6 - PHP & MySQL Assignment**
