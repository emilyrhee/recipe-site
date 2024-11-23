<?php
include "handlers/connect.php";
session_start();

if (isset($_GET['id'])) {
  $recipeId = (int)$_GET['id'];
} else {
  $recipeId = null;
}

if ($recipeId !== null) {
  $stmt = $conn->prepare("SELECT title, instructions, ingredients FROM Recipe WHERE id = :id");
  $stmt->bindParam(':id', $recipeId);
  $stmt->execute();
  $recipe = $stmt->fetch(PDO::FETCH_ASSOC);
  $pageTitle = htmlspecialchars($recipe['title']) . " Recipe";
  $ingredients = explode(',', $recipe['ingredients']);
} else {
  $erroMessage = "Recipe not found.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    <?php include "styles/styles.css" ?>
  </style>
  <title><?php echo $pageTitle; ?></title>
  <script src="scripts/MyAccountScript.js"></script>
  <script src="scripts/search.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <?php include "components/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-2 d-none d-md-block">
        <?php include "components/sidebar.php" ?>
      </div>

      <div class="col-8">
        <?php if (isset($recipe['title'])): ?>
          <h1 class="py-3"><?= htmlspecialchars($recipe['title']); ?></h1>

          <h3>Ingredients</h3>
          <ul class="list-group list-group-flush">
            <?php foreach ($ingredients as $ingredient): ?>
              <li class="list-group-item" style="width:25%;"><?= htmlspecialchars($ingredient); ?></li>
            <?php endforeach; ?>
          </ul>

          <p class="py-3"><?= htmlspecialchars($recipe['instructions']); ?></p>
        <?php else: ?>
          <h1>Recipe not found</h1>
        <?php endif; ?>
      </div>

      <div class="col-2">
        <!-- maybe put something here  -->
      </div>

      <?php include "components/mobile/sidebar.php"; ?>
    </div>
  </div>

  <?php include "components/footer.php"; ?>
</body>

</html>