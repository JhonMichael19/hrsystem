<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRCRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Add some custom styling if needed */
        body {
            background-color: #f8f9fa; /* Light background for better contrast */
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="bg-primary text-white text-center py-4">
        <a href="http://localhost/hrsystem/login_reg/admindashboard.php"> <!-- Link to your homepage -->
            <img src="logo.png" alt="Logo" class="mb-2" style="width: 100px;"> <!-- Adjust the width as needed -->
        </a>
        <h1>Employee Management System</h1>
    </header>

    <div class="container my-5">
        <h2>List of Employees</h2>

        <!-- Button to Open New Employee Modal -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newEmployeeModal">
            New Employees
        </button>
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>    
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "HRCRUD";

                $connection = new mysqli($servername, $username, $password, $database);

                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);  
                }

                $sql = "SELECT * FROM clients";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error); 
                }

                while($row = $result->fetch_assoc()){
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[phone]</td>
                        <td>$row[address]</td>
                        <td>$row[created_at]</td>
                        <td>
                            <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editEmployeeModal$row[id]'>Edit</button>
                            <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteEmployeeModal$row[id]'>Delete</button>
                        </td>
                    </tr>

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
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- New Employee Modal -->
    <div class="modal fade" id="newEmployeeModal" tabindex="-1" aria-labelledby="newEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newEmployeeModalLabel">New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="http://localhost/hrsystem/hrcrud/create.php" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-5 py-4">
        <div class="container">
            <p class="text-muted">&copy; 2024 Human Resource Management. All Rights Reserved.</p>
           
        </div>
    </footer>
</body>
</html>
