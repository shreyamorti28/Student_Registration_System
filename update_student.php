<?php include 'db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="update_student.css">
</head>
<body>
    <h2>Update Student Record</h2>
    <form method="post">
        <label for="student_id">Student ID to Update:</label><br>
        <input type="number" id="student_id" name="student_id" required><br>
        
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        
        <label for="age">Age:</label><br>
        <input type="number" id="age" name="age"><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        
        <label for="course">Course:</label><br>
        <input type="text" id="course" name="course"><br>
        
        <input type="submit" name="update_student" value="Update Student">
    </form>

    <?php
    if (isset($_POST['update_student'])) {
        $student_id = $_POST['student_id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $course = $_POST['course'];
        
        // Prepare dynamic update query
        $updates = [];
        $params = [];
        $types = '';
        
        if (!empty($name)) {
            $updates[] = "name = ?";
            $params[] = $name;
            $types .= 's';
        }
        if (!empty($age)) {
            $updates[] = "age = ?";
            $params[] = $age;
            $types .= 'i';
        }
        if (!empty($email)) {
            $updates[] = "email = ?";
            $params[] = $email;
            $types .= 's';
        }
        if (!empty($course)) {
            $updates[] = "course = ?";
            $params[] = $course;
            $types .= 's';
        }
        
        if (!empty($updates)) {
            $sql_update = "UPDATE students SET " . implode(", ", $updates) . " WHERE id = ?";
            $stmt = $conn->prepare($sql_update);
            $params[] = $student_id;
            $types .= 'i';
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                echo "Record updated successfully.";
            } else {
                echo "Error updating record: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "No fields to update.";
        }
    }
    ?>

    <br><a href="index.php">Go Back to Home</a>
</body>
</html>
