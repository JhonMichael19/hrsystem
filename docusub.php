<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../dash/login/indexlogin.php"); // Redirect if not an admin
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Files</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e3a66;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-left: 250px;
        }
        .container {
            display: flex;
            background: #1e3a66;
            padding: 20px;
            border-radius: 10px;
        }
        .sidebar {
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            background: #ffffff;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
            text-align: center;
        }
        .sidebar .logo img {
            width: 100px;
            height: auto;
            border-radius: 50%;
        }
        .table-container {
            background: white;
            border-radius: 10px;
            padding: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            color: black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background: #1e3a66;
            color: white;
        }
        .actions button {
            border: none;
            cursor: pointer;
            padding: 5px 8px;
            border-radius: 5px;
        }
        .view-btn {
            background: blue;
            color: white;
        }
        .delete-btn {
            background: red;
            color: white;
        }
    </style>
</head>
<body>
<div id="sidebar" class="sidebar">
    <div class="logo">
        <a href="http://localhost/dash/admindash/admindash.php">
            <img src="images/blogo.png" alt="Logo">
        </a>
    </div>
        <ul class="sidebar-nav">
            <li><a href="userprofile.php"><i class="fas fa-user"></i> User Profile</a></li>
            <li><a href="bcpnews.php"><i class="fas fa-newspaper"></i> BCP News Update</a></li>
            <li><a href="goaltarget.php"><i class="fas fa-bullseye"></i> Goal Target</a></li>
            <li><a href="Notifications.php"><i class="fas fa-bell"></i> Notification</a></li>
            <li><a href="specialrep.php"><i class="fas fa-file-alt"></i> Special Report Submission</a></li>
            <li><a href="register.php"><i class="fas fa-file-alt"></i> Employees Account Registration</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    
    <div class="container">
        <div class="table-container">
            <table>
                <tr>
                    <th>PDF</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td><a href="#">Download PDF</a></td>
                    <td class="actions">
                        <button class="view-btn"><i class="fa fa-eye"></i></button>
                        <button class="delete-btn"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td><a href="#">Download PDF</a></td>
                    <td class="actions">
                        <button class="view-btn"><i class="fa fa-eye"></i></button>
                        <button class="delete-btn"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td><a href="#">Download PDF</a></td>
                    <td class="actions">
                        <button class="view-btn"><i class="fa fa-eye"></i></button>
                        <button class="delete-btn"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
