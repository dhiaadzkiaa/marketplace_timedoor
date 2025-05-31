<?php
include('../Config/db.php');

$id = $_GET['id'];

try {
    $stmt = $conn->prepare("SELECT products.id,products.product_name,products.category_id,categories.category_name,products.price,products.quantity
        FROM products
        JOIN categories ON products.category_id = categories.id
        WHERE products.id = :id"
        );
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $row = [];
     
   if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
   } 

   $stmtCat = $conn->prepare("SELECT * FROM categories");
   $stmtCat->execute();
   $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    echo "Error updating record: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>

<body>
    <h2>Update Product</h2>
    <a href="../index.php">Back to Product List</a>
    <br><br>
    
    <?php if (count($row) > 0) : ?>
        <form action="../Controller/updateProduct.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" required><br>

            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $category['id']  == $row 
                    ['category_id'] ? 'selected' : ''?>>
                    <?= $category['category_name'] ?>
                </option>
                <?php endforeach; ?>
            </select><br>   

            <label for="price">Price:</label>
            <input type="text" name="price" value="<?php echo $row['price']; ?>" required><br>

            <label for="quantity">Quantity:</label>
            <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>" required><br>

            <input type="submit" value="Update Product">
        </form>
    <?php else : ?>
        <p>Data not found</p>
    <?php endif; ?>
</body>
</html>

