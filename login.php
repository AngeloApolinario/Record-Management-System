<?php
include('database_conn.php');
session_start();

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  // Check role and adjust query based on the role
  if ($role == "admin") {
    // Admin login query
    $verification_query = "SELECT * FROM admin WHERE username LIKE ? AND password LIKE ?";
  } else {
    // Teacher login query
    $verification_query = "SELECT * FROM teachers WHERE username LIKE ? AND password LIKE ?";
  }

  $stmt = $conn->prepare($verification_query);
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); 
    $user_name = $user['name']; 

    // Set session variables for both name and role
    $_SESSION['user_name'] = $user_name;
    $_SESSION['role'] = $role;

    header("Location: dashboard.php"); // Redirect to dashboard
    exit();
  } else {
    echo "<script>alert('Incorrect Username or Password');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
       
       * {
           margin: 0;
           padding: 0;
           box-sizing: border-box;
       }

       
       body {
           margin: 0;
           font-family: Arial, sans-serif;
           background-color: #2c3e50;
           display: flex;
           justify-content: center;
           align-items: center;
           height: 100vh;
       }

     
       .login-container {
           display: flex;
           justify-content: center;
           align-items: center;
           width: 100%;
           height: 100vh;
       }

       
       .login-box {
           background-color: rgba(255, 255, 255, 0.95);
           padding: 40px;
           border-radius: 15px;
           box-shadow: 0px 4px 25px rgba(0, 0, 0, 0.2);
           width: 500px;
           text-align: center;
       }

       
       .logo-container {
           margin-bottom: 20px;
       }

       .logo {
           width: 100px;
       }

       .login-box label {
           display: block;
           margin-bottom: 10px;
           font-size: 16px;
           color: #333;
       }

       
       .login-box input,
       .login-box select {
           width: 100%;
           padding: 12px;
           margin-bottom: 20px;
           border: 1px solid #ccc;
           border-radius: 5px;
           font-size: 15px;
       }

      
       .login-box button {
           background-color: #007bff;
           color: white;
           padding: 14px;
           border: none;
           border-radius: 5px;
           width: 100%;
           font-size: 16px;
           cursor: pointer;
           transition: background-color 0.3s ease;
       }

       .login-box button:hover {
           background-color: #0056b3;
       }

       
       .login-box h2 {
           margin-bottom: 20px;
           font-size: 24px;
           color: #333;
       }

      
       .login-box select {
           padding: 12px;
           border: 1px solid #ccc;
           border-radius: 5px;
           margin-bottom: 20px;
       }

       
       @media (max-width: 768px) {
           .login-box {
               width: 80%;
               padding: 30px;
           }

           .logo {
               width: 80px;
           }

           .login-box h2 {
               font-size: 22px;
           }

           .login-box input,
           .login-box select {
               font-size: 14px;
               padding: 10px;
           }

           .login-box button {
               padding: 12px;
               font-size: 14px;
           }
       }

       @media (max-width: 480px) {
           .login-box {
               width: 90%;
               padding: 20px;
           }

           .logo {
               width: 70px;
           }

           .login-box h2 {
               font-size: 20px;
           }

           .login-box input,
           .login-box select {
               font-size: 13px;
               padding: 8px;
           }

           .login-box button {
               padding: 10px;
               font-size: 13px;
           }
       }
   </style>
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <div class="logo-container">
        <img src="vega national high school.png" alt="Logo" class="logo" />
      </div>
      <h2>Teacher & Admin Login</h2>
      <form action="" method="post">
        <label for="role">Select Role</label>
        <select id="role" name="role">
          <option value="admin">Admin</option>
          <option value="teacher">Teacher</option>
        </select>
        <input type="text" id="username" name="username" placeholder="Enter your username" required />
        <input type="password" id="password" name="password" placeholder="Enter your password" required />
        <button type="submit" name="submit">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
