<nav class="navbar navbar-expand-lg navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="/index.php">EasyBytes</a>

    <!-- Hamburger menu (for mobile) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <form class="d-flex ms-auto my-2 my-lg-0" role="search" style="position: relative;">
        <input class="form-control me-2" type="search" placeholder="Search" id="searching" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" onclick="search()">Search</button>
        <div id="result" class="dropdown-results"></div>
      </form>

      <?php if (isset($_SESSION["user_id"])): ?>
        <div>
          <span>
            <?php echo htmlspecialchars($_SESSION["username"]); ?>
          </span>
        </div>
      <?php endif; ?>
    </div>
</nav>