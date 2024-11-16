<?php
include "../handlers/connect.php";
session_start();

$errorMessage = "";
$recipes = [];

if (isset($conn)) {
  $db = "recipemanagementsystem";

  try {
    $sql = " SELECT title, ingredients, instructions, category, image_url FROM Recipe ORDER BY reg_date DESC";
    $statem = $conn->prepare($sql);
    $statem->execute();

    $recipes = $statem->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    $errorMessage = " Connectivity issues with the database " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Recipes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div>
    <?php
    if (!empty($errorMessage)) {
        echo "<p class='error'>" . htmlspecialchars($errorMessage) . "</p>";
    } else {
        foreach ($recipes as $recipe) {
            $title = htmlspecialchars($recipe['title']);
            $category = htmlspecialchars($recipe['category']);
            $ingredients = htmlspecialchars($recipe['ingredients']);
            $instructions = htmlspecialchars($recipe['instructions']);
            $imageUrl = !empty($recipe['image_url']) ? htmlspecialchars($recipe['image_url']) : 'default-image.jpg'; // Fallback image if URL is missing ???? why this
            //var_dump($recipe['image_url']);
            echo "
            <div class='recipe'>
                <h3>{$title}</h3>
                <p><em>Category:</em> {$category}</p>
                <p><em>Ingredients:</em> {$ingredients}</p>
                <p><em>Instructions:</em> {$instructions}</p>
                <div class='image-container'>
                    <img src='{$imageUrl}' class='pic-of-recipes' alt='Image of {$title}' style='width: 200px;'>
                </div>
            </div>";
        }
    }
    ?>

    <a href="../ChefScreen.php"><button class="btn btn-primary">Add Recipe</button></a>
  </div>
</body>

</html>