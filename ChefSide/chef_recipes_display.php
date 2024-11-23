<?php
include "../handlers/connect.php";
include "../handlers/pagination_logic.php";

session_start();

$errorMessage = "";
$recipes = [];
$recipe_pagination = 6; // amt of picture && recipes that can be shown on a single 

if (isset($conn)) {
  $db = "recipemanagementsystem";

  try {


    $paginationDetails = pagination_logic($conn, 'Recipe', $recipe_pagination);
    $curPage = $paginationDetails['curPage'];
    $startPage = $paginationDetails['startPage'];
    $total_displayPage = $paginationDetails['total_displayPage'];

    $sql = " SELECT title, ingredients, instructions, category, image_url FROM Recipe 
            ORDER BY reg_date DESC 
            LIMIT :startPage, :recipe_pagination";
    $statem = $conn->prepare($sql);

    $statem->bindValue(':startPage', $startPage, PDO::PARAM_INT);
    $statem->bindValue(':recipe_pagination', $recipe_pagination, PDO::PARAM_INT);
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
  <script src="../scripts/search.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <?php include "../components/navbar.php"; ?>
  <div class="container">
    <div class="row pt-4">
      <div class="col-2 d-none d-md-block">
        <?php include "../components/sidebar.php"; ?>
      </div>

      <div class="col-12 col-md-8">
        <?php if (empty($recipes)): ?>
          <p>No recipes found. Start adding your recipes!</p>
        <?php else: ?>
          <?php include "../components/recipes.php"; ?>
        <?php endif; ?>

        <!-- TODO: make this a part of the side bar only when you're on this page -->
        <a href="../ChefScreen.php">
          <button class="btn btn-primary">Add Recipe</button>
        </a>
      </div>

      <div class="col-2"></div>

      <?php include "../components/mobile/sidebar.php"; ?>
    </div>
  </div>

  <?php include "../components/footer.php" ?>
</body>

</html>