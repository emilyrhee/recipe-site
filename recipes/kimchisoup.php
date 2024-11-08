<?php include "../components/connect.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    <?php include "../styles/styles.css" ?>
  </style>
  <title>Kimchi Soup Recipe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <?php include "../components/navbar.php"; ?>

 <div class="container">
    <div class="row">
      <div class="col-2">
        <?php include "../components/sidebar.php" ?>
      </div>

      <div class="col-8"> 
        <?php
          if (isset($recipe['title'])) {
              echo "<h1>" . htmlspecialchars($recipe['title']) . "</h1>";
              echo "<p>" . htmlspecialchars($recipe['instructions']) . "</p>";
          } else {
              echo "<h1>Recipe not found</h1>";
          }
        ?>
      </div>

      <div class="col-2"> 
        <!-- maybe put something here  -->
      </div>
    </div>
  </div>

</body>
</html>