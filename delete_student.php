<?php include 'db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="create_table.php">Create New Table</a></li>
            <li><a href="manage_students.php">Manage Students</a></li>
            <li><a href="update_student.php">Update Student</a></li>
            <li><a href="delete_student.php">Delete Student</a></li>
        </ul>
    </nav>

    <h2>Delete Student Record</h2>
    <form method="post">
        <label for="student_id">Student ID to Delete:</label>
        <input type="number" id="student_id" name="student_id" required>
        <input type="submit" name="delete_student" value="Delete Student">
    </form>

    <?php
    if (isset($_POST['delete_student'])) {
        $student_id = $_POST['student_id'];

        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $student_id);

        if ($stmt->execute()) {
            echo "<p>Record deleted successfully.</p>";
        } else {
            echo "<p>Error deleting record: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
    ?>

    <br><a href="index.php">Go Back to Home</a>
</body>
</html>
