<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar">
  <div class="container-fluid">
    <a class="navbar-brand">EasyBytes</a>
    
    <!-- Hamburger menu (for mobile) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <form class="d-flex ms-auto my-2 my-lg-0" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      
      <!-- Login  -->
      <!-- <div class="SignOut ms-lg-3 d-flex align-items-center">
        <span class="profile-icon me-2">
          <img class="icon" src="../Images/profileIcon.png" alt="Profile Icon" style="width: 30px; height: 30px;"/>
        </span>
        <a href="../components/LoginForm.php" title="Make an account and Sign-In" class="btn btn-outline-primary">Login</a>
      </div> -->
      <!-- login/logout logic --->

      <?php if(isset($_SESSION["user_id"])) : ?>
        <span class="profile-icon me-2"> 
          <img class="icon" src="../Images/profileIcon.png" alt="Profile Icon" style="width: 30px; height: 30px;"/>
          <?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <a href="../components/logout.php" title="Make an account and Sign-In" class="btn btn-outline-primary">Logout</a>
      <?php else : ?>
        <span class="profile-icon me-2">
          <img class="icon" src="../Images/profileIcon.png" alt="Profile Icon" style="width: 30px; height: 30px;"/>
        </span>
        <a href="../components/LoginForm.php" title="Make an account and Sign-In" class="btn btn-outline-primary">Login</a>
        <span>
        <a href="../components/SignIn.php" title="Make an account and Sign-In" class="btn btn-outline-primary">Sign-Up</a>
        </span>
      <?php endif; ?>
    </div>
  </div>
</nav>
