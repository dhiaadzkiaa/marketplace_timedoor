<?php 

include('Config/db.php');
$sql = "SELECT products.id,products.product_name,categories.category_name,products.price,products.quantity
        FROM products
        JOIN categories ON products.category_id = categories.id";
$result = $conn->query($sql);

$products = [];

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $products[] = $row;
    }
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        table {
            border-collapse: collapse;
            width:100%
        }
        th,
        td {
            border: 1px solid #dddddd;
            text-align:left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Product List</h2>
    <a href="view/listAllCategory.php">listAllCategory</a>
    <br><br>
    <a href="view/createProduct.php">Add Products</a>
    <br><br>

    <table>
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>

        <?php if (count($products) > 0) : ?>
            <?php $counter = 1; ?>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?php echo $counter ?></td>
                    <td><?php echo $product["product_name"] ?></td>
                    <td><?php echo $product["category_name"] ?></td>
                    <td><?php echo $product["price"] ?></td>
                    <td><?php echo $product["quantity"] ?></td>
                    <td>
                        <a href="view/detailProduct.php?id=<?php echo $product["id"]?>">View</a>
                        <a href="view/updateProduct.php?id=<?php echo $product["id"]?>">Update</a>
                        <a href="view/deleteProduct.php?id=<?php echo $product["id"]?>">Delete</a>
                    </td>
                </tr>
                <?php $counter++ ?>
            <?php endforeach ?> 
        <?php else : ?>
            <tr>
                <td colspan="5">0 result</td>
            </tr>
        <?php endif ?>    
    </table>
</body>

</html>