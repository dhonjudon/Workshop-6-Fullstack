<?php
require_once 'db.php';

// Fetch all students from database
$stmt = $pdo->query("SELECT * FROM students ORDER BY id ASC");
$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List - CRUD Application</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="index-page">
    <div class="container">
        <h1> Student List Management</h1>
        <p class="subtitle">Week 6 - PHP & MySQL CRUD Application</p>

        <div class="header-actions">
            <h2>All Students (<?php echo count($students); ?>)</h2>
            <a href="create.php" class="btn btn-primary">+ Add New Student</a>
        </div>

        <?php if (count($students) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['id']); ?></td>
                            <td><?php echo htmlspecialchars($student['name']); ?></td>
                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                            <td><?php echo htmlspecialchars($student['course']); ?></td>
                            <td>
                                <div class="actions">
                                    <a href="edit.php?id=<?php echo $student['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete.php?id=<?php echo $student['id']; ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <p style="font-size: 48px;">📚</p>
                <h3>No students found</h3>
                <p>Click "Add New Student" to get started!</p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>