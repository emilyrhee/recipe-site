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
      // Update query to join the Recipe table on chef_id
      $fetch = "
    SELECT 
      Bookmark.title, 
      Bookmark.image_url, 
      Recipe.id AS recipe_id,   -- Added recipe id here
      Recipe.chef_id, 
      Users.username 
    FROM Bookmark
    JOIN Recipe ON Bookmark.recipe_id = Recipe.id
    JOIN Users ON Recipe.chef_id = Users.id
    WHERE Bookmark.user_id = :user_id";


      $stmt = $conn->prepare($fetch);
      $stmt->bindParam(':user_id', $user_id);
      $stmt->execute();

      $bookmarkedRecipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      $err = "An error occurred connecting to the database: " . $e->getMessage();
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
  <script src="../scripts/MyAccountScript.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>

  <?php
  require_once 'bookmarked_page.php';
  require_once "../handlers/connect.php";
  include "../components/navbar.php";
  ?>

  <div class="container mt-4">
    <div class="row">
      <div class="col-2 d-none d-md-block">
        <?php include "../components/sidebar.php" ?>
      </div>

      <div class="col-8">
        <h2 class="mb-4">Bookmarked Recipes</h2>
        <?php if (!empty($bookmarkedRecipes)): ?>
          <div class="row gy-5"> <!-- Add a row here -->
            <?php foreach ($bookmarkedRecipes as $recipe): ?>
              <?php
              $title = htmlspecialchars($recipe['title']);
              $chefName = htmlspecialchars($recipe['username'] ?? 'Unknown Chef');
              ?>
              <div class="col-sm-6 col-md-5 col-lg-4">
                <div class="card h-100">
                  <a href="../recipe-template.php?id=<?= $recipe['recipe_id'] ?>">
                    <img src="<?= htmlspecialchars($recipe['image_url']) ?>" class="card-img-top" style="object-fit: cover; height: 200px;">
                  </a>
                  <div class="card-body position-relative">
                    <a href="../recipe-template.php?id=<?= $recipe['recipe_id'] ?>" class="link-dark">
                      <h5><?= $title ?></h5>
                    </a>
                    <p>By <?= $chefName ?></p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p>You have no bookmarked recipes.</p>
        <?php endif; ?>
      </div>

      <div class="col-2 d-none d-md-block">
        <?php include "../components/filter.php" ?>
      </div>
    </div>
  </div>

  <?php
  include "../components/mobile/sidebar.php";
  include "../components/mobile/filter.php";
  ?>

  <?php include "../components/footer.php"; ?>
</body>

</html>