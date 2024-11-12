<?php 
include "../handlers/connect.php";
session_start();

$errorMessage = "";
$recipes = [];

if(isset($conn)){
    $db = "recipemanagementsystem";

    try{
        $sql = " SELECT title, ingredients, instructions, category, image_url FROM Recipe ORDER BY reg_date DESC";
        $statem = $conn->prepare($sql);
        $statem->execute();

        $recipes = $statem->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        $errorMessage = " Connectivity issues with the database " . $e->getMessage();
    }
}
if (!empty($errorMessage)) {
    echo $errorMessage;
} else {
    foreach ($recipes as $recipe) {
        echo "<h3>" . htmlspecialchars($recipe['title']) . "</h3>";
        echo "<p><em>Category:</em> " . htmlspecialchars($recipe['category']) . "</p>";
        echo "<p><em>Ingredients:</em> " . htmlspecialchars($recipe['ingredients']) . "</p>";
        echo "<p><em>Instructions:</em> " . htmlspecialchars($recipe['instructions']) . "</p>";
        //echo "<p><em>Image:</em> " . htmlspecialchars($recipe['image_url']) . "</p>";
        echo "
        <div>
        <img src='{$recipe['image_url']}' class='pic-of-recipes' alt='...' style='width: 200px;'>
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <a href="../ChefScreen.php"><button>+ Recipe</button></a>
    </div>
</body>
</html>