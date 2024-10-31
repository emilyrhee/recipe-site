<?php if(!isset($_SESSION["user_id"])) : ?>
        <div id="MyAccountDropdown" class="acct-dropdown-menu" >
          <a href="#">Profile</a>
          <a href="#">Bookmarks</a>
          <a href="../components/logout.php">Logout</a>
        </div>
    <?php else : ?>
        <a href="../components/LoginForm.php"> <button> Login</button></a>
        <a href="../components/SignIn.php"> <button> Sign-Up</button></a>
<?php endif; ?>