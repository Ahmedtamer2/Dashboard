<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'admin';

$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Fetch the total user registrations
$sql = "SELECT COUNT(*) as total_users FROM user_registrations";
$result = $connect->query($sql);
$totalUsers = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalUsers = $row['total_users'];
}

// Fetch all user registrations
$sqlUsers = "SELECT username, email, registration_date, status FROM user_registrations";
$resultUsers = $connect->query($sqlUsers);
$users = [];

if ($resultUsers->num_rows > 0) {
    while ($row = $resultUsers->fetch_assoc()) {
        $users[] = $row;
    }
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registrations Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .small-box {
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            transition: transform 0.2s;
        }
        .small-box:hover {
            transform: scale(1.05);
        }
        .bg-yellow {
            background-color: #ffc107 !important; /* Yellow color */
            color: #fff;
        }
        .icon {
            font-size: 50px;
            opacity: 0.7;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">User Registrations Dashboard</h1>
    
    <!-- User Registrations Box -->
    <div class="small-box bg-yellow text-center">
        <div class="inner">
            <h3><?php echo $totalUsers; ?></h3>
            <p>User Registrations</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer" style="background-color: rgba(255, 255, 255, 0.2); color: white;">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>

    <!-- Table to Display All Users -->
    <div class="mt-4">
        <h2 class="text-center">All User Registrations</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Registration Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['registration_date']); ?></td>
                            <td><?php echo htmlspecialchars($user['status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No users found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
