<?php
include("database_conn.php");

// Handle form submission for updating student information
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Collect updated data from the form
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $grade = $_POST['grade'];
    $enrollment_date = $_POST['enrollment_date'];
    $emergency_contacts = $_POST['emergency_contacts'];
    $medical_info = $_POST['medical_info'];
    $parent_names = $_POST['parent_names'];
    $parent_contact = $_POST['parent_contact'];

    // Prepare the SQL query to update the student's information
    $sql = "UPDATE students SET 
                first_name = ?, 
                last_name = ?, 
                grade = ?, 
                enrollment_date = ?, 
                emergency_contacts = ?, 
                medical_info = ?, 
                parent_names = ?, 
                parent_contact = ? 
            WHERE student_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $first_name, $last_name, $grade, $enrollment_date, $emergency_contacts, $medical_info, $parent_names, $parent_contact, $student_id);

    if ($stmt->execute()) {
        $message = "Student information updated successfully!";
        $message_class = "success";
    } else {
        $message = "Error updating record: " . $conn->error;
        $message_class = "error";
    }

    $stmt->close();
    $conn->close();
    header("Location: edit_student.php?message=" . urlencode($message) . "&message_class=" . urlencode($message_class));
    exit;
}
?>
