<?php include __DIR__ . "/../handlers/fetch_filter.php" ?>

<h5>Filter by</h5>
<form action="" method="GET">
  <?php foreach ($categories as $category): ?>
    <?php 
      $isChecked = isset($_GET['categories']) && in_array($category, $_GET['categories']);
    ?>
    <input 
      type="checkbox" 
      id="<?= htmlspecialchars($category) ?>" 
      name="categories[]" 
      value="<?= htmlspecialchars($category) ?>" 
      <?= $isChecked ? 'checked' : '' ?>
    >
    <label for="<?= htmlspecialchars($category) ?>"><?= htmlspecialchars($category) ?></label><br>
  <?php endforeach; ?>
  <br>
  <input type="submit" value="Submit">
</form>
