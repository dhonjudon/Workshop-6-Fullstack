<?php
require_once 'db.php';

$success = '';
$error = '';
$student = null;

// Get student ID from URL
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

// Fetch student data using prepared statement
try {
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $student = $stmt->fetch();

    if (!$student) {
        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {
    $error = 'Error fetching student: ' . $e->getMessage();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');

    // Validation
    if (empty($name) || empty($email) || empty($course)) {
        $error = 'All fields are required!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address!';
    } else {
        try {
            // Prepared statement to prevent SQL injection
            $stmt = $pdo->prepare("UPDATE students SET name = :name, email = :email, course = :course WHERE id = :id");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':course' => $course,
                ':id' => $id
            ]);

            $success = 'Student updated successfully!';

            // Update student data to show new values
            $student['name'] = $name;
            $student['email'] = $email;
            $student['course'] = $course;

            // Redirect after 2 seconds
            header("refresh:2;url=index.php");
        } catch (PDOException $e) {
            $error = 'Error updating student: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="form-page">
    <div class="form-container">
        <h1>✏️ Edit Student</h1>
        <p class="subtitle">Update student information</p>

        <?php if ($student): ?>
            <div class="student-id">
                Editing Student ID: <?php echo htmlspecialchars($student['id']); ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success">
                ✓ <?php echo htmlspecialchars($success); ?> Redirecting...
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-error">
                ✗ <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php if ($student): ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label>Name <span class="required">*</span></label>
                    <input type="text" name="name" placeholder="Enter student name"
                        value="<?php echo htmlspecialchars($student['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Email <span class="required">*</span></label>
                    <input type="email" name="email" placeholder="Enter email address"
                        value="<?php echo htmlspecialchars($student['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Course <span class="required">*</span></label>
                    <select name="course" required>
                        <option value="">-- Select Course --</option>
                        <option value="Computer Science" <?php echo ($student['course'] === 'Computer Science') ? 'selected' : ''; ?>>Computer Science</option>
                        <option value="Information Technology" <?php echo ($student['course'] === 'Information Technology') ? 'selected' : ''; ?>>Information Technology</option>
                        <option value="Software Engineering" <?php echo ($student['course'] === 'Software Engineering') ? 'selected' : ''; ?>>Software Engineering</option>
                        <option value="Data Science" <?php echo ($student['course'] === 'Data Science') ? 'selected' : ''; ?>>
                            Data Science</option>
                        <option value="Cybersecurity" <?php echo ($student['course'] === 'Cybersecurity') ? 'selected' : ''; ?>>Cybersecurity</option>
                        <option value="Web Development" <?php echo ($student['course'] === 'Web Development') ? 'selected' : ''; ?>>Web Development</option>
                        <option value="Mobile Development" <?php echo ($student['course'] === 'Mobile Development') ? 'selected' : ''; ?>>Mobile Development</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Student</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>