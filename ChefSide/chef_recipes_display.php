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
  <style>
    <?php include "../styles/styles.css" ?>
  </style>
  <script src="../scripts/MyAccountScript.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <?php include "../components/navbar.php"; ?>
  <div class="container">
    <div class="row pt-4">
      <div class="col-2">
        <?php include "../components/sidebar.php"; ?>
      </div>

      <div class="col-8">
        <?php if (!empty($errorMessage)): ?>
          <p class="error"><?= htmlspecialchars($errorMessage) ?></p>
        <?php else: ?>
          <?php foreach ($recipes as $recipe): ?>
            <?php
              $title = htmlspecialchars($recipe['title']);
              $category = htmlspecialchars($recipe['category']);
              $ingredients = htmlspecialchars($recipe['ingredients']);
              $instructions = htmlspecialchars($recipe['instructions']);
              $imageUrl = !empty($recipe['image_url']) ? htmlspecialchars($recipe['image_url']) : 'default-image.jpg';
            ?>
            <div class="recipe">
              <h3><?= $title ?></h3>
              <p>Category: <?= $category ?></p>
              <p>Ingredients: <?= $ingredients ?></p>
              <p>Instructions: <?= $instructions ?></p>
              <img src="<?= $imageUrl ?>" alt="Image of <?= $title ?>" class="pb-5 d-block" style="width: 200px;">
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

        <!-- TODO: make this a part of the side bar only when you're on this page -->
        <a href="../ChefScreen.php">
          <button class="btn btn-primary">Add Recipe</button>
        </a>
      </div>

      <div class="col-2"></div>
    </div>
  </div>

  <?php include "../components/footer.php" ?>
</body>


</html>