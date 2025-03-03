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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="dashstyle.css">
  <link rel="shortcut icon" href="images/blogo.png" type="x-icon">
  <title>Dashboard</title>
  <style>
    .sidebar {
      width: 250px;
      position: fixed;
      left: -250px;
      top: 0;
      bottom: 0;
      background: #ffffff;
      padding-top: 20px;
      transition: left 0.3s ease;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
      overflow-y: auto;
    }
    .sidebar.active {
      left: 0;
    }
    .dropdown-menu {
      display: none;
      list-style: none;
      padding-left: 20px;
    }
    .dropdown.open .dropdown-menu {
      display: block;
    }
    #loading {
      position: fixed;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.8);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    }
    .loader {
      border: 5px solid #f3f3f3;
      border-top: 5px solid #3498db;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 1s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .main-content {
      margin-left: 0;
      transition: margin-left 0.3s ease;
    }
    .main-content.shift {
      margin-left: 250px;
    }

    .container {
            display: flex;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 800px;
            margin: 100px 500px;
            height: auto;
        }

        .profile-section {
            flex: 1;
            padding: 20px;
            background: #e9eef3;
            border-radius: 10px;
            text-align: center;
        }

        .avatar {
            width: 100px;
            height: 100px;
            background: gray;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 0 auto 15px;
            position: relative;
            cursor: pointer;
        }
        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }
        .avatar input {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        .avatar::after {
            content: "Add Photo";
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            font-size: 12px;
            opacity: 0;
            transition: opacity 0.3s;
            border-radius: 50%;
        }
        .avatar:hover::after {
            opacity: 1;
        }

        .input-group {
            margin-bottom: 10px;
            margin-right: 12px;
            
        }
        label {
            font-weight: bold;
            display: block;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .password-section {
            flex: 1;
            padding: 20px;
        }
        .UP{
            background: blue;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            margin-bottom: -20px;
        }
        .UP:hover{
            background: darkblue;
        }
        
        select {
          width: 100%;
          height: 30px;
        }
        .select{
          text-align: center;
        }
  </style>
</head>
<body>
  <div id="loading"><div class="loader"></div></div>
  <div id="sidebar" class="sidebar">
    <div class="logo">
        <a href="http://localhost/dash/admindash/admindash.php">
            <img src="images/blogo.png" alt="Logo">
        </a>
   
    <ul class="sidebar-nav">
    <li><a href="http://localhost/dash/admindash/userprofile.php"><i class="fas fa-user"></i> User Profile</a></li>
      <li><a href="http://localhost/dash/admindash/bcpnews.php"><i class="fas fa-newspaper"></i> BCP News Update</a></li>
      <li><a href="http://localhost/dash/admindash/goaltarget.php"><i class="fas fa-bullseye"></i> Goal Target</a></li>
      <li><a href="http://localhost/dash/admindash/Notifications.php"><i class="fas fa-bell"></i> Notification</a></li>
      <li><a href="http://localhost/dash/admindash/specialrep.php"><i class="fas fa-file-alt"></i> Special Report Submission</a></li>
      <li><a href="http://localhost/dash/login/register.php"><i class="fas fa-file-alt"></i> Employees Account Registration</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle"><i class="fas fa-users"></i> Applicant Tracking Management <i class="fas fa-chevron-down"></i></a>
        <ul class="dropdown-menu">
          <li><a href="http://localhost/dash/admindash/jobpost.php">Job Posting Management</a></li>
          <li><a href="http://localhost/dash/admindash/appmnge.php">Applicant Management</a></li>
          <li><a href="http://localhost/dash/admindash/emplist.php">Employee's List Management</a></li>
        </ul>
      </li>
      
      <li class="dropdown">
        <a class="dropdown-toggle"><i class="fas fa-user-tie"></i> Recruitment <i class="fas fa-chevron-down"></i></a>
        <ul class="dropdown-menu">
          <li><a href="http://localhost/dash/admindash/applist.php">Applicant List</a></li>
          <li><a href="http://localhost/dash/admindash/ATLDS.php">Applicant Tracking List Document Submission</a></li>
          <li><a href="http://localhost/dash/admindash/newrep.php">Notifications and Reports</a></li>
        </ul>
      </li>
      
      <li class="dropdown">
        <a class="dropdown-toggle"><i class="fas fa-sign-in-alt"></i> Onboarding <i class="fas fa-chevron-down"></i></a>
        <ul class="dropdown-menu">
          <li><a href="http://localhost/dash/admindash/workflow.php">Onboarding Workflow</a></li>
          <li><a href="http://localhost/dash/admindash/docusub.php">Document Submission List Record</a></li>
          <li><a href="http://localhost/dash/admindash/orient.php">Orientation Scheduling</a></li>
          <a class="dropdown-toggle"><i class="fas fa-sign-in-alt"></i> Applicant Process Tracking <i class="fas fa-chevron-down"></i></a>
        <ul class="dropdown-menu">
        <li><a href="http://localhost/dash/admindash/training.php">Training Management</a></li>
        <li><a href="http://localhost/dash/admindash/newhiredonboard.php">New-Hired Onboard</a></li>
          
          
        </ul>
      </li>
      <li><a href="http://localhost/dash/admindash/roleass.php">Role Assigning</a></li>
      
      <li><a href="http://localhost/dash/admindash/dashinteg.php"><i class="fas fa-plug"></i> Integration</a></li>
    
      <!-- Removed extra </li> here -->
      <li><a href="../login/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
  </div>
  </div>
  </div>
  <div id="main-content" class="main-content">
    <header class="header">
      <button id="sidebar-toggle" class="sidebar-toggle">&#9776;</button>
      <h1>User Profile</h1>
    </header>
    <section class="content">
      <div class="container">
        <form class="profile-section" action="update_profile.php" method="POST" enctype="multipart/form-data">
            <div class="avatar" id="avatar-preview">
                <img id="avatar-img" alt="Avatar">
                <input type="file" name="avatar" id="avatar-input" accept="image/*">
            </div>
            
            <h3>Profile</h3>
            <div class="input-group">
                <label>First Name</label>
                <input type="text" name="first_name" required>
            </div>
            <div class="input-group">
                <label>Middle Name</label>
                <input type="text" name="middle_name">
            </div>
            <div class="input-group">
                <label>Last Name</label>
                <input type="text" name="last_name" required>
            </div>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <label>Role/s</label>
            <select name="role">
              <option value="" class="select">--select option--</option>
              <option value="Office Staff">Office Staff</option>
              <option value="Office Clerk">Office Clerk</option>
              <option value="Professor Instructor">Professor Instructor</option>
              <option value="Security Guard">Security Guard</option>
            </select>
            <div class="password-section">
                <div class="input-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password">
                </div>
                <div class="input-group">
                    <label>New Password</label>
                    <input type="password" name="new_password">
                </div>
                <div class="input-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password">
                </div>
                <button type="submit" class="UP">Update Profile</button>
            </div>
        </form>
      </div>
    </section>
  </div>
  <script>
    window.addEventListener("load", function() {
      document.getElementById("loading").style.display = "none";
    });

    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebar-toggle");
    const dropdowns = document.querySelectorAll(".dropdown-toggle");
    const mainContent = document.getElementById("main-content");

    sidebarToggle.addEventListener("click", function() {
      sidebar.classList.toggle("active");
      mainContent.classList.toggle("shift");
    });

    dropdowns.forEach(dropdown => {
      dropdown.addEventListener("click", function(event) {
        event.preventDefault();
        this.parentElement.classList.toggle("open");
      });
    });
  </script>
</body>
</html>
