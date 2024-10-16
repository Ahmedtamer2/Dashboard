<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "admin";

// Create a connection
$connect = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape input values to prevent SQL injection
    $task_description = mysqli_real_escape_string($connect, $_POST['task_description']);
    $due_date = mysqli_real_escape_string($connect, $_POST['due_date']);
    
    // Insert query
    $sql = "INSERT INTO to_do_list (task_description, due_date) VALUES ('$task_description', '$due_date')";
    
    // Execute the query
    if ($connect->query($sql) === TRUE) {
        header('Location: index.php');
        exit();  // Add exit to stop further script execution after redirect
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}




$connect->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h2>Add a New Task</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="add_task.php">
                <div class="form-group">
                    <label for="task_description">Task Description:</label>
                    <input type="text" name="task_description" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date:</label>
                    <input type="date" name="due_date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Add Task</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
