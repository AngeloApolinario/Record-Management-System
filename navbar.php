<?php
session_start();

// Assuming you have a session variable that holds the role
// Example: $_SESSION['role'] = 'admin' or 'teacher';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation</title>
    <style>
        .logo {
            width: 50px;
            margin-left: 5px;
        }

        .searchBar {
            width: 60%;
        }

        .search {
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

        .navbar {
            background-color: #2C3E50;
            padding: 50px;
            color: white;
            text-align: center;
            font-size: 18px;
            display: flex;
            justify-content: space-between;
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

        .container {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            width: 250px;
            background-color: #45a35a;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transform: translateX(-300px);
            transition: transform 0.3s ease;
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .sidebar h2 {
            margin-top: 0;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px 0;
            font-size: 16px;
            transition: background-color 0.3s ease, padding-left 0.3s ease;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .sidebar a:hover {
            background-color: #d9e2eb;
            color: #333;
            padding-left: 15px;
        }

        /* Burger Menu Styles */
        .burger-menu {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            cursor: pointer;
        }

        /* Active Burger State */
        .burger-menu.active .line:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .burger-menu.active .line:nth-child(2) {
            opacity: 0;
        }

        .burger-menu.active .line:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        .burger-menu .line {
            width: 30px;
            height: 3px;
            background-color: #c8c9ca;
            margin: 5px 0;
            transition: background-color 0.3s ease;
        }

        .burger-menu .line:nth-child(2) {
            width: 25px;
        }

        .sidebar {
            display: block;
        }

        .navbar {
            display: none;
        }

        .burger-menu {
            display: none;
        }

        @media (min-width: 768px) {
            .sidebar {
                display: none;
            }

            .navbar {
                display: flex;
            }

            .burger-menu {
                display: none;
            }
        }

        @media (max-width: 767px) {
            .navbar {
                display: none;
            }

            .sidebar {
                display: block;
            }

            .burger-menu {
                display: block;
            }
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 60px;
            right: 210px;
            background-color: #f9f9f9;
            width: 200px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
        }

        .dropdown-content {
            padding: 10px;
            display: flex;
            flex-direction: column;
        }

        .dropdown-content p {
            margin: 0;
            cursor: pointer;
            padding: 10px;
            transition: background-color 0.3s;
        }

        .dropdown-content p:hover {
            background-color: #e9ecef;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 60px;
            right: 230px;
            background-color: #fff;
            width: 200px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
            overflow: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .dropdown-content {
            display: flex;
            flex-direction: column;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        .dropdown-content p {
            margin: 0;
            cursor: pointer;
            padding: 10px;
            transition: background-color 0.3s;
            color: darkolivegreen;
        }

        .dropdown-content p:hover {
            background-color: darkolivegreen;
            color: #fff;
        }
    </style>
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById("class-management-dropdown");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
            dropdown.style.opacity = dropdown.style.display === "block" ? "1" : "0";
            dropdown.style.visibility = dropdown.style.display === "block" ? "visible" : "hidden";
        }

        function navigateTo(url) {
            window.location.href = url;
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById("class-management-dropdown");
            const classManagementLink = document.querySelector('.nav-links a[onclick="toggleDropdown()"]');
            if (!event.target.closest('.nav-links a') && dropdown.style.display === "block") {
                dropdown.style.display = "none";
                dropdown.style.opacity = "0";
                dropdown.style.visibility = "hidden";
            }
        });
    </script>
</head>

<body>
    <nav class="navbar">
        <img src="/Record-Management-System-second_revision/vega national high school.png" alt="Vega National High School Logo" class="logo" />
        <div class="nav-links">
            <a href="/Record-Management-System-second_revision/Dashboard.php">Dashboard</a>
            <a href="/Record-Management-System-second_revision/student_record.php">Student Records</a>

            <!-- Conditionally hide "Teacher Records" based on role -->
            <?php if ($role !== 'teacher'): ?>
                <a href="/Record-Management-System-second_revision/view_teachers.php">Teacher Records</a>
            <?php endif; ?>

            <a href="javascript:void(0);" onclick="toggleDropdown()">Class Management</a>
            <div id="class-management-dropdown" class="dropdown">
                <div class="dropdown-content">
                    <p onclick="navigateTo('/Record-Management-System-second_revision/class_management/add_class.php')">Create Class</p>
                    <p onclick="navigateTo('/Record-Management-System-second_revision/class_management/assign_student_form.php')">Assign Student</p>
                    <p onclick="navigateTo('/Record-Management-System-second_revision/class_management/view_students_in_class.php')">View Section</p>
                    <p onclick="navigateTo('/Record-Management-System-second_revision/class_management/view_classes.php')">View Classes</p>
                    <p onclick="navigateTo('/Record-Management-System-second_revision/class_management/view_attendance.php')">View Attendance</p>
                </div>
            </div>

            <a href="/Record-Management-System-second_revision/settings.php">Settings</a>
            <a href="/Record-Management-System-second_revision/class_management/logout.php" class="logout">Log out</a>
        </div>
    </nav>
</body>

</html>