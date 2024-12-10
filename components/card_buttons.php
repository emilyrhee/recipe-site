<div class="card-actions">
<?php if ($currentPage === 'chef_recipes_display.php'): ?>
    <a href="#"> <!-- make this go to an edit page -->
    <button class="btn btn-secondary"><i class="fas fa-edit"></i></button>
    </a>
    <button class="btn btn-danger delete-btn"
    data-recipe-id="<?= $images['id'] ?>"
    aria-label="Delete Recipe">
    <i class="fa fa-trash"></i>
    </button>
<?php endif; ?>
</div>