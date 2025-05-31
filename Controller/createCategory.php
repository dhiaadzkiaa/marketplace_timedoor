<?php 
include('../Config/db.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $category_name = $_POST['category_name'];

    try{
        $checkStart = $conn->prepare("SELECT COUNT(*) FROM categories WHERE 
        category_name = :category_name");
        $checkStart->bindParam(':category_name', $category_name);
        $checkStart->execute();

        $count = $checkStart->fetchColumn();

        if ($count > 0) {
            echo "kategori dengan nama '$category_name' sudah ada, silahkan gunakan nam lain.";
        } else {
            $stmt = $conn->prepare("INSERT INTO categories (category_name)
            VALUES (:category_name)");
            $stmt->bindParam(':category_name', $category_name);
            $stmt->execute();

            header('location:../View/listAllCategory.php');
            exit();
        }
    } catch (Exception $e){
        echo "error: " . $e->getMessage();
    }
}

$conn = null;
?>