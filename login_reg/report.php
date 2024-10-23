<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Human Resource System</title>
    <link rel="stylesheet" href="rep.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/fontawesome.min.js">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

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
                <td><span class="user-name"><b>admin name</b></span></td>
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
                    <li>
                        <a href="http://localhost/hrsystem/login_reg/admindashboard.php">
                            <i class='bx bx-home'></i>
                            <span class="links_name">Home</span>
                        </a>
                    </li>
                    <div class="dropdownstudent">
                        <button class="dropdown-btn"><i class='bx bx-user'></i>
                            <span class="droplinks_name">Employees</span>
                            <i class="fa fa-caret-down" id="second"></i>
                        </button>
                        <div class="dropdown-container1">
                            <a class="dropdown-a" href="#"><span class="droplinks_name">Employees Information</span></a>
                            <a class="dropdown-a" href="http://localhost/hrsystem/hrcrud/index.php"><span class="droplinks_name">Manage Employees</span></a>
                        </div>
                    </div>

                    <div class="dropdownstaff">
                        <button class="dropdown-btn"><i class='bx bx-user'></i>
                            <span class="droplinks_name">Applicants</span>
                            <i class="fa fa-caret-down" id="third"></i>
                        </button>
                        <div class="dropdown-container2">
                            <a class="dropdown-a" href="#"><span class="droplinks_name">Manage Applicants</span></a>
                            <a class="dropdown-a" href="#"><span class="droplinks_name">Manage Deployment</span></a>
                        </div>
                    </div>
                </ul>
            </td>
        </tr>
    </table>

    <table class="table-module">
        <tr>
            <td>
                <div class="dropdownadmission">
                    <span class="main"><b>Performance Management</b></span><br>
                    <span class="sub"><b>Performance Management</b></span><br><br>
                    <button class="dropdown-btn"><i class='bx bx-plus-report'></i>
                        <span class="droplinks_name">Reports</span>
                        <i class="fa fa-caret-down" id="fourth"></i>
                    </button>
                    <div class="dropdown-container3">
                        <a class="dropdown-a" href="http://localhost/hrsystem/login_reg/report.php"><span class="droplinks_name">Reports & Analytics</span></a>
                    </div>
                </div><br>
            </td>
        </tr>
    </table>
    <table class="table-module">
      <tr>
          <td>
              <div class="dropdownadmission">
                  <span class="main"><b>Reports&Analytics</b></span><br>
                  <span class="sub"><b>Reports&Analytics</b></span><br><br>
                  <button class="dropdown-btn"><i class='bx bx-plus-report'></i>
                      <span class="droplinks_name">Reports</span>
                      <i class="fa fa-caret-down" id="fourth"></i>
                  </button>
                  <div class="dropdown-container3">
                      <a class="dropdown-a" href="http://localhost/hrsystem/login_reg/report.php"><span class="droplinks_name">Reports & Analytics</span></a>
                  </div>
              </div><br>
          </td>
      </tr>
  </table>

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
</div>

<!-- main -->
<div class="container">
    <div class="head-title">
        <div class="left">
            <h1>Reports & Analytics</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Reports</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="http://localhost/hrsystem/login_reg/admindashboard.php">Home</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <h3>Performance Overview</h3>
                <div id="performanceChart"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <h3>Attendance Analytics</h3>
                <div id="attendanceChart"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h3>Recent Reports</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Report Type</th>
                            <th>Date Generated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Performance Report</td>
                            <td>12-Oct-2024</td>
                            <td><a href="#" class="btn btn-primary view-btn" data-report="Performance Report">View</a></td>
                        </tr>
                        <tr>
                            <td>Attendance Report</td>
                            <td>10-Oct-2024</td>
                            <td><a href="#" class="btn btn-primary view-btn" data-report="Attendance Report">View</a></td>
                        </tr>
                        <!-- More reports here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Report Details</h2>
        <p id="report-details"></p>
    </div>
</div>

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
        dropdown[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }

    // Modal script
    var modal = document.getElementById("myModal");
    var btns = document.getElementsByClassName("view-btn");
    var span = document.getElementsByClassName("close")[0];

    for (var j = 0; j < btns.length; j++) {
        btns[j].onclick = function () {
            modal.style.display = "block";
            var reportType = this.getAttribute('data-report');
            document.getElementById("report-details").innerText = "Details of " + reportType; // Change this to show actual report details
        }
    }

    span.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>
</html>
