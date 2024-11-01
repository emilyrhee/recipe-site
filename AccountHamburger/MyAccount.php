<?php if(isset($_SESSION["user_id"])) : ?>
        <div id="MyAccountDropdown" class="acct-dropdown-menu" style="display: none;" >
          <li style="list-style: none;"><a href="#" style="text-decoration: none;">Profile</a></li>
          <li style="list-style: none;"> <a href="#">Bookmarks</a></li>
          <li style="list-style: none;"><a href="../components/logout.php">Logout</a></li>
        </div>
<?php endif; ?>