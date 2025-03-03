<?php
session_start();
include 'db_connect.php';

// Check if the user is an admin
$isAdmin = isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_number = $_POST['student_number'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $query = "INSERT INTO users (student_number, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $student_number, $hashed_password, $role);

    if ($stmt->execute()) {
        echo "<script>
                alert('Registration successful! Redirecting to login...');
                window.location.href = 'indexlogin.php';
              </script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Dashboard</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            position: fixed;
            left: -250px;
            top: 0;
            bottom: 0;
            background: #2c3e50;
            padding-top: 20px;
            transition: left 0.3s ease;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
            text-align: left;
            color: #ecf0f1;
        }
        .sidebar.active {
            left: 0;
        }
        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar .logo img {
            width: 80px;
            border-radius: 50%;
        }
        .sidebar-nav {
            list-style: none;
            padding: 0;
        }
        .sidebar-nav li {
            padding: 15px;
            cursor: pointer;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: 0.3s;
        }
        .sidebar-nav li:hover {
            background: #34495e;
        }
        .sidebar-nav a {
            text-decoration: none;
            color: #ecf0f1;
            font-size: 16px;
            display: flex;
            align-items: center;
        }
        .sidebar-nav i {
            margin-right: 10px;
        }

        /* Main Content */
        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s ease;
            padding: 20px;
        }
        .main-content.shift {
            margin-left: 250px;
        }
        .sidebar-toggle {
            font-size: 20px;
            cursor: pointer;
            border: none;
            background: none;
            color: #2c3e50;
        }

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease-in-out;
        }
        .modal-content {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
            width: 380px;
            text-align: center;
            position: relative;
            animation: slideDown 0.3s ease-in-out;
        }
        .close-btn {
            background: transparent;
            border: none;
            font-size: 20px;
            color: #e74c3c;
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 10px;
        }

        /* Form */
        .input-group {
            text-align: left;
            margin-bottom: 15px;
        }
        .input-group label {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .input-group input, .input-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
        }
        .input-group input:focus, .input-group select:focus {
            border-color: #3498db;
            outline: none;
        }

        /* Button */
        .register-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        .register-btn:hover {
            background-color: #2980b9;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideDown {
            from { transform: translateY(-20px); }
            to { transform: translateY(0); }
        }
    </style>
</head>
<body>

<?php if ($isAdmin): ?>
    <div id="sidebar" class="sidebar">
    <div class="logo">
        <a href="http://localhost/dash/admindash/admindash.php">
            <img src="images/blogo.png" alt="Logo">
        </a>
    </div>
        <ul class="sidebar-nav">
            <li><a href="#"><i class="fas fa-user"></i> User Profile</a></li>
            <li><a href="#" id="openModal"><i class="fas fa-user-plus"></i> Create Account</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div id="main-content" class="main-content">
        <header class="header">
            <button id="sidebar-toggle" class="sidebar-toggle">&#9776;</button>
            <h1>Dashboard</h1>
        </header>
    </div>

    <div id="registerModal" class="modal">
        <div class="modal-content">
            <button class="close-btn" id="closeModal">&times;</button>
            <h2>Create an Account</h2>
            <form action="register.php" method="POST">
                <div class="input-group"><label>Student Number:</label><input type="text" name="student_number" required></div>
                <div class="input-group"><label>Password:</label><input type="password" name="password" required></div>
                <div class="input-group"><label>Role:</label><select name="role"><option value="admin">Admin</option><option value="employee">Employee</option></select></div>
                <button type="submit" class="register-btn">Register</button>
            </form>
        </div>
    </div>

<?php endif; ?>

<script>
document.getElementById("openModal").onclick = () => document.getElementById("registerModal").style.display = "flex";
document.getElementById("closeModal").onclick = () => document.getElementById("registerModal").style.display = "none";
</script>

</body>
</html>
