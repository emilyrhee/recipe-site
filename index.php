<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EasyBytes</title>
  <style>
    <?php include "styles/styles.css" ?>
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <?php include "components/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-2">
        <button class="nav-buttons">My Account</button>
        <button class="nav-buttons">Subscribe</button>
      </div>

      <div class="col-8"> 
        <?php include "recipes.php" ?>
      </div>

      <div class="col-2"> 
        <h5>Filter by</h5>
        <h6>Ingredients</h6>
        <form action="/action_page.php">
          <input type="checkbox" id="rice" name="rice" value="Tofu">
          <label for="">Rice</label><br>
          <input type="checkbox" id="tofu" name="tofu" value="Tofu">
          <label for="">Tofu</label><br>
          <input type="checkbox" id="eggs" name="E" value="Boat">
          <label for="">Eggs</label><br><br>
          <input type="submit" value="Submit">
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>