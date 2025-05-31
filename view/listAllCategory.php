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
    <title>Category List</title>
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
    <h2>Category List</h2>
    <a href="../view/createCategory.php">Add Category</a>
    <br><br>

    <table>
        <tr>
            <th>No</th>
            <th>Category Name</th>
            <th>Action</th>
        </tr>

        <?php if (count($categories) > 0) : ?>
            <?php $counter = 1; ?>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?php echo $counter ?></td>
                    <td><?php echo $category["category_name"] ?></td>
                    
                    <td>
                        <a href="updateCategory.php?id=<?php echo $category["id"]?>">Update</a>
                        <a href="deleteCategory.php?id=<?php echo $category["id"]?>">Delete</a>
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