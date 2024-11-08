<?php include __DIR__ . "/../AccountHamburger/MyAccount.php"; ?>
<?php if(isset($_SESSION["user_id"])) : ?>
  <button class="btn btn-secondary my-1" id="checking" onclick="hamburgerDropDown()">My Account</button>
  <a href="/handlers/logout.php" class="btn btn-secondary">Logout</a>
<?php else : ?>
  <div>
    <a href="/LoginForm.php" class="btn btn-secondary my-1">Login</a>
  </div>
  <div>
    <a href="/SignIn.php" class="btn btn-secondary my-1">Sign-Up</a>
  </div>
<?php endif; ?>
<button class="btn btn-secondary my-1" id="subscribe">Subscribe</button>