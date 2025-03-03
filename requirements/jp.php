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
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 20px;
            max-width: 1200px;
            width: 100%;
        }
        .job-container, .post-container {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: inline-block;
            width: 18%;
            min-width: 200px;
            word-wrap: break-word;
            overflow: hidden;
        }
        h2 {
            font-size: 1.2em;
            color: #333;
        }
        .job-details {
            margin-top: 5px;
            line-height: 1.4;
            font-size: 0.9em;
        }
        .delete-btn, .post-btn, .edit-btn {
            display: inline-block;
            background: #dc3545;
            color: #fff;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 0.9em;
            cursor: pointer;
            border: none;
        }
        .delete-btn:hover, .post-btn:hover, .edit-btn:hover, .post-btn:hover {
            background: #c82333;
        }
        .post-box {
            width: 100%;
            max-width: 600px;
            margin: 0 auto 20px auto;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .post-box input, .post-box textarea {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-top: 5px;
            resize: none;
        }
  </style>
</head>
<body>
  <div id="loading"><div class="loader"></div></div>
  <div id="sidebar" class="sidebar">
    <div class="logo"><img src="images/blogo.png" alt="Logo"><p>09090909</p></div>
    <ul class="sidebar-nav">
      <li><a href="#"><i class="fas fa-user"></i> User Profile</a></li>
      <li><a href="#"><i class="fas fa-newspaper"></i> BCP News Update</a></li>
      <li><a href="#"><i class="fas fa-bullseye"></i> Goal Target</a></li>
      <li><a href="#"><i class="fas fa-bell"></i> Notification</a></li>
      <li><a href="#"><i class="fas fa-file-alt"></i> Special Report Submission</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle"><i class="fas fa-users"></i> Applicant Tracking Management</a>
        <ul class="dropdown-menu">
          <li><a href="#">Job Posting Management</a></li>
          <li><a href="#">Applicant Management</a></li>
          <li><a href="#">Employees List Management</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle"><i class="fas fa-user-tie"></i> Recruitment</a>
        <ul class="dropdown-menu">
          <li><a href="#">Applicant list</a></li>
          <li><a href="#">ATLDS</a></li>
          <li><a href="#">Notification</a></li>
          
        </ul>
      </li>
      <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </div>
  <div id="main-content" class="main-content">
    <header class="header">
      <button id="sidebar-toggle" class="sidebar-toggle">&#9776;</button>
      <h1>Dashboard</h1>
    </header>
    <section class="content">
    <div class="post-box">
    <input type="text" id="jobProfession" placeholder="Job Profession">
    <input type="text" id="schoolName" placeholder="School Name">
    <input type="text" id="location" placeholder="Location">
    <textarea id="jobDescription" placeholder="Job Description"></textarea>
    <button class="post-btn" onclick="createPost()">Post</button>
</div>
<div class="container" id="postContainer">
</div>

<script>
    function createPost() {
        var jobProfession = document.getElementById("jobProfession").value;
        var schoolName = document.getElementById("schoolName").value;
        var location = document.getElementById("location").value;
        var jobDescription = document.getElementById("jobDescription").value;
        
        if (jobProfession.trim() !== "" && schoolName.trim() !== "" && location.trim() !== "" && jobDescription.trim() !== "") {
            var postContainer = document.getElementById("postContainer");
            var newPost = document.createElement("div");
            newPost.classList.add("job-container");
            newPost.innerHTML = `
                <h2 class="job-title">Job Profession: ${jobProfession}</h2>
                <p><strong>School Name:</strong> <span class="job-school">${schoolName}</span></p>
                <p><strong>Location:</strong> <span class="job-location">${location}</span></p>
                <div class="job-details">
                    <h3>Job Description</h3>
                    <p class="job-desc">${jobDescription}</p>
                </div>
                <button class="edit-btn" onclick="editPost(this)">Edit</button>
                <button class="delete-btn" onclick="deletePost(this)">Delete Post</button>`;
            postContainer.prepend(newPost);
            document.getElementById("jobProfession").value = "";
            document.getElementById("schoolName").value = "";
            document.getElementById("location").value = "";
            document.getElementById("jobDescription").value = "";
        }
    }

    function deletePost(button) {
        button.parentElement.remove();
    }

    function editPost(button) {
        var post = button.parentElement;
        document.getElementById("jobProfession").value = post.querySelector(".job-title").innerText.replace("Job Profession: ", "");
        document.getElementById("schoolName").value = post.querySelector(".job-school").innerText;
        document.getElementById("location").value = post.querySelector(".job-location").innerText;
        document.getElementById("jobDescription").value = post.querySelector(".job-desc").innerText;
        post.remove();
    }
</script>

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
