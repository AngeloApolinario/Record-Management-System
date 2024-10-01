<?php
include 'database_conn.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $contact_info = $_POST['contact_info'];

    $query = "INSERT INTO teachers (name, subject, contact_info) VALUES ('$name', '$subject', '$contact_info')";

    if (mysqli_query($conn, $query)) {
        header("Location: view_teachers.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Teacher</title>
    <link rel="stylesheet" href="teacher_style.css">
    <link rel="stylesheet" href="sidebar-navbar.css">
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

    <nav class="navbar">
        <img src="vega national high school.png" alt="" class="logo" />
        <div class="nav-links">
            <a href="Dashboard.html">Dashboard</a>
            <a href="http://localhost/proj3rec.management/student_record.php">Student Records</a>
            <a href="http://localhost/proj3rec.management/view_teachers.php">Teacher Records</a>
            <a href="settings.html">Settings</a>
            <a href="#logout" class="logout">Log out</a>
        </div>
    </nav>

    <div class="add_teacher_container">
        <h2>Add New Teacher</h2>
        <form method="POST" action="">
            Name: <input type="text" name="name" required><br>
            Subject: <input type="text" name="subject" required><br>
            Contact Info: <input type="text" name="contact_info" required><br>
            <button type="submit" name="submit">Add Teacher</button>
        </form>
    </div>


    <script src="burger_menu.js"></script>

</body>

</html>