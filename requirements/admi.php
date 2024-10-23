<?php
// Start the session to store messages (optional, for enhanced user experience)
session_start();

// Database configuration
$servername = "localhost:3307";         // Typically 'localhost'
$username = "root";    // Your database username
$password = "";    // Your database password
$dbname = "admissiondb";           // The database name you created

// Initialize variables and error messages
$lastname = $firstname = $middlename = $gender = $civilStatus = $religion = $birthday = $email = $contact = $address = $barangay = $city = "";
$lastnameErr = $firstnameErr = $middlenameErr = $genderErr = $civilStatusErr = $religionErr = $birthdayErr = $emailErr = $contactErr = $addressErr = $barangayErr = $cityErr = "";
$successMsg = "";
$submissionErr = "";

// Function to sanitize inputs
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Process form when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Last Name
    if (empty($_POST["lastname"])) {
        $lastnameErr = "Last name is required";
    } else {
        $lastname = test_input($_POST["lastname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
            $lastnameErr = "Only letters and spaces are allowed";
        }
    }

    // Validate First Name
    if (empty($_POST["firstname"])) {
        $firstnameErr = "First name is required";
    } else {
        $firstname = test_input($_POST["firstname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
            $firstnameErr = "Only letters and spaces are allowed";
        }
    }

    // Validate Middle Name
    if (empty($_POST["middlename"])) {
        $middlenameErr = "Middle name is required";
    } else {
        $middlename = test_input($_POST["middlename"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $middlename)) {
            $middlenameErr = "Only letters and spaces are allowed";
        }
    }

    // Validate Gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
        if (!in_array($gender, ['Male', 'Female'])) {
            $genderErr = "Invalid gender selected";
        }
    }

    // Validate Civil Status
    if (empty($_POST["civilStatus"])) {
        $civilStatusErr = "Civil status is required";
    } else {
        $civilStatus = test_input($_POST["civilStatus"]);
        if (!in_array($civilStatus, ['Single', 'Married', 'Widowed'])) {
            $civilStatusErr = "Invalid civil status selected";
        }
    }

    // Validate Religion
    if (empty($_POST["religion"])) {
        $religionErr = "Religion is required";
    } else {
        $religion = test_input($_POST["religion"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $religion)) {
            $religionErr = "Only letters and spaces are allowed";
        }
    }

    // Validate Birthday
    if (empty($_POST["birthday"])) {
        $birthdayErr = "Birthday is required";
    } else {
        $birthday = test_input($_POST["birthday"]);
        // Optional: Add more validation for date format if needed
        if (!DateTime::createFromFormat('Y-m-d', $birthday)) {
            $birthdayErr = "Invalid date format";
        }
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate Contact Number
    if (empty($_POST["contact"])) {
        $contactErr = "Contact number is required";
    } else {
        $contact = test_input($_POST["contact"]);
        // Allowing various formats (e.g., with dashes, spaces, or just numbers)
        if (!preg_match("/^[0-9]{10,15}$/", $contact)) { // Adjust length as needed
            $contactErr = "Invalid contact number. It should contain 10-15 digits.";
        }
    }

    // Validate Address
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = test_input($_POST["address"]);
    }

    // Validate Barangay
    if (empty($_POST["barangay"])) {
        $barangayErr = "Barangay is required";
    } else {
        $barangay = test_input($_POST["barangay"]);
    }

    // Validate City
    if (empty($_POST["city"])) {
        $cityErr = "City is required";
    } else {
        $city = test_input($_POST["city"]);
    }

    // If no errors, proceed to insert data into the database
    if (
        empty($lastnameErr) && empty($firstnameErr) && empty($middlenameErr) &&
        empty($genderErr) && empty($civilStatusErr) && empty($religionErr) &&
        empty($birthdayErr) && empty($emailErr) && empty($contactErr) &&
        empty($addressErr) && empty($barangayErr) && empty($cityErr)
    ) {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            $submissionErr = "Connection failed: " . $conn->connect_error;
        } else {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO usersinfo (lastname, firstname, middlename, gender, civilStatus, religion, birthday, email, contact, address, barangay, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                $submissionErr = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            } else {
                $stmt->bind_param(
                    "ssssssssssss",
                    $lastname,
                    $firstname,
                    $middlename,
                    $gender,
                    $civilStatus,
                    $religion,
                    $birthday,
                    $email,
                    $contact,
                    $address,
                    $barangay,
                    $city
                );

                // Execute the statement
                if ($stmt->execute()) {
                    $successMsg = "Form submitted successfully!";
                    // Optionally, redirect to a thank you page
                    // header("Location: thank_you.php");
                    // exit();

                    // Reset form values
                    $lastname = $firstname = $middlename = $gender = $civilStatus = $religion = $birthday = $email = $contact = $address = $barangay = $city = "";
                } else {
                    // Handle duplicate email error
                    if ($conn->errno == 1062) { // Duplicate entry
                        $emailErr = "This email is already registered.";
                    } else {
                        $submissionErr = "Error: " . $stmt->error;
                    }
                }

                $stmt->close();
            }

            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Admission</title>
    <link rel="stylesheet" href="admi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="bcp">
        <div class="logo">
            <a href="http://localhost/hrsystem/frontpage/fp.php"><img src="logo.png.png" alt="Logo" width="80" height="95"></a>
        </div>
        <h3>Bestlink College Of the Philippines Human Resources Management System</h3>
        <h1>HR Admission</h1>
    </div>

    <div class="maincontent">

        <div class="content1">
            <h5>Basic Information</h5>

            <?php 
                if (!empty($successMsg)) { 
                    echo "<p class='success'>$successMsg</p>"; 
                }
                if (!empty($submissionErr)) { 
                    echo "<p class='submission-error'>$submissionErr</p>"; 
                }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="lname">
                    <label for="lastname">Lastname: <span class="error">* <?php echo $lastnameErr; ?></span></label><br>
                    <input type="text" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>"><br>
                </div>

                <div class="fname">
                    <label for="firstname">Firstname: <span class="error">* <?php echo $firstnameErr; ?></span></label><br>
                    <input type="text" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>"><br>
                </div>
                
                <div class="mname">
                    <label for="middlename">Middlename: <span class="error">* <?php echo $middlenameErr; ?></span></label><br>
                    <input type="text" name="middlename" value="<?php echo htmlspecialchars($middlename); ?>"><br>
                </div>

                <div class="gen">
                    <label for="gender">Gender: <span class="error">* <?php echo $genderErr; ?></span></label><br>
                    <select name="gender">
                        <option value="">--Select--</option>
                        <option value="Male" <?php if ($gender == "Male") echo "selected"; ?>>Male</option>
                        <option value="Female" <?php if ($gender == "Female") echo "selected"; ?>>Female</option>
                    </select><br>
                </div>

                <div class="cvs">
                    <label for="civilStatus">Civil Status: <span class="error">* <?php echo $civilStatusErr; ?></span></label><br>
                    <select name="civilStatus">
                        <option value="">--Select--</option>
                        <option value="Single" <?php if ($civilStatus == "Single") echo "selected"; ?>>Single</option>
                        <option value="Married" <?php if ($civilStatus == "Married") echo "selected"; ?>>Married</option>
                        <option value="Widowed" <?php if ($civilStatus == "Widowed") echo "selected"; ?>>Widowed</option>
                    </select><br>
                </div>

                <div class="religion">
                    <label for="religion">Religion: <span class="error">* <?php echo $religionErr; ?></span></label><br>
                    <input type="text" name="religion" value="<?php echo htmlspecialchars($religion); ?>"><br>
                </div>

                <div class="bday">
                    <label for="birthday">Birthday: <span class="error">* <?php echo $birthdayErr; ?></span></label><br>
                    <input type="date" name="birthday" value="<?php echo htmlspecialchars($birthday); ?>"><br>
                </div>

                <div class="eml">
                    <label for="email">Email Address: <span class="error">* <?php echo $emailErr; ?></span></label><br>
                    <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>
                </div>

                <div class="cn">
                    <label for="contact">Contact #: <span class="error">* <?php echo $contactErr; ?></span></label><br>
                    <input type="text" name="contact" value="<?php echo htmlspecialchars($contact); ?>"><br>
                </div>

                <div class="addy">
                    <label for="address">Address# <span class="error">* <?php echo $addressErr; ?></span></label><br>
                    <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>"><br>
                </div>

                <div class="brgy">
                    <label for="barangay">Barangay <span class="error">* <?php echo $barangayErr; ?></span></label><br>
                    <input type="text" name="barangay" value="<?php echo htmlspecialchars($barangay); ?>"><br>
                </div>

                <div class="city">
                    <label for="city">Municipality/City <span class="error">* <?php echo $cityErr; ?></span></label><br>
                    <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>"><br>
                </div>

                <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" class="btn">
            </form>
        </div>

        <div class="content2">

            <h2 class="req">Requirements</h2>

            <div class="docx"></div>
            <h2 class="oc">Original Copy of the following documents:</h2>
            <div>
                <br>
                <ul class="reqdet">
                    <li><i class="fa-solid fa-check"></i>&nbsp; Photocopy of Diploma</li>
                    <li><i class="fa-solid fa-check"></i>&nbsp; PSA Authenticated Birth Certificate</li>
                    <li><i class="fa-solid fa-check"></i>&nbsp; Barangay Clearance</li>
                    <li><i class="fa-solid fa-check"></i>&nbsp; 2"x2" ID Picture (White Background) - 2pcs.</li>
                    <li><i class="fa-solid fa-check"></i>&nbsp; Philhealth</li>
                    <li><i class="fa-solid fa-check"></i>&nbsp; Pag-Ibig</li>
                    <li><i class="fa-solid fa-check"></i>&nbsp; SSS</li>
                    <li><i class="fa-solid fa-check"></i>&nbsp; Police Clearance</li>
                    <li><i class="fa-solid fa-check"></i>&nbsp; NBI</li>
                </ul>
                <div class="line"></div>
            </div>
        </div>
    </div>

    <!-- Footer using div -->
    <div class="foot">
        <p>BCP Online Admission &nbsp; &copy; 2024</p>
    </div>
    <!-- Footer using div -->

</body>
</html>
