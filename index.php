<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EasyBytes</title>
  <style>
    <?php include "styles/styles.css"?>
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <?php include "components/navbar.php"; ?>

  <?php
    $padding = 3;
  ?>

  <div class="container">
    <div class="row gy-5">
      <div class="col-sm">
        <div class="ratio ratio-1x1">
          <img class="p-<?= $padding ?>" src="https://www.maangchi.com/wp-content/uploads/2007/11/kimchijjigae-590x411.jpg" style="object-fit: cover;" alt="Kimchi soup">
        </div>
        <h6 class="text-center mt-2">Kimchi Soup</h6>
      </div>
      <div class="col-sm">
        <div class="ratio ratio-1x1">
          <img class="p-<?= $padding ?>" src="https://balancewithjess.com/wp-content/uploads/2022/08/Jumeokbap-Feat.jpg" style="object-fit: cover;" alt="Jumeokbap">
        </div>
        <h6 class="text-center mt-2">Rice Balls</h6>
      </div>
      <div class="col-sm">
        <div class="ratio ratio-1x1">
          <img class="p-<?= $padding ?>" src="https://tiffycooks.com/wp-content/uploads/2021/04/Screen-Shot-2021-04-07-at-1.01.41-AM.png" style="object-fit: cover;" alt="Jumeokbap">
        </div>
        <h6 class="text-center mt-2">Marinated Eggs</h6>
      </div>
      </div>
    </div>
    <div class="row gy-5">
      <!-- add more imgs here! -->
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>