<?php
session_start();
$_SESSION['myVariable'] = "";
include "./handlers/pagination_logic.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EasyBytes</title>
  <script src="scripts/script.js"></script>
  <script src="scripts/MyAccountScript.js"></script>
  <script src="scripts/bookmark.js"></script>
  <script src="scripts/search.js"></script>
  <script src="scripts/filter_recipe.js"></script>
  <script src="scripts/pswd_strength.js"></script>
  <script src="scripts/delete_recipe.js"></script>
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <?php include "components/navbar.php"; ?>

  <div class="container">
    <div class="row pt-4">
      <div class="col-2 d-none d-md-block">
        <?php include "components/sidebar.php" ?>
      </div>

      <div class="col-sm-12 col-md-8 col">
        <?php include "components/recipes.php" ?>
      </div>

      <div class="col-2 d-none d-md-block">
        <?php include "components/filter.php" ?>
      </div>
    </div>

    <?php
    include "components/mobile/sidebar.php";
    include "components/mobile/filter.php";
    ?>
  </div>

  <?php if (!isset($_SESSION["user_id"])) : ?>
    <div class="the-blur-screen d-flex justify-content-center align-items-center">
      <div class="login-signUp-prompt p-3">
        <p>Please login or Sign up to view more recipes</p>
        <a href="LoginForm.php" class="btn btn-outline-primary">Login</a> |
        <a href="SignIn.php" class="btn btn-outline-primary">Sign-Up</a>
      </div>
    </div>
  <?php endif; ?>

  <?php include "components/footer.php"; ?>
</body>

</html>