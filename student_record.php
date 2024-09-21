<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    *{
    margin: 0px;
    padding: 0;
    
    }
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
    .content {
        margin-left: 250px; 
        padding: 20px;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .search-bar {
        margin-bottom: 20px;
    }

    .search-bar input {
        padding: 10px;
        font-size: 16px;
    }

    .search-button{
        padding: 10px;
        font-size: 16px;
        background-color: #007BFF; 
        color: white;
        border: none;
        cursor: pointer;
    }

    .add-student {
        padding: 10px 15px;
        font-size: 16px;
        background-color: #28A745; 
        color: white;
        border: none;
        cursor: pointer;
        margin-bottom: 20px;
    }

    .student-table {
        width: 100%;
        border-collapse: collapse;
    }

    .student-table th, .student-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .student-table th {
        background-color: #007BFF; 
        color: white;
    }



    .student-table button {
        padding: 5px 10px;
        font-size: 14px;
        border: none;
        cursor: pointer;
    }

    .student-table button:hover {
        opacity: 0.8;
    }

    .pagination {
        margin-top: 20px;
    }

    .pagination button {
        padding: 10px 15px;
        font-size: 16px;
        border: 1px solid #ddd;
        cursor: pointer;
        background-color: #007BFF; 
        color: white;
    }

    .pagination button:hover {
        background-color: #0056b3; 
    }
    .search-type{
        padding: 10px;
        font-size: 16px;
        background-color: transparent;
    }
    .view-all-button{
        padding: 10px;
        font-size: 16px;
        background-color: #007BFF; 
        color: white;
        border: none;
        cursor: pointer;
    }
</style>
<body>
    <nav class="navbar">
        <img src="vega national high school.png" alt="" class="logo">
        <div class="searchBar">
            <input type="text" class="search" placeholder="Search...">  
        </div>
    </nav>
<?php
include("database_conn.php");
$view_all_query = "SELECT * FROM students";
$result = null;
$fields = [];

$query = $view_all_query;


if (isset($_POST["submit-button"])) {

    $search = filter_input(INPUT_POST, "search-input", FILTER_SANITIZE_SPECIAL_CHARS);
    $search_type = $_POST['search-type'];

    if ($search_type == 'id') {
        $query = "SELECT * FROM students WHERE student_id = ?";
    } else if ($search_type == 'name') {
        $query = "SELECT * FROM students WHERE first_name LIKE ?";
        $search = "%$search%"; 
    }


    if ($stmt = mysqli_prepare($con, $query)) {
        if ($search_type == 'id') {
            mysqli_stmt_bind_param($stmt, 'i', $search);
        } else if ($search_type == 'name') {
            mysqli_stmt_bind_param($stmt, 's', $search); 
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
} else if (isset($_POST["view-all-button"]) || !isset($_POST["submit-button"])) {

    $result = mysqli_query($con, $view_all_query);
}
if ($result) {
    $fields = mysqli_fetch_fields($result);
}
?>
<div class="sidebar">
    <h2>VNHS RMS</h2>
    <a href="dashboard.html">Dashboard</a>
    <a href="student_record.php">Student Records</a>
    <a href="teacher_record.php">Teacher Records</a>
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
        <input type="text" placeholder="Search..." name="search-input" />
        <input type="submit" class="search-button" value="Search" name="submit-button">
        <input type="submit" class="view-all-button" value="View All" name="view-all-button" >
    </form>
    
    <button class="add-student">Add New Student</button>
    
    <table class="student-table">
        <thead>
            <tr>
                <?php
                if ($fields) {
                    foreach ($fields as $field) {
                        echo "<th>{$field->name}</th>";
                    }
                    echo"<th>Actions</th>";
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
                    echo"<td><a href='edit_student.php?student_id={$row['student_id']}'>Edit</a></td>";
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
</body>
</html>