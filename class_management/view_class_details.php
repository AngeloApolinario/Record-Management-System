<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Details</title>
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

        .content {
            padding: 20px;
            width: 95%;
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

        .schedule-table {
            margin-top: 20px;
        }

        .schedule-table th {
            background-color: #28a745;
        }
    </style>
</head>

<body>

    <?php
    include("database_conn.php");
    include("C:/xampp/htdocs/Record-Management-System-second_revision/navbar.php");

    $class_id = $_GET['class_id'];

    $class_query = "
    SELECT c.subject, c.year_level, t.name AS teacher_name 
    FROM classes c
    JOIN teachers t ON c.teacher_id = t.teacher_id
    WHERE c.class_id = ?
";

    $stmt = $conn->prepare($class_query);
    $stmt->bind_param('i', $class_id);
    $stmt->execute();
    $class_result = $stmt->get_result();
    $class_info = $class_result->fetch_assoc();

    $student_count_query = "
    SELECT COUNT(sc.student_id) AS student_count
    FROM student_class sc
    WHERE sc.class_id = ?
";

    $stmt = $conn->prepare($student_count_query);
    $stmt->bind_param('i', $class_id);
    $stmt->execute();
    $student_count_result = $stmt->get_result();
    $student_count = $student_count_result->fetch_assoc()['student_count'];

    $schedule_query = "
    SELECT s.section_name, sch.section_id, sch.day_of_week, sch.start_time, sch.end_time
    FROM schedule sch
    JOIN section s ON sch.section_id = s.section_id
    WHERE sch.class_id = ?
    ORDER BY 
        FIELD(sch.day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
        sch.start_time
";


    $stmt = $conn->prepare($schedule_query);
    $stmt->bind_param('i', $class_id);
    $stmt->execute();
    $schedule_result = $stmt->get_result();

    $schedule = [];
    while ($sched = $schedule_result->fetch_assoc()) {
        $schedule[] = $sched;
    }

    $students_query = "
    SELECT s.first_name, s.last_name
    FROM students s
    JOIN student_class sc ON s.student_id = sc.student_id
    WHERE sc.class_id = ?
";

    $stmt = $conn->prepare($students_query);
    $stmt->bind_param('i', $class_id);
    $stmt->execute();
    $students_result = $stmt->get_result();
    ?>

    <div class="content">
        <h1>Class Details for <?= htmlspecialchars($class_info['subject']) ?> (Year <?= htmlspecialchars($class_info['year_level']) ?>)</h1>

        <h3><strong>Teacher:</strong> <?= htmlspecialchars($class_info['teacher_name']) ?></h3>
        <h3><strong>Number of Students:</strong> <?= htmlspecialchars($student_count) ?></h3>

        <h2>Schedule</h2>
        <table class="schedule-table">
            <thead>
                <tr>
                    <th>Day of Week</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Section</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($schedule as $sched) {
                    echo "<tr>
                    <td>" . htmlspecialchars($sched['day_of_week']) . "</td>
                    <td>" . htmlspecialchars($sched['start_time']) . "</td>
                    <td>" . htmlspecialchars($sched['end_time']) . "</td>
                    <td>" . htmlspecialchars($sched['section_name']) . "</td> 
                    <td><a href='take_attendance.php?class_id=" . $class_id . "&section_id=" . $sched['section_id'] . "&day=" . $sched['day_of_week'] . "'><button>Take Attendance</button></a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Enrolled Students</h2>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($student = $students_result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . htmlspecialchars($student['first_name']) . "</td>
                    <td>" . htmlspecialchars($student['last_name']) . "</td>
                  </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>