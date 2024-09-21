<?php
include("database_conn.php");


if (isset($_GET['student_id'])) {
    $id = $_GET['student_id'];

    $query = "SELECT * FROM students WHERE student_id = ?";
    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $record = mysqli_fetch_assoc($result);
    }
}

// Update the record when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $firt_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $student_id = $_POST['student-id'];
    $enrollment_date = $_POST['enrollment-date'];
    $grade = $_POST['grade'];
    $emergency_contacts = $_POST['emergency-contacts'];
    $medical_info = $_POST['medical-info'];
    $parent_names = $_POST['parent-names'];
    $parent_contact = $_POST['parent-contact'];
    $relationship = $_POST['relationship'];

    $query = "UPDATE students SET 
    first_name = ?, 
    last_name = ?,
    dob = ?, 
    gender = ?, 
    phone_number = ?, 
    email_address = ?, 
    home_address = ?, 
    grade_level = ?, 
    enrollment_date = ?, 
    emergency_contacts = ?, 
    medical_info = ?, 
    parent_names = ?, 
    parent_contact = ?, 
    relationship = ? 
    WHERE student_id = ?";

if ($stmt = mysqli_prepare($con, $query)) {
mysqli_stmt_bind_param($stmt, 'ssssssssssssssi', 
    $first_name, 
    $last_name, 
    $dob, 
    $gender, 
    $phone, 
    $email, 
    $address, 
    $grade_level, 
    $enrollment_date, 
    $emergency_contacts, 
    $medical_info, 
    $parent_names, 
    $parent_contact, 
    $relationship, 
    $student_id
);
mysqli_stmt_execute($stmt);
header("Location: student_record.php"); // Redirect back to the main page
exit;
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information Form</title>
    <style>
        /* CSS FOR DASHBOARD */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F8F9FA; 
        }
        .logo{
            width: 50px;
            margin-left: 50px;
        }
        .searchBar{
            width: 60%;
        }
        .search{
            padding: 10px;
            width: 700px;
            border-radius: 5px;
            border: none;
            outline: none;
        }
        .searchBar {
            position: relative;
            display: inline-block;
        }

        .search {
            width: 100%;
            padding: 10px 40px 10px 20px; 
            font-size: 16px;
            border: none;
            border-radius: 10px;
            box-sizing: border-box;

        }
        /* CSS FOR SIDEBAR */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            padding: 15px 20px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }
        .logout{
            position: absolute;
            bottom: 20px;
            width: 84%;
            text-align: center;
            background-color: #dc3545;
        }

        .sidebar a:hover {
            background-color: #575757;
        }
        /* CSS FOR NAVBAR */
        .navbar {
            background-color: #2C3E50; 
            padding: 10px;
            color: white;
            text-align: center;
            font-size: 18px;

            display: flex;
            justify-content: space-evenly;
            align-items: center;

            padding: 20px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: #0056b3; 
        }

        /* CSS FOR SIDEBAR */
        .sidebar {
            height: 100vh; 
            width: 250px;
            position: fixed;
            top: 0; 
            left: 0;
            background-color: #4CAF50; 
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); 
        }

        .sidebar a {
            padding: 15px 20px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #1E7E34;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .form-container {
            width: 70%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-section {
            margin-bottom: 20px;
        }
        .form-section h2 {
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 5px;
            margin-bottom: 15px;
            font-size: 1.5em;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input[type="text"], .form-group input[type="date"], .form-group input[type="email"], .form-group input[type="tel"], .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }
        .form-group button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <img src="vega national high school.png" alt="" class="logo">
        <div class="searchBar">
            <input type="text" class="search" placeholder="Search...">  
        </div>
    </nav>

    <div class="sidebar">
        <h2>VNHS RMS</h2>
        <a href="dashboard.html">Dashboard</a>
        <a href="student_record.php">Student Records</a>
        <a href="teacher_record.php">Teacher Records</a>
        <a href="#grades">Grades</a>
        <a href="settings.html">Settings</a>
        <a href="#logout" class="logout">Log out</a>
    </div>

    <div class="form-container">
        <h1>Edit Student</h1>

        <form action="edit_student.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
            <div class="form-section">
                <h2>Basic Personal Information</h2>
                <div class="form-group">
                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" name="last-name" value="<?php echo htmlspecialchars($record['last_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" name="first-name" value="<?php echo htmlspecialchars($record['first_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($record['dob']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="male" <?php echo ($record['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo ($record['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                        <option value="other" <?php echo ($record['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($record['phone_number']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($record['email_address']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Home Address:</label>
                    <textarea id="address" name="address" required><?php echo htmlspecialchars($record['home_address']); ?></textarea>
                </div>
            </div>

            <!-- Enrollment Information -->
            <div class="form-section">
                <h2>Enrollment Information</h2>
                <div class="form-group">
                    <label for="student-id">Student ID:</label>
                    <input type="text" id="student-id" name="student-id" value="<?php echo htmlspecialchars($record['student_id']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="enrollment-date">Enrollment Date:</label>
                    <input type="date" id="enrollment-date" name="enrollment-date" value="<?php echo htmlspecialchars($record['enrollment_date']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="grade">Grade/Year Level:</label>
                    <input type="text" id="grade" name="grade" value="<?php echo htmlspecialchars($record['grade_level']); ?>" required>
                </div>
            </div>

            <!-- Health and Emergency Information -->
            <div class="form-section">
                <h2>Health and Emergency Information</h2>
                <div class="form-group">
                    <label for="emergency-contacts">Emergency Contacts:</label>
                    <textarea id="emergency-contacts" name="emergency-contacts" required><?php echo htmlspecialchars($record['emergency_contacts']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="medical-info">Medical Information:</label>
                    <textarea id="medical-info" name="medical-info"><?php echo htmlspecialchars($record['medical_info']); ?></textarea>
                </div>
            </div>

            <!-- Parent/Guardian Information -->
            <div class="form-section">
                <h2>Parent/Guardian Information</h2>
                <div class="form-group">
                    <label for="parent-names">Parent/Guardian Names:</label>
                    <input type="text" id="parent-names" name="parent-names" value="<?php echo htmlspecialchars($record['parent_names']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="parent-contact">Contact Information:</label>
                    <textarea id="parent-contact" name="parent-contact" required><?php echo htmlspecialchars($record['parent_contact']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="relationship">Relationship to Student:</label>
                    <textarea id="relationship" name="relationship" required><?php echo htmlspecialchars($record['relationship']); ?></textarea>
                </div>
            </div>

            <input type="hidden" name="id" value="<?php echo htmlspecialchars($record['student_id']); ?>" />
            <div class="form-group">
                <button type="submit">Save Changes</button>
            </div>
        </form>
    </div>
</body>
</html>
