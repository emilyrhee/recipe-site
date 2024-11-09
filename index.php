<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EasyBytes</title>
  <style>
    <?php include "styles/styles.css" ?>
  </style>
  <script src="./scripts/script.js" defer></script>
  <script src="./scripts/MyAccountScript.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <?php include "components/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-2">
        <?php include "components/sidebar.php" ?>
      </div>

      <div class="col-8"> 
        <?php include "components/recipes.php" ?>
      </div>

      <div class="col-2"> 
        <h5>Filter by</h5>
        <h6>Ingredients</h6>
        <form action="/action_page.php">
          <input type="checkbox" id="rice" name="ingredients" value="Rice">
          <label for="Rice">Rice</label><br>
          <input type="checkbox" id="tofu" name="ingredients" value="Tofu">
          <label for="Tofu">Tofu</label><br>
          <input type="checkbox" id="eggs" name="ingredients" value="Eggs">
          <label for="Eggs">Eggs</label><br><br>
          <h6>Culture</h6>
          <input type="checkbox" id="korean" name="culture" value="korean">
          <label for="korean">Korean</label><br>
          <input type="checkbox" id="korean" name="culture" value="korean">
          <label for="korean">Japanese</label><br><br>
          <input type="submit" value="Submit">

        </form>
      </div>
    </div>
  </div>
  <?php if(!isset($_SESSION["user_id"])) : ?>
        <div class="the-blur-screen" >
          <div class="login-signUp-prompt">
            <p>Please login or Sign up to view more recipes</p>
            <a href="LoginForm.php" class="btn btn-outline-primary">Login</a> | 
            <a href="SignIn.php" class="btn btn-outline-primary">Sign-Up</a>
          </div>
        </div>
      <?php endif; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>