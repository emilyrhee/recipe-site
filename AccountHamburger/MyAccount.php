<?php 
if(isset($_SESSION["role"]) && $_SESSION['role'] === 'client') : ?>
        <div id="MyAccountDropdown" class="acct-dropdown-menu" style="display: none;" >
          <li style="list-style: none;"><a href="#" style="text-decoration: none;">Profile</a></li>
          <li style="list-style: none;"> <a href="#">Bookmarks</a></li>
          <li style="list-style: none;"><a href="../components/logout.php">Logout</a></li>
        </div>
        
<?php elseif (isset($_SESSION["role"]) && $_SESSION['role'] === 'chef') : ?>
      <div id="MyAccountDropdown" class="acct-dropdown-menu" style="display: none;" >
          <li style="list-style: none;"><a href="#" style="text-decoration: none;">Profile</a></li>
          <li style="list-style: none;"> <a href="../ChefSide/ChefScreen.php">My Recipe</a></li>
          <li style="list-style: none;"><a href="../components/logout.php">Logout</a></li>
        </div>
<?php endif; ?>