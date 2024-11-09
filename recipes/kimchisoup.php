<?php 
  include "../handlers/connect.php"; 
  session_start();

  $stmt = $conn->prepare("SELECT title, instructions FROM Recipe WHERE id = :id");
  $stmt->bindParam(':id', $recipeId);
  $recipeId = 1; // this is hard-coded rn, needs to be changed later.
  $stmt->execute();
  $recipe = $stmt->fetch(PDO::FETCH_ASSOC);
  $pageTitle = htmlspecialchars($recipe['title']) . " Recipe";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    <?php include "../styles/styles.css" ?>
  </style>
  <script src="../scripts/MyAccountScript.js" defer></script>
  <title><?php echo $pageTitle; ?></title>
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