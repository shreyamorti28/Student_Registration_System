<?php include 'db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <link rel="stylesheet" href="manage-students.css">
</head>
<body>
    <h2>Student Information Form</h2>
    <form method="post">
        <label for="student_id">Student ID:</label><br>
        <input type="number" id="student_id" name="student_id" required><br>
        
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        
        <label for="age">Age:</label><br>
        <input type="number" id="age" name="age"><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        
        <label for="course">Course:</label><br>
        <input type="text" id="course" name="course"><br>
        
        <input type="submit" name="insert_student" value="Add Student">
    </form>

    <?php
    if (isset($_POST['insert_student'])) {
        $student_id = $_POST['student_id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $course = $_POST['course'];

        // Check if student ID already exists
        $stmt = $conn->prepare("SELECT id FROM students WHERE id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo "Student ID $student_id already exists.";
        } else {
            // Insert new student record
            $stmt = $conn->prepare("INSERT INTO students (id, name, age, email, course) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param("isiss", $student_id, $name, $age, $email, $course);

            if ($stmt->execute()) {
                echo "New student record created successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
        $stmt->close();
    }
    ?>

    <br><a href="index.php">Go Back to Home</a>
</body>
</html>
