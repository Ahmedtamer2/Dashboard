<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'admin';

$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Fetch the latest bounce rate
$sql = "SELECT bounce_rate_percentage FROM bounce_rate ORDER BY recorded_at DESC LIMIT 10"; // Get the latest 10 records
$result = $connect->query($sql);

$bounceRates = []; // Store bounce rates in an array
$colors = ['#28a745', '#007bff', '#ffc107', '#dc3545']; // Different colors for bounce rates
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bounceRates[] = $row['bounce_rate_percentage'];
    }
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bounce Rate Dashboard</title>
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
        .icon {
            font-size: 50px;
            opacity: 0.7;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Bounce Rate Dashboard</h1>
    
    <!-- Dropdown for Selecting Bounce Rate -->
    <div class="text-center mb-4">
        <label for="bounceRateSelect">Select Bounce Rate:</label>
        <select id="bounceRateSelect" class="form-control d-inline-block w-auto" onchange="updateBounceRate()">
            <?php foreach ($bounceRates as $index => $rate): ?>
                <option value="<?php echo $rate; ?>" data-color="<?php echo $colors[$index % count($colors)]; ?>"><?php echo $rate; ?>%</option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Bounce Rate Box -->
    <div id="bounceRateBox" class="small-box text-center" style="background-color: #4CAF50; color: white;">
        <div class="inner">
            <h3 id="bounceRateDisplay"><?php echo $bounceRates[0]; ?><sup style="font-size: 20px">%</sup></h3>
            <p>Bounce Rate</p>
        </div>
        <div class="icon" style="color: white;">
            <i class="fas fa-chart-line"></i>
        </div>
        <a href="bounce.php" class="small-box-footer" style="background-color: rgba(255, 255, 255, 0.2); color: white;">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<script>
function updateBounceRate() {
    var select = document.getElementById("bounceRateSelect");
    var selectedValue = select.value;
    var displayElement = document.getElementById("bounceRateDisplay");
    var bounceRateBox = document.getElementById("bounceRateBox");

    // Update the display text
    displayElement.innerHTML = selectedValue + '<sup style="font-size: 20px">%</sup>';

    // Change the background color based on selection
    var selectedOption = select.options[select.selectedIndex];
    var newColor = selectedOption.getAttribute('data-color');
    bounceRateBox.style.backgroundColor = newColor;
}
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
