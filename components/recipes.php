<?php
$padding = 3;
include  __DIR__ . '/../handlers/connect.php';
//include "../UserFeatures/bookmarkfunct.php";

$erroMessage = "";
$recipe_img = [];
$recipePerPage = 6;

$currentPage = basename($_SERVER['PHP_SELF']);

$isLoggedIn = isset($_SESSION['role']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : null;

if ($isLoggedIn && $currentPage === 'chef_recipes_display.php') {
    // Only show recipes from the logged-in chef on chef_recipes_display.php
    $sqlit = "SELECT
                r.id, 
                r.title, 
                r.category, 
                r.image_url, 
                u.username 
              FROM Recipe r
              JOIN Users u ON r.chef_id = u.id
              WHERE r.chef_id = :user_id
              ORDER BY r.reg_date DESC";
} else {
    // Show all recipes on any other page
    $sqlit = "SELECT
                r.id, 
                r.title, 
                r.category, 
                r.image_url, 
                u.username 
              FROM Recipe r
              JOIN Users u ON r.chef_id = u.id
              ORDER BY r.reg_date DESC";
}

if (isset($conn)) {
    try {
        $stateme = $conn->prepare($sqlit);
        
        // Bind user_id if needed for the chef-specific query
        if ($isLoggedIn && $currentPage === 'chef_recipes_display.php') {
            $stateme->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        }
        
        $stateme->execute();
        $recipe_img = $stateme->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $erroMessage = "Error connecting to database: " . $e->getMessage();
    }
}
?>

<div class="container mt-4">
  <?php if (!empty($erroMessage)): ?>
    <div class="alert alert-danger"><?= $erroMessage ?></div>
  <?php else: ?>
    <div class="row gy-5">
      <?php
      // Limit recipes if the user is not logged in
      $recipesToShow = $isLoggedIn ? $recipe_img : array_slice($recipe_img, 0, 6);

      foreach ($recipesToShow as $images):
        $imageUrl = !empty($images['image_url']) ? htmlspecialchars($images['image_url']) : 'default-image.jpg';
        $title = htmlspecialchars($images['title']);
        $chef_name = htmlspecialchars($images['username']);
      ?>
        <div class="col-sm-6 col-md-4">
          <div class="card h-100">
            <a href="../recipe-template.php?id=<?= $images['id'] ?>">
              <img src="<?= $imageUrl ?>" class="card-img-top" alt="<?= $title ?>" style="object-fit: cover; height: 200px;">
            </a>
            <div class="card-body position-relative">
            <a href="../recipe-template.php?id=<?= $images['id'] ?>" class="link-dark">
                <h5 class="card-title"><?= $title ?></h5>
              </a>
              <p class="card-text">By <?= $chef_name ?></p>
              <?php if ($isLoggedIn && ($_SESSION['role'] === 'client' || $_SESSION['role'] === 'chef')): ?>
                <button class="bookmark-bttn position-absolute top-0 end-0 me-2 mt-2" 
                        data-recipe-id="<?= $images['id'] ?>" 
                        aria-label="Add to Bookmarks">
                  <i class="fa fa-star" aria-hidden="true"></i>
                </button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
