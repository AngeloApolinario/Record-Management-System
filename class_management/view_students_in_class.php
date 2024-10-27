<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/Record-Management-System-second_revision/sidebar-navbar.css">


    <style>
        * {
            margin: 0;
        }

        .class-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .class-table th,
        .class-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .content {
            margin: 20px auto;
            width: 95%;
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }


        .class-table th {
            background-color: #007BFF;
            color: white;
        }

        .edit-button,
        .delete-button,
        .save-button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;

        }

        .edit-button:hover,
        .delete-button:hover,
        .save-button:hover {
            background-color: #0056b3;
        }

        .schedule-button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
        }

        .schedule-button:hover {
            background-color: #0056b3;
        }

        .edit-row input,
        .edit-row select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .edit-row .save-button {
            background-color: #28a745;
        }

        .edit-row .save-button:hover {
            background-color: #218838;
        }

        .search-bar {
            margin: 20px 0;
        }

        .search-bar input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 300px;
        }

        .section_names {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
            padding: 4px 8px;
            border-radius: 4px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .section_names:hover {
            background-color: #e7f1ff;
            color: #0056b3;
        }

        .link {
            color: #007BFF;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {

            .class-table th,
            .class-table td {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>

    <script>
        function editClass(button) {
            const row = button.closest('tr');
            const nextRow = row.nextElementSibling;

            if (nextRow.style.display === 'none' || nextRow.style.display === '') {
                nextRow.style.display = 'table-row';
            } else {
                nextRow.style.display = 'none';
            }
        }
    </script>
</head>

<body>

    <?php
    include("database_conn.php");
    include("C:/xampp/htdocs/Record-Management-System-second_revision/navbar.php");

    $sectionQuery = "
    SELECT sec.section_id, sec.section_name, COUNT(CASE WHEN s.is_deleted = 0 OR s.is_deleted IS NULL THEN ss.student_id END) AS total_students 
    FROM section sec
    LEFT JOIN student_section ss ON sec.section_id = ss.section_id
    LEFT JOIN students s ON ss.student_id = s.student_id
    GROUP BY sec.section_id, sec.section_name
";

    $sectionResult = $conn->query($sectionQuery);


    $conn->close();
    ?>
    <div class="content">
        <h1 style="text-align:center;">Class Management</h1>


        <table border="1" class="class-table">
            <thead>
                <tr>
                    <th>Section Name</th>
                    <th>Total Students</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $sectionResult->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <a href="view_students.php?section_id=<?= $row['section_id'] ?>" target="_blank" class="section_names">
                                <?= $row['section_name'] ?>
                            </a>
                        </td>
                        <td>
                            <?= $row['total_students'] ?>
                        </td>
                        <td>
                            <a href="view_schedule.php?section_id=<?= $row['section_id'] ?>" target="_blank" class="schedule-button">View Schedule</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>

</body>

</html>