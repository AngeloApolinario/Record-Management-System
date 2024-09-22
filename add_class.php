<?php
include 'database_conn.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class_name = $_POST['class_name'];
    $teacher_id = $_POST['teacher_id'];


    $sql = "INSERT INTO classes (class_name, teacher_id) VALUES ('$class_name', '$teacher_id')";
    
    if (mysqli_query($conn, $sql)) {

        header("Location: class.php");
        echo "Class added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>
