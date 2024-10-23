<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "HRCRUD";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);  
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the employee ID from the URL
    $id = $_GET['id'];
    
    // Get form data
    $name = $connection->real_escape_string($_POST['name']);
    $email = $connection->real_escape_string($_POST['email']);
    $phone = $connection->real_escape_string($_POST['phone']);
    $address = $connection->real_escape_string($_POST['address']);

    // Prepare the SQL query to update the employee record
    $sql = "UPDATE clients SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";

    // Execute the query
    if ($connection->query($sql) === TRUE) {
        // Redirect back to the employee list page or wherever you want
        header("Location: http://localhost/hrsystem/hrcrud/index.php"); // Adjust the redirect URL as necessary
        exit();
    } else {
        echo "Error updating record: " . $connection->error;
    }
}

// Close connection
$connection->close();
?>

<!-- Edit Employee Modal -->
<div class='modal fade' id='editEmployeeModal$row[id]' tabindex='-1' aria-labelledby='editEmployeeModalLabel$row[id]' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='editEmployeeModalLabel$row[id]'>Edit Employee</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                <form action='http://localhost/hrsystem/hrcrud/edit.php?id=$row[id]' method='post'>
                    <div class='mb-3'>
                        <label for='name' class='form-label'>Name</label>
                        <input type='text' class='form-control' name='name' value='$row[name]' required>
                    </div>
                    <div class='mb-3'>
                        <label for='email' class='form-label'>Email</label>
                        <input type='email' class='form-control' name='email' value='$row[email]' required>
                    </div>
                    <div class='mb-3'>
                        <label for='phone' class='form-label'>Phone</label>
                        <input type='text' class='form-control' name='phone' value='$row[phone]' required>
                    </div>
                    <div class='mb-3'>
                        <label for='address' class='form-label'>Address</label>
                        <input type='text' class='form-control' name='address' value='$row[address]' required>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='submit' class='btn btn-primary'>Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
