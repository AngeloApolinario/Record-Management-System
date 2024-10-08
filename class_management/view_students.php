<style>
    *{
        margin: 0;
    }
    .content {
        margin: 20px auto;
        width: 95%;
        background-color: white;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .student-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .student-table th,
    .student-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .student-table th {
        background-color: #007BFF;
        color: white;
    }
</style>

<?php
include("C:/xampp/htdocs/Record-Management-System-second_revision/navbar.php");
include("database_conn.php");



$section_id = $_GET['section_id'];


$studentQuery = "
    SELECT s.student_id, s.first_name, s.last_name 
    FROM students s
    JOIN student_section ss ON s.student_id = ss.student_id
    WHERE ss.section_id = ?
";
$stmt = $conn->prepare($studentQuery);
$stmt->bind_param('i', $section_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="content">
        <h2>Students Enrolled in Section</h2>
        <table border="1" class="student-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['student_id'] ?></td>
                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['last_name'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>