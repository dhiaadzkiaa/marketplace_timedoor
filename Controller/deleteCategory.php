<?php
include('../Config/db.php');

$id = $_GET['id'];

try {
    $checkStart = $conn->prepare("SELECT COUNT(*) FROM products WHERE category_id = :id");

    $checkStart->bindParam(':id', $id);
    $checkStart->execute();
    $productCount = $checkStart->fetchColumn();

    if ($productCount > 0) {
        echo "kategori tidak dapat dihapus karena masi digunakan oleh $productCount produk.";
        echo "<br><button><a href='../View/listAllCategory.php'>cancel</a></button>";
    } else {
        $stmt = $conn->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header('location:../View/listAllCategory.php');
        exit();
    }
        
} catch (Exception $e){
  echo "error: " . $e->getMessage();
}

$conn = null;
?>