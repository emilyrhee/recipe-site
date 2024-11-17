<?php
$padding = 3;
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

<div class="container mt-4">
  <?php if (!empty($erroMessage)): ?>
    <div class="alert alert-danger"><?= $erroMessage ?></div>
  <?php else: ?>
    <div class="row gy-5">
      <?php
      $isLoggedIn = isset($_SESSION['role']);
      // Limit recipes if the user is not logged in
      $recipesToShow = $isLoggedIn ? $recipe_img : array_slice($recipe_img, 0, 6);

      foreach ($recipesToShow as $images):
        $imageUrl = !empty($images['image_url']) ? htmlspecialchars($images['image_url']) : 'default-image.jpg';
        $title = htmlspecialchars($images['title']);
        $chef_name = htmlspecialchars($images['username']);
      ?>
        <div class="col-sm-6 col-md-4">
          <div class="card h-100">
            <img src="<?= $imageUrl ?>" class="card-img-top" alt="<?= $title ?>" style="object-fit: cover; height: 200px;">
            <div class="card-body position-relative">
              <h5 class="card-title"><?= $title ?></h5>
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
