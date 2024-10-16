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

// Fetch products from the database
$result = $connect->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recently Added Products</title>
    <!-- Add Bootstrap for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .box {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .box-header {
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }
        .box-title {
            font-size: 24px;
            font-weight: bold;
        }
        .products-list {
            list-style: none;
            padding-left: 0;
        }
        .item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            transition: background-color 0.3s;
        }
        .item:hover {
            background-color: #f1f1f1;
        }
        .product-img img {
            border-radius: 10%;
            width: 60px;
            height: 60px;
            object-fit: cover;
        }
        .product-info {
            margin-left: 20px;
            width: 100%;
        }
        .product-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            text-decoration: none;
        }
        .product-title:hover {
            color: #007bff;
        }
        .product-description {
            color: #6c757d;
            font-size: 14px;
        }
        .label {
            font-size: 16px;
            border-radius: 10px;
            padding: 5px 10px;
        }
        .box-footer {
            padding-top: 20px;
        }
        .box-footer a {
            font-weight: bold;
            color: #007bff;
            text-transform: uppercase;
            text-decoration: none;
        }
        .box-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Recently Added Products</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fas fa-times"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <ul class="products-list product-list-in-box">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <li class="item">
                        <div class="product-img">
                            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Product Image"/>
                        </div>
                        <div class="product-info">
                            <a href="javascript::;" class="product-title">
                                <?php echo htmlspecialchars($row['product_name']); ?>
                                <span class="label label-warning float-right">$<?php echo number_format($row['price'], 2); ?></span>
                            </a>
                            <span class="product-description">
                                <?php echo htmlspecialchars($row['description']); ?>
                            </span>
                        </div>
                    </li><!-- /.item -->
                <?php } ?>
            </ul>
        </div><!-- /.box-body -->
        <div class="box-footer text-center">
            <a href="javascript::;" class="uppercase">View All Products</a>
        </div><!-- /.box-footer -->
    </div>
</div>

<!-- Optional JavaScript -->
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
