





<?php
include("database_conn.php");

// Initialize variables
$fields = [];
$result = null;

$view_all_query = "SELECT * FROM students";
$query = $view_all_query;

// Handle form submissions
if (isset($_POST["submit-button"])) {
    $search = filter_input(INPUT_POST, "search-input", FILTER_SANITIZE_SPECIAL_CHARS);
    $search_type = $_POST['search-type'];

    if ($search_type == 'id') {
        $query = "SELECT * FROM students WHERE student_id = ?";
    } else if ($search_type == 'name') {
        $query = "SELECT * FROM students WHERE first_name LIKE ?";
        $search = "%$search%";
    }

    if ($stmt = mysqli_prepare($conn, $query)) {
        if ($search_type == 'id') {
            mysqli_stmt_bind_param($stmt, 'i', $search);
        } else if ($search_type == 'name') {
            mysqli_stmt_bind_param($stmt, 's', $search);
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $fields = mysqli_fetch_fields($result);
    }
} else if (isset($_POST["view-all-button"]) || !isset($_POST["submit-button"])) {
    $result = mysqli_query($conn, $view_all_query);
    if ($result) {
        $fields = mysqli_fetch_fields($result);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="sidebar.css">
  
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F9FA;
            margin: 0;
            
        }

        /* Navbar Styles */
        .navbar {
            background-color: #2C3E50;
            padding: 10px 20px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            width: 50px;
        }

        .searchBar {
            display: flex;
            align-items: center;
            width: 60%;
        }

        .search {
            padding: 10px;
            width: 100%;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #FFFFFF;
        }

        .search-button {
            padding: 10px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-left: 10px;
        }

        .search-button:hover {
            background-color: #0056b3;
        }

        

      
       
        .content {
    margin-left: 50px;
    padding: 20px;
    display: flex;
    justify-content: flex-end; 
    flex-direction: column;}
    .content form{
        
    }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .search-bar {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-bar select,
        .search-bar input {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .search-bar input[type="text"] {
            width: 300px;
            margin-left: 10px;
        }

        .view-all-button {
            padding: 10px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-left: 10px;
        }

        .view-all-button:hover {
            background-color: #0056b3;
        }

        .action-buttons {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }

        .add_student,
        .edit_button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .add_student:hover,
        .edit_button:hover {
            background-color: #45a049;
        }

        .student-table {
    width: 100%; /* Make sure the table takes full width */
    max-width: 100%; /* Prevent the table from exceeding the screen width */
    border-collapse: collapse;
    margin-top: 20px;
    overflow-x: auto; /* Enable horizontal scrolling if content overflows */
}

.student-table th,
.student-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    word-wrap: break-word; /* Break long words for responsiveness */
}

.student-table th {
    background-color: #007BFF;
    color: white;
}
        .student-table td a:hover {
            text-decoration: underline;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination button {
            padding: 10px 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            cursor: pointer;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            margin: 0 5px;
        }

        .pagination button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    
<!-- Burger Menu Icon -->
<div class="burger-menu" id="burgerMenu">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
        <h2>VNHS RMS</h2>
        <a href="dashboard.html">dashboard</a>
        <a href="http://localhost/proj3rec.management/student_record.php">Student Records</a>
        <a href="http://localhost/proj3rec.management/view_teachers.php">Teacher Records</a>
        

        <a href="settings.html">Settings</a>
        <a href="#logout" class="logout">Log out</a>
    </div>



    <div class="content">
        <h1>Student Records</h1>
        <form class="search-bar" method="post" action="student_record.php">
            <select name="search-type" class="search-type">
                <option value="id">Search by ID</option>
                <option value="name">Search by Name</option>
            </select>
            <input type="text" placeholder="Search..." name="search-input">
            <input type="submit" class="search-button" value="Search" name="submit-button">
            <input type="submit" class="view-all-button" value="View All" name="view-all-button">
        </form>

        <div class="action-buttons">
            <form action="add.php" method="post">
                <button type="submit" class="add_student">Add New Student</button>
            </form>
            <form action="edit_student.php" method="post">
                <button type="submit" class="edit_button">Edit</button>
            </form>
        </div>

        <table class="student-table">
            <thead>
                <tr>
                    <?php
                    if ($fields) {
                        foreach ($fields as $field) {
                            echo "<th>{$field->name}</th>";
                        }
                        echo "<th>Actions</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        foreach ($row as $cell) {
                            echo "<td>$cell</td>";
                        }
                        echo "<td><a href='edit_student.php?student_id={$row['student_id']}'>Edit</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <div class="pagination">
            <button>Previous</button>
            <button>Next</button>
        </div>
    </div>
  
    <script src="burger_menu.js"></script>
</body>
</html>
