<?php 

include('../Config/db.php');

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

$categories = [];

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $categories[] = $row;
    }
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>

<body>
    
    <h2>Create Product</h2>
    <a href="../index.php">Back To Product</a>
    <br><br>

    <form action="../Controller/createProduct.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" name ="product_name" required><br>
        <br><br>
        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
            <?php endforeach; ?> 
        </select>
        <br><br>
        <label for="price">Price:</label>
        <input type="text" id="price" name ="price" required>
        <br><br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name ="quantity" required>
        <input type="submit" value="add product">
    </form>
</body>
</html>