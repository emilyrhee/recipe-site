<?php
include "./handlers/connect.php";
//include "../UserFeatures/bookmarkfunct.php";

$erroMessage = "";
$recipe_img = [];
$recipePerPage = 6;

if (isset($conn)) {
    $db = "recipemanagementsystem";

    try {
        $sqlit = "SELECT
        r.id, 
        r.title, 
        r.ingredients, 
        r.instructions, 
        r.category, 
        r.image_url, 
        u.username 
        FROM Recipe r
        JOIN Users u ON r.chef_id = u.id
        ORDER BY r.reg_date DESC";
        $stateme = $conn->prepare($sqlit);
        $stateme->execute();

        $recipe_img = $stateme->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $erroMessage = "Error connecting to database " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes display</title>
</head>

<body>
    <?php
    if (!empty($erroMessage)) {
        echo $erroMessage;
    } else {
        foreach ($recipe_img as $images) {
            $imageUrl = !empty($images['image_url']) ? htmlspecialchars($images['image_url']) : 'default-image.jpg';
            $title = htmlspecialchars($images['title']);
            $chef_name = htmlspecialchars($images['username']);
            $ingredients = htmlspecialchars($images['ingredients']);
            //var_dump($images['image_url']); love this lil thing 

            echo "<div class='recipe'>
                <h3>{$title}</h3>
                <div class='image-container'>
                    <img src='{$imageUrl}' class='pic-of-recipes' alt='Image of {$title}' style='width: 200px;'>
                </div>
                <p><em>Chef's Name :</em> {$chef_name}</p>
                <p><em>Ingredients:</em> {$ingredients}</p>
            </div>";
            if (isset($_SESSION['role']) && ($_SESSION['role'] === 'client' || $_SESSION['role'] === 'chef')) {
                echo "
                <div>
                    <button class='bookmark-bttn' data-recipe-id='{$images['id']}'>Add to Bookmarks</button>
                </div>";
            }
        }
    }
    ?>
</body>

</html>