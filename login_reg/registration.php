<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylereg.css">
</head>
<body>

<div class="bcp">
    <div class="logo">
        <a href="http://localhost/hrsystem/frontpage/fp.php">
            <img src="logo.png.png" alt="Logo" width="80" height="95">
        </a>
    </div>
    <h3>Bestlink College Of the Philippines Human Resources Management System</h3>
    <h1>Application Process</h1>
</div>

<div class="container">
    <?php
    if (isset($_POST["submit"])) {
       $fullName = $_POST["fullname"];
       $email = $_POST["email"];
       $password = $_POST["password"];
       $passwordRepeat = $_POST["repeat_password"];
       $role = $_POST["role"];  // Get the selected role from form

       $passwordHash = password_hash($password, PASSWORD_DEFAULT);

       $errors = array();
       
       if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat) OR empty($role)) {
        array_push($errors,"All fields are required");
       }
       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
       }
       if (strlen($password) < 8) {
        array_push($errors,"Password must be at least 8 characters long");
       }
       if ($password !== $passwordRepeat) {
        array_push($errors,"Password does not match");
       }

       require_once "database.php";
       $sql = "SELECT * FROM users WHERE email = '$email'";
       $result = mysqli_query($conn, $sql);
       $rowCount = mysqli_num_rows($result);
       if ($rowCount > 0) {
        array_push($errors,"Email already exists!");
       }
       
       if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
       } else {
        // Insert user data into the database with the role
        $sql = "INSERT INTO users (full_name, email, password, role) VALUES ( ?, ?, ?, ? )";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt,"ssss",$fullName, $email, $passwordHash, $role);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>You are registered successfully.</div>";
        } else {
            die("Something went wrong");
        }
       }
    }
    ?>
    
    <h1 class="sign">Sign Up</h1>
    <form action="registration.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email:">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password:">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repeat_password" id="repeat_password" placeholder="Repeat Password:">
        </div>

        <!-- View Password Checkbox -->
        <div class="form-group">
            <input type="checkbox" onclick="togglePassword()"> Show Password
        </div>

        <!-- Role Selection -->
        <div class="form-group">
            <label for="role">Select Role:</label>
            <select class="form-control" name="role" id="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Register" name="submit">
        </div>
    </form>
    <div>
        <p class="ar">Already Registered <a href="login.php">Login Here</a></p>
    </div>
</div>

<script>
    // Function to toggle password visibility
    function togglePassword() {
        var password = document.getElementById("password");
        var repeatPassword = document.getElementById("repeat_password");
        if (password.type === "password") {
            password.type = "text";
            repeatPassword.type = "text";
        } else {
            password.type = "password";
            repeatPassword.type = "password";
        }
    }
</script>
</body>
</html>
