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
    .content {
      background-color: #2f5f98;
      margin: 20px 0px;
      height: auto;
    } 
    .icontent{
      background-color: #b7d4f0;
      padding: 20px 30px;
    }
    
    .main-content.shift {
      margin-left: 250px;
    }
    /* General Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    display: flex;
}





/* Progress Tracking & Performance Evaluation */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

table th, table td {
    padding: 12px;
    text-align: left;
    border-bottom: 2px solid #ddd;
}

table th {
    background-color: #6a5acd;
    color: white;
    font-weight: bold;
}

input[type="radio"] {
    margin-right: 5px;
}

    textarea {
    width: 100%;
    padding: 10px;
    margin: 10px -10px;
    border: 2px solid #a28bfa;
    border-radius: 5px;
    font-size: 16px;
    resize: vertical;
    background-color: #fafafa;
}

textarea:focus {
    outline: none;
    border-color: #6a5acd;
    box-shadow: 0 0 5px rgba(106, 90, 205, 0.5);
}

/* File Upload Styling */
.file-upload {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.file-upload label {
    font-weight: bold;
}

input[type="file"] {
    border: 1px solid #ccc;
    padding: 5px;
    border-radius: 5px;
    background: #fff;
}

button {
    background-color: #6a5acd;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #5a4bbf;
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
        </ul>
      </li>

      <li class="dropdown">
        <a class="dropdown-toggle"><i class="fas fa-tasks"></i> Applicant Process Tracking <i class="fas fa-chevron-down"></i></a>
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
      <h1>Dashboard</h1>
    </header>
    <section class="content">
      <div class="icontent">

        <div class="pcontent">
        <h2>Instructor Evaluation</h2><br>
        <p><strong>Name of Instructor: </strong>SMSHR1 GROUP 8</p>
        <p><strong>Date:</strong> 2/6/25</p>
                <p><strong>Designated Campus:</strong> MY CAMPUS</p>
                <p><strong>Designated Role:</strong> P.E INSTRUCTOR</p>
                <br><h3>Reminders:</h3>
                <p><strong>1.</strong> Evaluate your subject teachers honestly. </p>
                <p><strong>2.</strong> Commments and evaluations are may be visible to teachers but student names are hidden.</p>
                <p><strong>3.</strong> If subject or teacher is not applicable to your current enrollment, leave it as is. No need for evaluation.</p>
                <br><p><strong>Dear Students: </strong>In the interest of improving the quality of teaching in the college we need important feedbacks on instructors which you alone can provide us.</p>
                <br><strong>Instructions: </strong>
                <br><p><strong>1.</strong> Rate your instructor according to the frequency or number of times with which he or she has demonstrated each of the behaviors listed on this form. Your response and opinions will be of help in strict confidence.</p>
                <p><strong>2.</strong> Choose the option that best describes your evaluation. </p>
                <table>
                    <br><tr>
                        <th>Progress Tracking: </th>
                        <td><input type="radio" name="progress" value="6"> Very Excellent</td>
                        <td><input type="radio" name="progress" value="5"> Excellent</td>
                        <td><input type="radio" name="progress" value="4"> Very Good</td>
                        <td><input type="radio" name="progress" value="3"> Good</td>
                        <td><input type="radio" name="progress" value="2"> Not Bad</td>
                        <td><input type="radio" name="progress" value="1"> Need Improvements</td>
                    </tr>
                </table>
                
                <table>
                  <br><tr>
                    <th>Performance Evaluation: </th>
                    <td><input type="radio" name="performance" value="6"> Very Excellent</td>
                    <td><input type="radio" name="performance" value="5"> Excellent</td>
                    <td><input type="radio" name="progress"    value="4"> Very Good</td>
                    <td><input type="radio" name="performance" value="3"> Good</td>
                    <td><input type="radio" name="performance" value="2"> Not Bad</td>
                    <td><input type="radio" name="progress"    value="1"> Need Improvements</td>
                </tr>
                </table>
                
                <br><label for="complaint"><strong>File for Complaint: </strong></label>
                <textarea id="complaint" placeholder="Insert Response Here..."> </textarea>
                <div class="file-upload">
                    <br><label for="file"><strong>File Upload: </strong></label>
                    <input type="file" id="file">
                    <label><input type="checkbox"> Add another?</label>
                </div>
                <br><label for="feedback"><strong>Comment Feedback: </strong></label>
                <textarea id="feedback" placeholder="Type feedback here..."></textarea>
                <button type="submit">Submit</button>
        </div>
      </div>
      <!-- Removed chart-box divs here -->
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
