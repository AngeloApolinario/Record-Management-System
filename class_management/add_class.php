<?php
include("database_conn.php");
include("C:/xampp/htdocs/Record-Management-System-second_revision/navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/Record-Management-System-second_revision/sidebar-navbar.css">
    <title>Class Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }

        h1,
        h2 {
            color: #333;
            text-align: center;
        }

        .form-section {
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        label {
            display: inline-block;
            width: 150px;
            margin-right: 10px;
            font-weight: bold;
        }

        select,
        input[type="text"],
        input[type="number"] {
            margin-bottom: 10px;
            padding: 10px;
            width: calc(100% - 170px);
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        select:focus,
        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #007BFF;
            outline: none;
        }

        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body>

    <h1>Class Management</h1>

    <div class="form-section">
        <h2>Add a New Class</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" name="subject" id="subject" required>
            </div>

            <div class="form-group">
                <label for="teacher_id">Select Teacher:</label>
                <select name="teacher_id" id="teacher_id" required>
                    <?php
                    $teachers_query = "SELECT teacher_id, name FROM teachers WHERE is_deleted = 0";
                    $teachers_result = mysqli_query($conn, $teachers_query);
                    while ($teacher = mysqli_fetch_assoc($teachers_result)) {
                        echo "<option value='{$teacher['teacher_id']}'>{$teacher['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="year_level">Year Level:</label>
                <input type="number" name="year_level" id="year_level" required>
            </div>

            <button type="submit" name="add_class">Add Class</button>
        </form>
    </div>

    <?php
    if (isset($_POST['add_class'])) {
        $subject = $_POST['subject'];
        $teacher_id = $_POST['teacher_id'];
        $year_level = $_POST['year_level'];

       
        $add_class_query = "INSERT INTO classes (subject, teacher_id, year_level) 
                            VALUES ('$subject', '$teacher_id', '$year_level')";

        if (mysqli_query($conn, $add_class_query)) {
            echo "<p>Class added successfully!</p>";
        } else {
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        }
    }
    ?>
</body>

</html>
