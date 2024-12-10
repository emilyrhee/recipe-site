<?php if ($isLoggedIn && ($_SESSION['role'] === 'client' || $_SESSION['role'] === 'chef')): ?>
    <button class="bookmark-bttn position-absolute top-0 end-0 me-2 mt-2"
        data-recipe-id="<?= $images['id'] ?>"
        aria-label="Add to Bookmarks">
        <i class="fa fa-star" aria-hidden="true"></i>
    </button>
<?php endif; ?>