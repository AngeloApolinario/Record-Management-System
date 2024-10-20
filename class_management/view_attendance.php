<?php
include("database_conn.php");
include("C:/xampp/htdocs/Record-Management-System-second_revision/navbar.php");

$sections_query = "SELECT section_id, section_name FROM section";
$sections_result = $conn->query($sections_query);
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
        .attendance-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .attendance-table th,
        .attendance-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .attendance-table th {
            background-color: #007BFF;
            color: white;
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
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required>
            <button type="submit">View Attendance</button>
        </form>

        <?php
        if (isset($_GET['section_id']) && isset($_GET['date'])) {
            $section_id = $_GET['section_id'];
            $date = $_GET['date'];

            $attendance_query = "
            SELECT s.first_name, s.last_name, a.status
            FROM attendance a
            JOIN students s ON a.student_id = s.student_id
            WHERE a.section_id = ? AND a.date = ?
            ";

            $stmt = $conn->prepare($attendance_query);
            $stmt->bind_param('is', $section_id, $date);
            $stmt->execute();
            $attendance_result = $stmt->get_result();

            if ($attendance_result->num_rows > 0) {
                echo "<table class= 'attendance-table'>
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
                echo "<p>No attendance records found for the selected date and section.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
