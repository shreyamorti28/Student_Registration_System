<?php include 'db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Table and Insert Data</title>
    <link rel="stylesheet" href="create_table.css">
</head>
<body>
    <h2>Create a New Table and Insert Values</h2>
    <form method="post">
        <label for="table_name">Table Name:</label><br>
        <input type="text" id="table_name" name="table_name" required><br>
        
        <label for="fields">Fields (Example: id INT PRIMARY KEY, name VARCHAR(100)):</label><br>
        <input type="text" id="fields" name="fields" required><br>
        
        <label for="values">Values (Example: 1, 'John Doe'):</label><br>
        <input type="text" id="values" name="values"><br>
        
        <input type="submit" name="create_table_and_insert" value="Create Table and Insert Data">
    </form>

    <?php
    if (isset($_POST['create_table_and_insert'])) {
        $table_name = $_POST['table_name'];
        $fields = $_POST['fields'];
        $values = $_POST['values'];

        // SQL to create table
        $sql_create = "CREATE TABLE $table_name ($fields)";
        if ($conn->query($sql_create) === TRUE) {
            echo "Table $table_name created successfully<br>";

            if (!empty($values)) {
                // SQL to insert data
                $sql_insert = "INSERT INTO $table_name VALUES ($values)";
                if ($conn->query($sql_insert) === TRUE) {
                    echo "Values inserted successfully into $table_name<br>";
                } else {
                    echo "Error inserting values: " . $conn->error . "<br>";
                }
            }
        } else {
            echo "Error creating table: " . $conn->error . "<br>";
        }
    }
    ?>

    <br><a href="index.php">Go Back to Home</a>
</body>
</html>
