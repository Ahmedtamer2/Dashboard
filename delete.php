<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'admin';

$connect = new mysqli($host, $user, $password, $database);

// Set the mysqli to throw exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if (isset($_GET['task_id'])) {
        $task_id = intval($_GET['task_id']); // Convert to an integer

        $delete_sql = "DELETE FROM to_do_list WHERE task_id = ?";
        $stmt = $connect->prepare($delete_sql);
        
        // Prepare the statement
        if ($stmt) {
            $stmt->bind_param("i", $task_id); // Bind the parameter
            
            // Execute the statement
            $stmt->execute();

            // Redirect back to your main page after success
            header("Location: index.php?message=Task+deleted+successfully"); 
            exit;
        } else {
            echo "Error preparing statement."; // Display preparation error
        }
    } else {
        echo "Invalid task ID.";
    }
} catch (mysqli_sql_exception $e) {
    // Handle the exception and display the error message
    echo "Error: " . $e->getMessage();
}

// Close the connection
$connect->close();
?>
