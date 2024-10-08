<?php
include 'database_conn.php';
include("C:/xampp/htdocs/Record-Management-System-second_revision/navbar.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $gender = $_POST['contact_info'];
    $contact_info = $_POST['contact_info'];
    $home_address = $_POST['home_address'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO teachers (name, subject, contact_info) VALUES ('$name', '$subject',$gender, '$contact_info', '$home_address', '$username', '$password')";

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
    <link rel="stylesheet" type="text/css" href="/Record-Management-System-second_revision/sidebar-navbar.css">
</head>
<style>
    label {
        font-family: Arial, sans-serif;
        font-size: 16px;
        color: #333;
    }

    select {
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        background-color: #f9f9f9;
        color: #333;
        width: 150px;
        cursor: pointer;
        outline: none;
    }

    select:focus {
        border-color: #66afe9;
        background-color: #fff;
    }


</style>

<body>


    <div class="burger-menu" id="burgerMenu">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>

    <div class="sidebar" id="sidebar">
        <h2>VNHS RMS</h2>
        <a href="Dashboard.php">Dashboard</a>
        <a href="student_record.php">Student Records</a>
        <a href="view_teachers.php">Teacher Records</a>
        <a href="settings.html">Settings</a>
        <a href="#logout" class="logout">Log out</a>
    </div>



    <div class="add_teacher_container">
        <h2>Add New Teacher</h2>
        <form method="POST" action="">
            Name: <input type="text" name="name" required><br>
            Subject: <input type="text" name="subject" required><br>
            <label for="select_gender">Gender:</label> <br> <br>
            <select name="gender" id="select_gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select> <br><br>
            Contact Info: <input type="text" name="contact_info" required><br>
            Home Address: <input type="text" name="home_address" required><br>
            Username: <input type="text" name="username" required><br>
            Password: <input type="text" name="password" required><br>
            <button type="submit" name="submit">Add Teacher</button>
        </form>
    </div>


    <script src="burger_menu.js"></script>

</body>

</html>