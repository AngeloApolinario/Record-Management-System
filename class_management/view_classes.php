<?php
include("C:/xampp/htdocs/Record-Management-System-second_revision/navbar.php");
include("database_conn.php");


$teachers_query = "
    SELECT t.teacher_id, t.name AS teacher_name, c.class_id, c.subject, c.year_level
    FROM teachers t
    JOIN classes c ON t.teacher_id = c.teacher_id
    ORDER BY t.name, c.subject
";

$teachers_result = mysqli_query($conn, $teachers_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers and Their Classes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .container {
            padding: 20px;
            width: 96%;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 20px auto;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
        .class-detail-button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
        }

        .class-detail-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Teachers and Their Classes</h1>

        <table>
            <thead>
                <tr>
                    <th>Teacher Name</th>
                    <th>Class Name</th>
                    <th>Year Level</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each teacher and their classes
                while ($row = mysqli_fetch_assoc($teachers_result)) {
                    echo "<tr>
                <td>{$row['teacher_name']}</td>
                <td>{$row['subject']}</td>
                <td>{$row['year_level']}</td>
                <td><a href='view_class_details.php?class_id={$row['class_id']}' class = 'class-detail-button'>View Class Details</a></td>
              </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>