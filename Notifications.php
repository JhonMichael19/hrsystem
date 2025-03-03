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
    /* Sidebar Styles */
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

    /* Loading Animation */
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

    /* Main Content */
    .main-content {
      margin-left: 0;
      transition: margin-left 0.3s ease;
      padding: 20px;
    }
    .main-content.shift {
      margin-left: 250px;
    }

    /* Notification Styles */
    .dashboard {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
    }
    h2 {
      color: #333;
      text-align: center;
    }
    .notification-section {
      margin-top: 20px;
    }
    .notification-list {
      list-style: none;
      padding: 0;
    }
    .notification-item {
      background: #fff;
      padding: 10px;
      margin-bottom: 8px;
      border-radius: 5px;
      box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      transition: 0.3s;
    }
    .notification-item:hover {
      background: #e6f7ff;
    }
    .dismiss-btn {
      background: red;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- Loading Animation -->
  <div id="loading"><div class="loader"></div></div>

  <!-- Sidebar -->
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

  <!-- Main Content -->
  <div id="main-content" class="main-content">
    <header class="header">
      <button id="sidebar-toggle" class="sidebar-toggle">&#9776;</button>
      <h1>Notification</h1>
    </header>

    <!-- Notification Dashboard -->
    <div class="dashboard">
      <h2>Notification Dashboard</h2>

      <div class="notification-section">
        <h3>Newest Notifications</h3>
        <ul class="notification-list" id="newest-notifications"></ul>
      </div>

      <div class="notification-section">
        <h3>Earlier Notifications</h3>
        <ul class="notification-list" id="earlier-notifications"></ul>
      </div>
    </div>
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

    // Notifications
    const notifications = [
      { id: 1, message: "New Employee Added: John Doe", type: "newest" },
      { id: 2, message: "Complaint Report Filed", type: "newest" },
      { id: 3, message: "Weekly Progress Report Submitted", type: "earlier" },
      { id: 4, message: "New Goal Target Set", type: "earlier" }
    ];

    function displayNotifications() {
      document.getElementById("newest-notifications").innerHTML = notifications
        .filter(n => n.type === "newest")
        .map(n => `<li class="notification-item">${n.message} <button class="dismiss-btn" onclick="dismissNotification(${n.id})">X</button></li>`)
        .join("");

      document.getElementById("earlier-notifications").innerHTML = notifications
        .filter(n => n.type === "earlier")
        .map(n => `<li class="notification-item">${n.message} <button class="dismiss-btn" onclick="dismissNotification(${n.id})">X</button></li>`)
        .join("");
    }

    function dismissNotification(id) {
      notifications.splice(notifications.findIndex(n => n.id === id), 1);
      displayNotifications();
    }

    displayNotifications();
  </script>

</body>
</html>