<?php include __DIR__ . "/../handlers/fetch_filter.php" ?>

<h5>Filter by</h5>
<form action="/action_page.php" method="GET">
  <h6>Category</h6>
  <?php foreach ($categories as $category): ?>
    <input type="checkbox" id="<?= htmlspecialchars($category) ?>" name="categories[]" value="<?= htmlspecialchars($category) ?>">
    <label for="<?= htmlspecialchars($category) ?>"><?= htmlspecialchars($category) ?></label><br>
  <?php endforeach; ?>
  <br>
  <input type="submit" value="Submit">
</form>