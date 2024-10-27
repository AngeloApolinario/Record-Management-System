<?php
include 'database_conn.php';

if (isset($_GET['id'])) {
    $teacher_id = mysqli_real_escape_string($conn, $_GET['id']);

  
    $query = "UPDATE teachers SET is_deleted = 1 WHERE teacher_id = '$teacher_id'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: view_teachers.php?message=Teacher+soft+deleted+successfully");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>