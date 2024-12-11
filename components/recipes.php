<?php
include __DIR__ . '/../handlers/connect.php';

$erroMessage = "";
$recipe_img = [];
$recipe_pagination = 6;

$currentPage = basename($_SERVER['PHP_SELF']);

$isLoggedIn = isset($_SESSION['role']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : null;

$paginationDetails = pagination_logic($conn, 'Recipe', $recipe_pagination);
$curPage = $paginationDetails['curPage'];
$startPage = $paginationDetails['startPage'];
$total_displayPage = $paginationDetails['total_displayPage'];

$selectedCategories = isset($_GET['categories']) ? $_GET['categories'] : [];

$sqlit = "SELECT
            r.id, 
            r.title, 
            r.category, 
            r.image_url, 
            u.username 
          FROM Recipe r
          JOIN Users u ON r.chef_id = u.id";

$whereClauses = [];
$params = [];

if (!empty($selectedCategories)) {
    $placeholders = implode(',', array_fill(0, count($selectedCategories), '?'));
    $whereClauses[] = "r.category IN ($placeholders)";
    $params = array_merge($params, $selectedCategories);
}

if ($isLoggedIn && $currentPage === 'chef_recipes_display.php') {
    $whereClauses[] = "r.chef_id = ?";
    $params[] = $user_id;
}

// Append WHERE clauses to SQL query
if (!empty($whereClauses)) {
    $sqlit .= " WHERE " . implode(' AND ', $whereClauses);
}

$sqlit .= " ORDER BY r.reg_date DESC LIMIT ?, ?";

$params[] = $startPage;
$params[] = $recipe_pagination;

try {
    $stateme = $conn->prepare($sqlit);

    foreach ($params as $index => $value) {
        $stateme->bindValue($index + 1, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
    }

    $stateme->execute();
    $recipe_img = $stateme->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $erroMessage = "Error connecting to database: " . $e->getMessage();
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
        <div class="col-sm-6 col-md-5 col-lg-4">
          <div class="card h-100">
            <a href="../recipe-template.php?id=<?= $images['id'] ?>">
              <img src="<?= $imageUrl ?>" class="card-img-top" alt="<?= $title ?>" style="object-fit: cover; height: 200px;">
            </a>
            <?php include __DIR__ . "/bookmark_button.php"; ?>
            <div class="card-body position-relative">
              <a href="../recipe-template.php?id=<?= $images['id'] ?>" class="link-dark">
                <h5 class="card-title"><?= $title ?></h5>
              </a>
              <p class="card-text">By <?= $chef_name ?></p>
            <?php include __DIR__ . "/card_buttons.php" ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <nav class="pagination_logic" aria-label="Page navigation">
      <ul class="pagination justify-content-center mt-4">
        <?php for ($i = 1; $i <= ceil($total_displayPage); $i++): ?>
          <li class="page-item <?= ($i == $curPage) ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>
      </ul>
    </nav>
  <?php endif; ?>
</div>