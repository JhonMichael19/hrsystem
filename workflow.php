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
    <title>Dashboard - Onboarding Workflow</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="images/blogo.png" type="x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
    position: fixed;
    left: -250px;
    top: 0;
    bottom: 0;
    background: #ffffff;
    padding: 20px; /* Added padding inside the sidebar */
    transition: left 0.3s ease;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
    overflow-y: auto;
        }
        .sidebar.active {
            left: 0;
        }
        .sidebar ul {
    padding-left: 10px; /* Adds spacing from the left */
}

.sidebar ul li {
    padding: 10px 15px; /* Adds space inside each menu item */
    margin-bottom: 5px; /* Adds space between menu items */
    border-radius: 5px; /* Optional: adds rounded corners */
}

.sidebar ul li a {
    display: block;
    text-decoration: none;
    color: #333;
    font-size: 16px;
    padding: 10px;
}
        .dropdown-menu {
            display: none;
            list-style: none;
            padding-left: 20px;
        }
        .dropdown.open .dropdown-menu {
            display: block;
        }
        .main-content {
            flex-grow: 1;
            margin-left: 0;
            transition: margin-left 0.3s ease;
            padding: 20px;
        }
        .main-content.shift {
            margin-left: 250px;
        }
        .container {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }
        .chart-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        .title {
            background: #555;
            color: white;
            padding: 10px;
            font-size: 20px;
            border-radius: 5px;
            display: inline-block;
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
            </li>
        </ul>
    </div>
    <div id="main-content" class="main-content">
        <header class="header">
            <button id="sidebar-toggle" class="sidebar-toggle">&#9776;</button>
            <h1>Onboarding Workflow</h1>
        </header>
        <div class="container">
            <div class="chart-box">
                <canvas id="barChart"></canvas>
            </div>
            <div class="chart-box">
                <canvas id="pieChart"></canvas>
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

        Chart.register(ChartDataLabels);
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Item 1', 'Item 2', 'Item 3', 'Item 4'],
                datasets: [
                    { label: 'Series 1', data: [40, 50, 30, 60], backgroundColor: '#7ee0ff' },
                    { label: 'Series 2', data: [30, 40, 25, 50], backgroundColor: '#53b2d2' },
                    { label: 'Series 3', data: [20, 30, 45, 40], backgroundColor: '#225b85' }
                ]
            },
            options: { 
                responsive: true, 
                scales: { x: { stacked: true }, y: { stacked: true } },
                plugins: { 
                    datalabels: {
                        color: 'black',
                        anchor: 'end',
                        align: 'top',
                        font: { weight: 'bold' }
                    }
                }
            }
        });

        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Rejected', 'New Entry', 'Active', 'Inactive', 'Hired'],
                datasets: [{
                    data: [20, 20, 20, 20, 20],
                    backgroundColor: ['#2a3052', '#7ee0ff', '#42a8cc', '#2c618a', '#145374']
                }]
            },
            options: { 
                responsive: true,
                plugins: { 
                    datalabels: {
                        color: 'black',
                        font: { weight: 'bold' },
                        formatter: (value, ctx) => {
                            return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + '%';
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
