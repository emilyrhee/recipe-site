<?php
include "../handlers/connect.php";
$err = "";
session_start();
$bookmarkedRecipes = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if (isset($conn)) {
        $db = "recipemanagementsystem";

        try {
            $fetch = "SELECT title, ingredients, instructions, image_url FROM Bookmark WHERE user_id = :user_id";

            $stmt = $conn->prepare($fetch);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            $bookmarkedRecipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($bookmarkedRecipes);
        } catch (PDOException $e) {
            $err = "An error occured connecting to the database." . $e->getMessage();
            echo $err;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookedmarked Recipes</title>
</head>

<body>

<?php 
require_once 'bookmarked_page.php';
require_once "../handlers/connect.php";
?>

<h1>Bookmarked Recipes</h1>

<div>
<?php if (!empty($bookmarkedRecipes)): ?>
        <?php foreach ($bookmarkedRecipes as $recipe): ?>
            <div class='recipes'>
                <h2><?= htmlspecialchars($recipe['title']) ?></h2>
                <img src="<?= htmlspecialchars($recipe['image_url']) ?>" alt="Recipe Image">
                <h3>Ingredients:</h3>
                <p><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>
                <h3>Instructions:</h3>
                <p><?= nl2br(htmlspecialchars($recipe['instructions'])) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You have no bookmarked recipes.</p>
    <?php endif; ?>
</div>
</body>

</html>