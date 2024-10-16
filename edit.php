<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'admin';

$connect = new mysqli($host, $user, $password, $database);

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$task = null;

if (isset($_GET['task_id'])) {
    $task_id = (int)$_GET['task_id']; // Sanitize input
    $result = $connect->query("SELECT * FROM to_do_list WHERE task_id = $task_id");

    if ($result->num_rows > 0) {
        $task = $result->fetch_assoc();
    } else {
        echo "Task not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task_description'], $_POST['due_date'])) {
    $task_description = $connect->real_escape_string($_POST['task_description']); // Prevent SQL injection
    $due_date = $connect->real_escape_string($_POST['due_date']);
    $priority = $connect->real_escape_string($_POST['priority']);

    // Update the task in the database
    $connect->query("UPDATE to_do_list SET task_description = '$task_description', due_date = '$due_date', priority = '$priority' WHERE task_id = $task_id");

    // Redirect back to the task list after updating
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Update Task</h2>
    <form method="POST">
        <div class="form-group">
            <label for="task_description" class="form-label">Task Description:</label>
            <input type="text" class="form-control" name="task_description" value="<?php echo htmlspecialchars($task['task_description']); ?>" required>
        </div>
        <div class="form-group">
            <label for="due_date" class="form-label">Due Date:</label>
            <input type="date" class="form-control" name="due_date" value="<?php echo htmlspecialchars($task['due_date']); ?>" required>
        </div>
        <div class="form-group">
            <label for="priority" class="form-label">Priority:</label>
            <input type="text" class="form-control" name="priority" value="<?php echo htmlspecialchars($task['priority']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update Task</button>
    </form>
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-secondary">Back to Task List</a>
    </div>
</div>
</body>
</html>
