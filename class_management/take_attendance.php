<?php
include("database_conn.php");
include("C:/xampp/htdocs/Record-Management-System-second_revision/navbar.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $present_students = isset($_POST['attendance']) ? $_POST['attendance'] : []; // Array of present student IDs
    $section_id = $_POST['section_id'];
    $class_id = $_POST['class_id']; // Assuming class_id is passed in hidden input

    // Current date for attendance
    $date = date('Y-m-d');

    // Retrieve all students in the class and section
    $students_query = "
        SELECT s.student_id 
        FROM students s
        JOIN student_class sc ON s.student_id = sc.student_id
        JOIN student_section ss ON s.student_id = ss.student_id
        WHERE sc.class_id = ? AND ss.section_id = ?
    ";

    $stmt = $conn->prepare($students_query);
    $stmt->bind_param('ii', $class_id, $section_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Process attendance
    while ($student = $result->fetch_assoc()) {
        $student_id = $student['student_id'];
        
        // Determine if the student is present or absent
        $status = in_array($student_id, $present_students) ? 'Present' : 'Absent';
        
        // Insert attendance record into the database
        $insert_query = "
            INSERT INTO attendance (student_id, class_id, section_id, date, status)
            VALUES (?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE status = VALUES(status)
        ";
        
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param('iiiss', $student_id, $class_id, $section_id, $date, $status);
        $insert_stmt->execute();
    }

    echo "<p>Attendance submitted successfully!</p>";
} else {
    // Show the attendance form
    $section_id = $_GET['section_id'];
    $class_id = $_GET['class_id'];

    $students_query = "
    SELECT s.first_name, s.last_name, sc.student_id, ss.section_id
    FROM students s
    JOIN student_class sc ON s.student_id = sc.student_id
    JOIN student_section ss ON s.student_id = ss.student_id
    WHERE sc.class_id = ? AND ss.section_id = ?
    ";

    $stmt = $conn->prepare($students_query);
    $stmt->bind_param('ii', $class_id, $section_id);
    $stmt->execute();
    $students_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Attendance</title>
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
        }
        .container{
            margin: 20px auto;
            width: 95%;
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
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
        th, td {
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
        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <h1>Take Attendance</h1>
    <form method="post" action="" class="container"> 
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Present</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($student = $students_result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($student['first_name']) . "</td>
                        <td>" . htmlspecialchars($student['last_name']) . "</td>
                        <td><input type='checkbox' name='attendance[]' value='" . htmlspecialchars($student['student_id']) . "'></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <input type="hidden" name="section_id" value="<?= htmlspecialchars($section_id) ?>"> 
        <input type="hidden" name="class_id" value="<?= htmlspecialchars($class_id) ?>">
        <button type="submit">Submit Attendance</button>
    </form>
</body>

</html>

<?php
}
?>
