<?php
if (isset($_SESSION["role"]) && $_SESSION['role'] === 'client') : ?>
  <div id="MyAccountDropdown" style="display: none;">
    <li style="list-style: none;"><a href="../UserFeatures/profile_screen.php" style="text-decoration: none;">Profile</a></li>
    <li style="list-style: none;"> <a href="#">Bookmarks</a></li>
    <li style="list-style: none;"><a href="../handlers/logout.php">Logout</a></li>
  </div>

<?php elseif (isset($_SESSION["role"]) && $_SESSION['role'] === 'chef') : ?>
  <div id="MyAccountDropdown" style="display: none;">
    <li style="list-style: none;"><a href="../UserFeatures/profile_screen.php" style="text-decoration: none;">Profile</a></li>
    <li style="list-style: none;"> <a href="../ChefSide/chef_recipes_display.php">My Recipe</a></li>
    <li style="list-style: none;"><a href="../handlers/logout.php">Logout</a></li>
  </div>
<?php elseif (isset($_SESSION["role"]) && $_SESSION['role'] === 'admin') : ?>
  <div id="MyAccountDropdown" style="display: none;">
    <li style="list-style: none;"><a href="Admin/Admin.php" style="text-decoration: none;">Admin Page</a></li>
    <li style="list-style: none;"><a href="../handlers/logout.php">Logout</a></li>
  </div>
<?php endif; ?>