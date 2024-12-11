<div class="card-actions">
  <?php
    if (
      $currentPage === 'chef_recipes_display.php' ||
      isset($_SESSION['role']) && $_SESSION['role'] === 'admin'
    ): 
  ?>
    <!-- <a href="#"> 
      <button class="btn btn-secondary"><i class="fas fa-edit"></i></button>
    </a> -->
    <button 
      class="btn btn-danger delete-btn"
      data-recipe-id="<?= $images['id'] ?>"
      aria-label="Delete Recipe"
    >
      <i class="fa fa-trash"></i>
    </button>
  <?php endif; ?>
</div>