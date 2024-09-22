<?php


include 'database_conn.php'; // Database connection

$search = '';
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
}

$query = "SELECT * FROM teachers WHERE name LIKE '%$search%' OR subject LIKE '%$search%' OR contact_info LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>


<link rel="stylesheet" href="sidebar.css">



    <title>View Teachers</title>
    <style>


   
        /* General Body Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Flex Container for Search Form and Add Button */
        .top-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Search Form Styles */
        .search-form {
            display: flex;
            align-items: center;
        }

        .search-form input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 300px;
        }

        .search-form button {
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.3s ease;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }

        /* Add Teacher Button */
        .add-teacher-btn {
           
            padding: 15px 15px;
            font-size: 16px;
            text-align: center;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .logo{
    width: 50px;
    margin-left: 5px;
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



        .add-teacher-btn:hover {
            background-color: #0056b3;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Zebra Striping */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Action Links */
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .action-links a.edit {
            background-color: #28a745;
            color: white;
        }

        .action-links a.edit:hover {
            background-color: #218838;
        }

        .action-links a.delete {
            background-color: #dc3545;
            color: white;
        }

        .action-links a.delete:hover {
            background-color: #c82333;
        }

        /* Responsive Table */
        @media screen and (max-width: 768px) {
            table {
                width: 100%;
            }

            th, td {
                padding: 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="burger-menu" id="burgerMenu">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
        <h2>VNHS RMS</h2>
        <a href="dashboard.html">Dashboard</a>
        <a href="http://localhost/proj3rec.management/student_record.php">Student Records</a>
        <a href="http://localhost/proj3rec.management/view_teachers.php">Teacher Records</a>
        
        <a href="settings.html">Settings</a>
        <a href="#logout" class="logout">Log out</a>
    </div>
    <nav class="navbar">
        <img src="vega national high school.png" alt="" class="logo">
        <div class="searchBar">
            <input type="text" class="search" placeholder="Search...">  
        </div>
    </nav>
    <div class="container">
        <h2>Teachers List</h2>
        <a href="add_teacher.php" class="add-teacher-btn">Add Teacher</a>
        <!-- Top Controls Container -->
        <div class="top-controls">
            <form method="POST" class="search-form">
                <input type="text" name="search" placeholder="Search by name, subject, or contact info" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Contact Info</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['teacher_id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['subject']); ?></td>
                <td><?php echo htmlspecialchars($row['contact_info']); ?></td>
                <td class="action-links">
                    <a href="edit_teacher.php?id=<?php echo urlencode($row['teacher_id']); ?>" class="edit">Edit</a>
                    <a href="delete_teacher.php?id=<?php echo urlencode($row['teacher_id']); ?>" class="delete" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

  <script src="burger_menu.js"></script>
</body>
</html>
