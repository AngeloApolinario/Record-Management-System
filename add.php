<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            margin: auto;
            width: 50%;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="tel"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <link rel="stylesheet" href="sidebar.css">


        <title>Student Information Form</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                padding: 20px;
            }

            .form-container {
                background-color: #fff;
                padding: 20px;
                margin: auto;
                width: 50%;
                border-radius: 10px;
                box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            }

            h2 {
                text-align: center;
                margin-bottom: 20px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            input[type="text"],
            input[type="date"],
            input[type="tel"],
            input[type="email"],
            select,
            textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            button {
                width: 100%;
                padding: 10px;
                background-color: #28a745;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }

            button:hover {
                background-color: #218838;
            }
        </style>
    </head>

    <body>

        <div class="burger-menu" id="burgerMenu">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>

        <div class="sidebar" id="sidebar">
            <h2>VNHS RMS</h2>
            <a href="dashboard.html">Dashboard</a>
            <a href="http://localhost/proj3rec.management/student_record.php">Student Records</a>
            <a href="http://localhost/proj3rec.management/view_teachers.php">Teacher Records</a>

            <a href="settings.html">Settings</a>
            <a href="#logout" class="logout">Log out</a>
        </div>



        <div class="form-container">
            <h2>Add Student Information</h2>
            <form action="http://localhost/proj3rec.management/add.php" method="POST">

                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="address">Home Address:</label>
                    <textarea id="address" name="address" required></textarea>
                </div>

                <div class="form-group">
                    <label for="grade_level">Grade Level:</label>
                    <input type="text" id="grade_level" name="grade_level" required>
                </div>

                <div class="form-group">
                    <label for="enrollment_date">Enrollment Date:</label>
                    <input type="date" id="enrollment_date" name="enrollment_date" required>
                </div>

                <div class="form-group">
                    <label for="emergency_contacts">Emergency Contacts:</label>
                    <textarea id="emergency_contacts" name="emergency_contacts" required></textarea>
                </div>

                <div class="form-group">
                    <label for="medical_info">Medical Information:</label>
                    <textarea id="medical_info" name="medical_info"></textarea>
                </div>

                <div class="form-group">
                    <label for="parent_names">Parent Names:</label>
                    <input type="text" id="parent_names" name="parent_names" required>
                </div>

                <div class="form-group">
                    <label for="parent_contact">Parent Contact:</label>
                    <input type="tel" id="parent_contact" name="parent_contact" required>
                </div>

                <div class="form-group">
                    <label for="relationship">Relationship:</label>
                    <input type="text" id="relationship" name="relationship" required>
                </div>

                <!-- Remove student_id from form -->
                <!-- <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" id="student_id" name="student_id" required>
            </div> -->

                <button type="submit">Submit</button>
            </form>
        </div>
        <script src="burger_menu.js"></script>
    </body>

    </html>

    <?php
    include("database_conn.php");

    // Function to generate a unique student ID
    function generateStudentId($conn)
    {
        $current_year = date("Y");

        $sql = "SELECT student_id FROM students WHERE student_id LIKE ? ORDER BY student_id DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $search_term = $current_year . '%';
        $stmt->bind_param("s", $search_term);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $last_student_id = $row['student_id'];
            $last_sequence = (int)substr($last_student_id, 4);
            $new_sequence = $last_sequence + 1;
        } else {
            $new_sequence = 1;
        }

        $student_id = $current_year . str_pad($new_sequence, 4, '0', STR_PAD_LEFT);
        return $student_id;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $home_address = $_POST['address'];
        $grade_level = $_POST['grade_level'];
        $enrollment_date = $_POST['enrollment_date'];
        $emergency_contacts = $_POST['emergency_contacts'];
        $medical_info = $_POST['medical_info'];
        $parent_names = $_POST['parent_names'];
        $parent_contact = $_POST['parent_contact'];
        $relationship = $_POST['relationship'];

        // Generate new student ID
        $student_id = generateStudentId($conn);

        // Prepare and execute the SQL statement
        $sql = "INSERT INTO students (student_id, first_name, last_name, dob, gender, phone, email, home_address, grade_level, enrollment_date, emergency_contacts, medical_info, parent_names, parent_contact, relationship) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssssssssssssss", $student_id, $first_name, $last_name, $dob, $gender, $phone, $email, $home_address, $grade_level, $enrollment_date, $emergency_contacts, $medical_info, $parent_names, $parent_contact, $relationship);

            if ($stmt->execute()) {
                echo "Record successfully inserted! Student ID: " . $student_id;
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }

        $conn->close();
    }
    ?>