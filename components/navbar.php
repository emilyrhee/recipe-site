<nav class="navbar navbar-expand-lg nav">
  <div class="container-fluid">
    <a class="navbar-brand" href="/index.php">EasyBytes</a>

    <form class="d-flex my-2 my-lg-0" role="search" style="position: relative;" autocomplete="off">
      <input class="form-control me-2" type="search" placeholder="Look for recipes" id="searching">
      <button class="btn btn-outline-success" type="submit" onclick="search()">Search</button>
      <div id="result" class="dropdown-results"></div>
    </form>

    <?php if (isset($_SESSION["user_id"])): ?>
      <div class="d-none d-md-block">
        <?php echo htmlspecialchars($_SESSION["username"]); ?>
      </div>
    <?php endif; ?>
  </div>
</nav>