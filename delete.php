<?php
require_once 'db.php';

// Get student ID from URL
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

// Fetch student data to display confirmation using prepared statement
try {
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $student = $stmt->fetch();

    if (!$student) {
        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {
    die('Error fetching student: ' . $e->getMessage());
}

// Handle deletion confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    try {
        // Prepared statement to prevent SQL injection
        $stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
        $stmt->execute([':id' => $id]);

        // Redirect to index with success message
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        $error = 'Error deleting student: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="form-page delete-page">
    <div class="form-container">
        <h1>🗑️ Delete Student</h1>
        <p class="subtitle">Confirm deletion</p>

        <?php if (isset($error)): ?>
            <div class="alert-error">
                ✗ <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="warning-box">
            <div class="warning-icon">⚠️</div>
            <div class="warning-text">
                Are you sure you want to delete this student?<br>
                <strong>This action cannot be undone!</strong>
            </div>

            <div class="student-info">
                <div class="info-row">
                    <div class="info-label">ID:</div>
                    <div class="info-value"><?php echo htmlspecialchars($student['id']); ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Name:</div>
                    <div class="info-value"><?php echo htmlspecialchars($student['name']); ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value"><?php echo htmlspecialchars($student['email']); ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Course:</div>
                    <div class="info-value"><?php echo htmlspecialchars($student['course']); ?></div>
                </div>
            </div>
        </div>

        <form method="POST" action="">
            <div class="button-group">
                <button type="submit" name="confirm_delete" class="btn btn-danger">
                    Yes, Delete Student
                </button>
                <a href="index.php" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</body>

</html>