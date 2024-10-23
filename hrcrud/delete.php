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

// Check if the ID is set
if (isset($_GET['id'])) {
    // Get the employee ID from the URL
    $id = (int)$_GET['id'];

    // Prepare the SQL query to delete the employee record
    $sql = "DELETE FROM clients WHERE id=$id";

    // Execute the query
    if ($connection->query($sql) === TRUE) {
        // Redirect back to the employee list page or wherever you want
        header("Location: http://localhost/hrsystem/hrcrud/index.php"); // Adjust the redirect URL as necessary
        exit();
    } else {
        echo "Error deleting record: " . $connection->error;
    }
}

// Close connection
$connection->close();
?>

<!-- Delete Employee Modal -->
<div class='modal fade' id='deleteEmployeeModal$row[id]' tabindex='-1' aria-labelledby='deleteEmployeeModalLabel$row[id]' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='deleteEmployeeModalLabel$row[id]'>Delete Employee</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                Are you sure you want to delete employee <strong>$row[name]</strong>?
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                <a href='http://localhost/hrsystem/hrcrud/delete.php?id=$row[id]' class='btn btn-danger'>Delete</a>
            </div>
        </div>
    </div>
</div>
