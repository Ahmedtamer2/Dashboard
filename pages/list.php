<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'admin';

$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$sql_orders = "SELECT * FROM orders";
$result_orders = $connect->query($sql_orders);

$sql_orders_2 = "SELECT * FROM orders_2";
$result_orders_2 = $connect->query($sql_orders_2);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders and Orders_2 Tables</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Orders Table</h2>
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Order Status</th>
            <th>Customer ID</th>
            <th>Total Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result_orders->num_rows > 0) {
            while ($row = $result_orders->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['order_id']}</td>
                    <td>{$row['order_date']}</td>
                    <td>{$row['order_status']}</td>
                    <td>{$row['customer_id']}</td>
                    <td>{$row['total_amount']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
    </tbody>
</table>

<h2>Orders_2 Table</h2>
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Item Name</th>
            <th>Status</th>
            <th>Popularity</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result_orders_2->num_rows > 0) {
            while ($row = $result_orders_2->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['order_id']}</td>
                    <td>{$row['item_name']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['popularity']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php
// Close connection
$connect->close();
?>
