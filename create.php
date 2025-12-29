<?php
require_once 'db.php';

$success = '';
$error = '';

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
            $stmt = $pdo->prepare("INSERT INTO students (name, email, course) VALUES (:name, :email, :course)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':course' => $course
            ]);

            $success = 'Student added successfully!';

            // Redirect after 2 seconds
            header("refresh:2;url=index.php");
        } catch (PDOException $e) {
            $error = 'Error adding student: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="form-page">
    <div class="form-container">
        <h1>📝 Add New Student</h1>
        <p class="subtitle">Fill in the student details below</p>

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

        <form method="POST" action="">
            <div class="form-group">
                <label>Name <span class="required">*</span></label>
                <input type="text" name="name" placeholder="Enter student name"
                    value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label>Email <span class="required">*</span></label>
                <input type="email" name="email" placeholder="Enter email address"
                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label>Course <span class="required">*</span></label>
                <select name="course" required>
                    <option value="">-- Select Course --</option>
                    <option value="Computer Science" <?php echo (isset($_POST['course']) && $_POST['course'] === 'Computer Science') ? 'selected' : ''; ?>>Computer Science</option>
                    <option value="Information Technology" <?php echo (isset($_POST['course']) && $_POST['course'] === 'Information Technology') ? 'selected' : ''; ?>>Information Technology
                    </option>
                    <option value="Software Engineering" <?php echo (isset($_POST['course']) && $_POST['course'] === 'Software Engineering') ? 'selected' : ''; ?>>Software Engineering</option>
                    <option value="Data Science" <?php echo (isset($_POST['course']) && $_POST['course'] === 'Data Science') ? 'selected' : ''; ?>>Data Science</option>
                    <option value="Cybersecurity" <?php echo (isset($_POST['course']) && $_POST['course'] === 'Cybersecurity') ? 'selected' : ''; ?>>Cybersecurity</option>
                    <option value="Web Development" <?php echo (isset($_POST['course']) && $_POST['course'] === 'Web Development') ? 'selected' : ''; ?>>Web Development</option>
                    <option value="Mobile Development" <?php echo (isset($_POST['course']) && $_POST['course'] === 'Mobile Development') ? 'selected' : ''; ?>>Mobile Development</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Student</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>