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

        form {
            margin-top: 20px;
        }

        label {
            display: inline-block;
            width: 150px;
            margin-right: 10px;
        }

        select,
        input {
            margin-bottom: 10px;
            padding: 5px;
            width: 300px;
        }

        .form-section {
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 70%;
        }

        .form-section form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .form-section form div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 10px;
        }

        .form-section form label {
            width: 30%;
        }

        .form-section form input {
            width: 65%;
            padding: 20px 20px;
            border-radius: 5px;
            outline: none;
            border: none;
            background-color: #f0f0f0;
        }

        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
        <h2>Search for Student</h2>
        <form action="" method="post">
            <input type="text" name="searchQuery" id="searchQuery" required placeholder="Enter student's first or last name">
            <br>
            <button type="submit" name="search_student">Search Student</button>
        </form>
    </div>

    <?php


    if (isset($_POST['search_student'])) {
        $searchQuery = mysqli_real_escape_string($conn, $_POST['searchQuery']); // Sanitize user input

        $search_query = "SELECT student_id, first_name, last_name FROM students 
                     WHERE first_name LIKE '%$searchQuery%' 
                     OR last_name LIKE '%$searchQuery%'";
        $search_result = mysqli_query($conn, $search_query);

        if (mysqli_num_rows($search_result) > 0) {
            echo "<table>";
            echo "<tr><th>Student ID</th><th>Student Name</th><th>Assign to Class</th></tr>";
            while ($student = mysqli_fetch_assoc($search_result)) {
                echo "<tr>";
                echo "<td>{$student['student_id']}</td>";
                echo "<td>{$student['first_name']} {$student['last_name']}</td>";
                echo "<td>
                    <form action='' method='post'>
                        <input type='hidden' name='student_id' value='{$student['student_id']}'>
                        <label for='class'>Select Class:</label>
                        <select name='class_id' id='class' required>
                            <option value=''>Select a class</option>";

                $classes_query = "SELECT section_id, section_name FROM section";
                $classes_result = mysqli_query($conn, $classes_query);
                while ($class = mysqli_fetch_assoc($classes_result)) {
                    echo "<option value='{$class['section_id']}'>{$class['section_name']}</option>";
                }

                echo "      </select>
                        <button type='submit' name='assign_student'>Assign</button>
                    </form>
                  </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<h1 style = 'text-align:center;'>No students found matching the search query.</h1>";
        }
    }

    if (isset($_POST['assign_student'])) {
        $student_id = $_POST['student_id'];
        $section_id = $_POST['class_id'];

        if (empty($section_id)) {
            echo "<p>Please select a class before assigning the student.</p>";
        } else {
            $check_query = "SELECT * FROM student_section WHERE student_id = '$student_id' AND section_id = '$section_id'";
            $check_result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                echo "<p>Student is already assigned to this section!</p>";
            } else {
                $assign_query = "INSERT INTO student_section (student_id, section_id) VALUES ('$student_id', '$section_id')";

                if (mysqli_query($conn, $assign_query)) {
                    echo "<p>Student assigned to section successfully!</p>";

                    $class_query = "SELECT class_id FROM schedule WHERE section_id = '$section_id'";
                    $class_result = mysqli_query($conn, $class_query);

                    while ($class = mysqli_fetch_assoc($class_result)) {
                        $class_id = $class['class_id'];

                        $enroll_class_query = "INSERT INTO student_class (student_id, class_id) VALUES ('$student_id', '$class_id')";

                        // if (mysqli_query($conn, $enroll_class_query)) {
                        //     echo "<p>Student successfully enrolled in class ID: $class_id.</p>";
                        // } else {
                        //     echo "<p>Error enrolling student in class ID: $class_id. " . mysqli_error($conn) . "</p>";
                        // }
                    }
                } else {

                    echo "<p>Error: " . mysqli_error($conn) . "</p>";
                }
            }
        }
    }

    ?>




</body>

</html>