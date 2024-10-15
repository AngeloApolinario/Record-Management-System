<style>
    * {
        margin: 0;
    }

    .schedule-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .schedule-table th,
    .schedule-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .schedule-table th {
        background-color: #007BFF;
        color: white;
    }

    .content {
        padding: 20px;
        width: 96%;
        background-color: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin: 20px auto;
    }
</style>
<?php

include("C:/xampp/htdocs/Record-Management-System-second_revision/navbar.php");
include("database_conn.php");
$section_id = $_GET['section_id'];

if (!isset($section_id) || empty($section_id)) {
    die("Error: section_id is not set or is empty.");
}

$scheduleQuery = "
    SELECT c.subject, sch.day_of_week, sch.start_time, sch.end_time, t.name AS teacher_name 
    FROM schedule sch
    JOIN classes c ON sch.class_id = c.class_id
    JOIN teachers t ON c.teacher_id = t.teacher_id
    WHERE sch.section_id = ?
";


$stmt = $conn->prepare($scheduleQuery);
if (!$stmt) {
    die("SQL Error: " . $conn->error);
}
$stmt->bind_param('i', $section_id);
$stmt->execute();
$result = $stmt->get_result();



if ($result->num_rows == 0) {
    echo "No schedule found for this section.";
} else {
    $sectionQuery = "SELECT section_name FROM section WHERE section_id = ?";
    $stmt = $conn->prepare($sectionQuery);
    $stmt->bind_param('i', $section_id);
    $stmt->execute();
    $stmt->bind_result($section_name);
    $stmt->fetch();
    $stmt->close();

    echo "<div class = 'content'>";
    echo "<h2>Schedule for Section " . htmlspecialchars($section_name) . "</h2>";

    echo "<table border='1' class='schedule-table'>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Day of the Week</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Teacher</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['subject'] . "</td>
                <td>" . $row['day_of_week'] . "</td>
                <td>" . $row['start_time'] . "</td>
                <td>" . $row['end_time'] . "</td>
                <td>" . $row['teacher_name'] . "</td>
              </tr>";
    }

    echo "</tbody></table>";
    echo "</div>";
}
