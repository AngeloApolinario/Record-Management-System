<?php
include("database_conn.php");


if (isset($_GET['section_id']) && isset($_GET['class_id']) && isset($_GET['date']) && isset($_GET['download']) && $_GET['download'] == '1') {
    $section_id = $_GET['section_id'];
    $class_id = $_GET['class_id'];
    $date = $_GET['date'];

    $attendance_query = "
    SELECT s.first_name, s.last_name, a.status
    FROM attendance a
    JOIN students s ON a.student_id = s.student_id
    WHERE a.section_id = ? AND a.class_id = ? AND a.date = ?
    ";
    $stmt = $conn->prepare($attendance_query);
    $stmt->bind_param('iis', $section_id, $class_id, $date);
    $stmt->execute();
    $attendance_result = $stmt->get_result();

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="attendance_' . $date . '.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['First Name', 'Last Name', 'Status']); 

    while ($row = $attendance_result->fetch_assoc()) {
        fputcsv($output, [$row['first_name'], $row['last_name'], $row['status']]);
    }

    fclose($output);
    exit; 
}


include("C:/xampp/htdocs/Record-Management-System-second_revision/navbar.php");


$sections_query = "SELECT section_id, section_name FROM section";
$sections_result = $conn->query($sections_query);

$subjects_query = "SELECT class_id, subject FROM classes";
$subjects_result = $conn->query($subjects_query);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
        }
        .container {
            margin: 20px auto;
            width: 50%;
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        select, input[type="date"] {
            padding: 10px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 15px;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>View Attendance</h1>
        <form method="get" action="">
            <label for="section">Section:</label>
            <select name="section_id" id="section">
                <option value="">Select Section</option>
                <?php
                while ($section = $sections_result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($section['section_id']) . "'>" . htmlspecialchars($section['section_name']) . "</option>";
                }
                ?>
            </select>

            <label for="subject">Subject:</label>
            <select name="class_id" id="subject">
                <option value="">Select Subject</option>
                <?php
                while ($subject = $subjects_result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($subject['class_id']) . "'>" . htmlspecialchars($subject['subject']) . "</option>";
                }
                ?>
            </select>

            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required>

            <button type="submit">View Attendance</button>
            <button type="submit" name="download" value="1">Download Attendance</button>
        </form>

        <?php
        if (isset($_GET['section_id']) && isset($_GET['class_id']) && isset($_GET['date'])) {
            $section_id = $_GET['section_id'];
            $class_id = $_GET['class_id'];
            $date = $_GET['date'];

            // Fetch attendance records
            $attendance_query = "
            SELECT s.first_name, s.last_name, a.status
            FROM attendance a
            JOIN students s ON a.student_id = s.student_id
            WHERE a.section_id = ? AND a.class_id = ? AND a.date = ?
            ";
            $stmt = $conn->prepare($attendance_query);
            $stmt->bind_param('iis', $section_id, $class_id, $date);
            $stmt->execute();
            $attendance_result = $stmt->get_result();

            // Display attendance in a table
            if ($attendance_result->num_rows > 0) {
                echo "<table>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>";
                while ($row = $attendance_result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['first_name']) . "</td>
                        <td>" . htmlspecialchars($row['last_name']) . "</td>
                        <td>" . htmlspecialchars($row['status']) . "</td>
                    </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No attendance records found for the selected date, section, and subject.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
