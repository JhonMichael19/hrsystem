<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php"); // Redirect if not authorized
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Human Resource System</title>
    <link rel="stylesheet" href="styledash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/fontawesome.min.js">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<!-- SIDEBAR -->
<div id="sidenav" class="sidenav">
    <img src="logo.png.png" alt="bcplogo" class="bcp">
    
    <ul class="nav-link">
        <li class="bell">
            <a href="#" class="active">
                <i class='bx bx-bell'></i>
            </a>
        </li>
        <li class="settings">
            <a href="#">
                <i class='bx bx-cog'></i>
            </a>
        </li>
        <img src="admin.jpg" alt="avatar" class="admin-profile">
        <table class="user-profile">
            <tr>
                <td><span class="user-name"><b>admin Name</b></span></td>
            </tr>
            <tr>
                <td><span class="user-gmail">adminid@gmail.com</span></td>    
            </tr>
        </table>        
    </ul>

    <table class="dashboard">
        <tr>
            <td>
                <ul class="nav-links">
                    <!-- Home -->
                    <li>
                        <a href="#">
                            <i class='bx bx-home'></i>
                            <span class="links_name">Home</span>
                        </a>
                    </li>

                    <!-- Employee Relations -->
                    <div class="dropdownstudent">
                        <button class="dropdown-btn">
                            <i class='bx bx-user'></i>
                            <span class="droplinks_name">Employee Relations</span>
                            <i class="fa fa-caret-down" id="second"></i>
                        </button>
                        <div class="dropdown-container1">
                            <a class="dropdown-a" href="#"><span class="droplinks_name">Employees Information</span></a>
                            <a class="dropdown-a" href="http://localhost/hrsystem/hrcrud/index.php"><span class="droplinks_name">Manage Employees</span></a>
                        </div>
                    </div>

                    <!-- Applicant Tracking -->
                    <div class="dropdownstaff">
                        <button class="dropdown-btn">
                            <i class='bx bx-user'></i>
                            <span class="droplinks_name">Applicant Tracking</span>
                            <i class="fa fa-caret-down" id="third"></i>
                        </button>
                        <div class="dropdown-container2">
                            <a class="dropdown-a" href="#"><span class="droplinks_name">Manage Applicants</span></a>
                            <a class="dropdown-a" href="#"><span class="droplinks_name">Manage Deployment</span></a>
                        </div>
                    </div>

                    <!-- Adding space below Applicant Tracking -->
                    <li style="margin-bottom: 10px;"></li>

                    <!-- Performance Management -->
                    <div class="dropdownadmission">
                        <button class="dropdown-btn">
                            <i class='bx bx-plus-report'></i>
                            <span class="droplinks_name">Performance Management</span>
                            <i class="fa fa-caret-down" id="fourth"></i>
                        </button>
                        <div class="dropdown-container3">
                            <a class="dropdown-a" href="#"><span class="droplinks_name">Manage Performance</span></a>
                        </div>
                    </div>

                    <!-- Adding space below Performance Management -->
                    <li style="margin-bottom: 10px;"></li>

                    <!-- Reports & Analytics -->
                    <div class="dropdownadmission">
                        <button class="dropdown-btn">
                            <i class='bx bx-plus-report'></i>
                            <span class="droplinks_name">Reports & Analytics</span>
                            <i class="fa fa-caret-down" id="fifth"></i>
                        </button>
                        <div class="dropdown-container4">
                            <a class="dropdown-a" href="http://localhost/hrsystem/login_reg/report.php"><span class="droplinks_name">Reports</span></a>
                        </div>
                    </div>

                    <!-- Adding space below Reports & Analytics -->
                    <li style="margin-bottom: 10px;"></li>
                </ul>   
            </td>
        </tr>            
    </table>

    <!-- Logout Button -->
    <ul class="nav-link" style="margin-top: auto;">
        <li class="logout">
            <a href="logout.php">
                <i class='bx bx-log-out'></i>
                <span class="links_name">Logout</span>
            </a>
        </li>
    </ul>
</div>




</div>
<div id="uppernav">
    <div class="upnav">
    <button class="openbtn" onclick="toggleNav()">☰</button>

    <div class="input-box">
      <input type="text" placeholder="search...">
      <span class="search">
        <span>
        <button onclick="searchFunction()"><i class="bx bx-search"></i></button>
        </span>
      </span>
    </div>

</div>
<!-- SIDEBAR -->

     <!-- main -->
     <div class="container">
    <div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="http://localhost/hrsystem/login_reg/admindashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
    </div> 
</div>
<!-- main -->
<div class="row">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Total Employees</h5>
                <h2 class="card-text">150</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Attendance Rate</h5>
                <h2 class="card-text">95%</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">New Applicants</h5>
                <h2 class="card-text">25</h2>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
  <div class="col-md-12">
      <div class="card">
          <h3>Recent Activities</h3>
          <table class="table">
              <thead>
                  <tr>
                      <th>Activity</th>
                      <th>Date</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>New employee added</td>
                      <td>12-Oct-2024</td>
                  </tr>
                  <tr>
                      <td>Performance report generated</td>
                      <td>10-Oct-2024</td>
                  </tr>
                  <tr>
                      <td>Attendance marked</td>
                      <td>09-Oct-2024</td>
                  </tr>
                  <!-- More activities can be added here -->
              </tbody>
          </table>
      </div>
  </div>
</div>

<!-- frame -->


    
    

   


    
   
<!-- frame -->

<script type="text/javascript">
    function toggleNav() {
    const sidenav = document.getElementById("sidenav");
    const uppernav = document.getElementById("uppernav");

    if (sidenav.style.left === "0px") {
        sidenav.style.left = "-280px";
        uppernav.style.marginLeft = "0";
    } else {
        sidenav.style.left = "0";
        uppernav.style.marginLeft = "280px";
    }
}

var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
    </script>
    

        
        

</body>
</html>