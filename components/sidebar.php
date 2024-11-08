<?php include __DIR__ . "/../AccountHamburger/MyAccount.php"; ?>
<?php if(isset($_SESSION["user_id"])) : ?>
  <button class="btn btn-secondary my-1" id="checking" onclick="hamburgerDropDown()">My Account</button>
  <button href="../components/logout.php" class="btn btn-secondary">Logout</button>
<?php else : ?>
  <div>
    <button href="../components/LoginForm.php" class="btn btn-secondary my-1">Login</button>
  </div>
  <div>
  <button href="../components/SignIn.php" class="btn btn-secondary my-1">Sign-Up</button>
  </div>
<?php endif; ?>
<button class="btn btn-secondary my-1" id="subscribe">Subscribe</button>