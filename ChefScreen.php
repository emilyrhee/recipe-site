<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Recipe</title>
  <style>
    <?php include "styles/styles.css" ?>
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT1bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <?php include "components/navbar.php"; ?>

  <div class="d-flex flex-column justify-content-center align-items-center pt-5">
    <h3>Add Recipe</h3>

    <div class="row col-lg-3"></div>

    <div class="row col-lg-6">
      <form class="form-control" action="../handlers/recipeUpload.php" method="POST" enctype="multipart/form-data">
        <div class="py-1">
          <input class="form-control" type="text" name="title" id="title-recipe" placeholder="Dish Name" required>
        </div>

        <div class="py-1">
          <textarea class="form-control" id="ingredients" placeholder="Ingredients (separate by commas, no space)" name=" ingredients" required></textarea>
        </div>

        <div class="py-1">    
          <input class="form-control" type="text" name="category" id="categor" placeholder="Country/culture" required>
        </div>

        <div class="py-1">
          <textarea class="form-control" id="description" placeholder="Instructions" name="instructions" required></textarea>
        </div> 
        
        <div class="py-1">
          <input type="file" class="form-control" id="uploading-img" placeholder="Upload Image" name="image" required>
        </div>

        <div class="py-1">
          <button class="btn btn-primary" type="submit">Upload</button>
        </div>
      </form>
    </div>

    <div class="row col-lg-3"></div>
  </div>
</body>

</html>