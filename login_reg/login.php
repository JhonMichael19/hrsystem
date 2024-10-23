<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Application Process - Sign In</title>
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
    // Initialize variables
    $email = $password = "";
    $emailErr = $passwordErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["login"])) {
            // Validate Email
            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {
                $email = input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }

            // Validate Password
            if (empty($_POST["password"])) {
                $passwordErr = "Password is required";
            } else {
                $password = input($_POST["password"]);
            }

            // If no errors, proceed with database check
            if (empty($emailErr) && empty($passwordErr)) {
                require_once "database.php";
                $email = mysqli_real_escape_string($conn, $email);
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if ($user) {
                    // Check if password matches
                    if (password_verify($password, $user["password"])) {
                        session_start();
                        $_SESSION["user_id"] = $user["id"];
                        $_SESSION["email"] = $user["email"];
                        $_SESSION["role"] = $user["role"]; // Save role in session

                        // Redirect based on role
                        if ($user["role"] == "admin") {
                            header("Location: admindashboard.php");
                        } elseif ($user["role"] == "user") {
                            header("Location: empdash.php");
                        } else {
                            header("Location: login.php"); // Return to login if role is not recognized
                        }
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Password does not match</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Email does not match</div>";
                }
            }
        }
    }

    // Function to sanitize input
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

        <h1 class="sign">Sign In</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" >
                <span class="error"><?php echo $emailErr;?></span>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" id="password" class="form-control" >
                <span class="error"><?php echo $passwordErr;?></span>
            </div>
            
            <!-- View Password Checkbox -->
            <div class="form-group">
                <input type="checkbox" onclick="togglePassword()"> Show Password
            </div>

            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div>
            <p class="nry">Not registered yet? <a href="registration.php">Register Here</a></p>
        </div>
    </div>

    <script>
        // Function to toggle password visibility
        function togglePassword() {
            var password = document.getElementById("password");
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }
    </script>
</body>
</html>
