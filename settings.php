<?php
session_start();
include('database_conn.php');
include('fpdf/fpdf.php'); 

$contact_info = $first_name = $last_name = $password = '';
$old_password_error = $password_change_success = $password_change_error = '';
$export_success = '';
$export_error = '';

if (isset($_SESSION['role']) && $_SESSION['role'] === 'teacher') {
    $user_name = $_SESSION['user_name'];

    $sql_query = "SELECT contact_info, name, password FROM teachers WHERE name = ?";
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param('s', $user_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $contact_info = $row['contact_info'];
        $password = $row['password'];
    }
} elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $user_name = $_SESSION['user_name']; 

   
    $sql_query = "SELECT first_name, last_name, password FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param('s', $user_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $password = $row['password'];
    }
} else {
    $user_name = "Guest";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_password = $_POST['old-password'] ?? '';
    $new_password = $_POST['new-password'] ?? '';

    if ($old_password === $password) {
        if ($_SESSION['role'] === 'teacher') {
            $update_query = "UPDATE teachers SET password = ? WHERE name = ?";
        } else {
            $update_query = "UPDATE admin SET password = ? WHERE username = ?";
        }
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param('ss', $new_password, $user_name);

        if ($update_stmt->execute()) {
            $password_change_success = "Password updated successfully!";
        } else {
            $password_change_error = "Failed to update the password.";
        }
    } else {
        $old_password_error = "Old password is incorrect.";
    }

    if (isset($_POST['export-type']) && isset($_POST['export-table'])) {
        $export_type = $_POST['export-type'];
        $export_table = $_POST['export-table'];

        if ($export_table === 'students') {
            $sql_export = "SELECT * FROM students";
        } elseif ($export_table === 'teachers') {
            $sql_export = "SELECT * FROM teachers";
        } else {
            $export_error = "Invalid table selected.";
        }

        if (isset($sql_export)) {
            $result = $conn->query($sql_export);
            if ($result->num_rows > 0) {
                if ($export_type === 'pdf') {
                    $pdf = new FPDF();
                    $pdf->AddPage();
                    $pdf->SetFont('helvetica', 'B', 16);
                    $pdf->Cell(0, 10, 'Exported Data', 0, 1, 'C');
                    $pdf->SetFont('helvetica', '', 12);

                    if ($export_table === 'students') {
                        $headers = ['Student ID', 'First Name', 'Last Name', 'DOB', 'Gender', 'Phone', 'Home Address', 'Grade Level', 'Enrollment Date', 'Parent Names', 'Parent Contact'];
                    } elseif ($export_table === 'teachers') {
                        $headers = ['Teacher ID', 'Name', 'Gender', 'Subject', 'Contact Info', 'Home Address', 'Username', 'Password'];
                    }


                    foreach ($headers as $header) {
                        $pdf->Cell(40, 10, $header, 1);
                    }
                    $pdf->Ln();

                    while ($row = $result->fetch_assoc()) {
                        foreach ($row as $column) {
                            $pdf->Cell(40, 10, $column, 1);
                        }
                        $pdf->Ln();
                    }

                    $pdf->Output($export_table . '.pdf', 'D'); 
                    exit();
                } elseif ($export_type === 'csv') {
                    header('Content-Type: text/csv');
                    header('Content-Disposition: attachment; filename="' . $export_table . '.csv"');
                    $output = fopen("php://output", "w");
                    $fields = $result->fetch_fields();
                    $headers = [];
                    foreach ($fields as $field) {
                        $headers[] = $field->name;
                    }
                    fputcsv($output, $headers);

                    while ($row = $result->fetch_assoc()) {
                        fputcsv($output, $row);
                    }
                    fclose($output);
                    exit();
                } elseif ($export_type === 'excel') {
                   
                }

                $export_success = "Data exported successfully.";
            } else {
                $export_error = "No data found to export.";
            }
        }
    }
}

include("C:/xampp/htdocs/Record-Management-System-second_revision/navbar.php");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Account Settings</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .settings-container {
            margin: 20px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: calc(100% - 250px);
            margin: 0 auto;
        }

        .settings-section {
            margin-bottom: 20px;
        }

        .settings-section h2 {
            border-bottom: 2px solid #4caf50;
            padding-bottom: 5px;
            margin-bottom: 15px;
            font-size: 1.5em;
        }

        .settings-item {
            margin-bottom: 10px;
        }

        .settings-item label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .settings-item input[type="text"],
        .settings-item input[type="password"],
        .settings-item select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .settings-item input[type="checkbox"] {
            margin-right: 5px;
        }

        .settings-item button {
            padding: 10px 15px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .settings-item button:hover {
            background-color: #45a049;
        }

        /* @media (max-width: 768px) {
        .navbar {
          width: 100%;
          left: 0;
        }

        .sidebar {
          width: 100%;
          height: auto;
          position: relative;
          display: flex;
          flex-direction: row;
          overflow-x: auto;
        }

        .settings-container {
          width: 100%;
          margin-left: 0;
        }

        .sidebar a {
          flex: 1;
          text-align: center;
        }
      } */
    </style>
</head>
<body>
<div class="burger-menu" id="burgerMenu">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>

    <div class="sidebar" id="sidebar">
        <h2>VNHS RMS</h2>
        <a href="Dashboard.php">Dashboard</a>
        <a href="http://localhost/proj3rec.management/student_record.php">Student Records</a>
        <a href="http://localhost/proj3rec.management/view_teachers.php">Teacher Records</a>
        <a href="settings.html">Settings</a>
        <a href="#logout" class="logout">Log out</a>
    </div>

    <div class="settings-container">
        <div class="settings-section">
            <h2>User Account Settings</h2>
            <div class="settings-item">
                <label for="profile-name">Profile Name:</label>
                <input type="text" id="profile-name" value="<?php echo htmlspecialchars($user_name); ?>" />
            </div>

            <?php if ($_SESSION['role'] === 'teacher') { ?>
                <div class="settings-item">
                    <label for="profile-email">Email:</label>
                    <input type="text" id="profile-email" value="<?php echo htmlspecialchars($contact_info); ?>" />
                </div>
            <?php } elseif ($_SESSION['role'] === 'admin') { ?>
                <div class="settings-item">
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" value="<?php echo htmlspecialchars($first_name); ?>" />
                </div>
                <div class="settings-item">
                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" value="<?php echo htmlspecialchars($last_name); ?>" />
                </div>
            <?php } ?>
        </div>

        <form method="POST" action="">
            <div class="settings-item">
                <label for="old-password">Old Password:</label>
                <input type="password" id="old-password" name="old-password" required />
                <?php if ($old_password_error): ?>
                    <p style="color: red;"><?php echo $old_password_error; ?></p>
                <?php endif; ?>
            </div>

            <div class="settings-item">
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new-password" required />
            </div>

            <div class="settings-item">
                <button type="submit">Change Password</button>
                <?php if ($password_change_success): ?>
                    <p style="color: green;"><?php echo $password_change_success; ?></p>
                <?php elseif ($password_change_error): ?>
                    <p style="color: red;"><?php echo $password_change_error; ?></p>
                <?php endif; ?>
            </div>
        </form>

        <h2>Data Management Settings</h2>
        <form method="POST" action="">
            <div class="settings-item">
                <label for="export-table">Select Table to Export:</label>
                <select id="export-table" name="export-table" required>
                    <option value="students">Students</option>
                    <option value="teachers">Teachers</option>
                </select>
            </div>

            <div class="settings-item">
                <label for="export-type">Export Format:</label>
                <select id="export-type" name="export-type" required>
                    <option value="csv">CSV</option>
                    <option value="excel">Excel</option>
                    <option value="pdf">PDF</option>
                </select>
            </div>

            <div class="settings-item">
                <button type="submit">Export Now</button>
            </div>

            <?php if ($export_success): ?>
                <p style="color: green;"><?php echo $export_success; ?></p>
            <?php elseif ($export_error): ?>
                <p style="color: red;"><?php echo $export_error; ?></p>
            <?php endif; ?>
        </form>
    </div>

    <script src="burger_menu.js"></script>
</body>
</html>