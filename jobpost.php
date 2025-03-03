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
  <link rel="stylesheet" href="css/styles.css">
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
      text-align: center;
    }
    .sidebar.active {
      left: 0;
    }
    .sidebar .logo {
      margin-bottom: 20px;
    }
    .sidebar .logo img {
      width: 100px;
      height: auto;
      border-radius: 50%;
    }
    .dropdown-menu {
      display: none;
      list-style: none;
      padding-left: 20px;
    }
    .dropdown.open .dropdown-menu {
      display: block;
    }
    .dropdown-toggle {
      cursor: pointer;
      font-weight: bold;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .dropdown-toggle i {
      transition: transform 0.3s;
    }
    .dropdown.open .dropdown-toggle i {
      transform: rotate(180deg);
    }
    .main-content {
      margin-left: 0;
      transition: margin-left 0.3s ease;
    }
    .main-content.shift {
      margin-left: 250px;
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
  
  <div id="main-content" class="main-content">
    <header class="header">
      <button id="sidebar-toggle" class="sidebar-toggle">&#9776;</button>
      <h1>Job Posting</h1>
    </header>
  </div>
  
  <script>
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebar-toggle");
    const dropdowns = document.querySelectorAll(".dropdown-toggle");
    const mainContent = document.getElementById("main-content");

    sidebarToggle.addEventListener("click", function() {
      sidebar.classList.toggle("active");
      mainContent.classList.toggle("shift");
    });

    dropdowns.forEach(dropdown => {
      dropdown.addEventListener("click", function() {
        this.parentElement.classList.toggle("open");
      });
    });
  </script>
</body>
</html>
