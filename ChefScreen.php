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

  <div>
    <h3>Add Recipe</h3>

    <form class="adding-recipe" action="../handlers/recipeUpload.php" method="POST" enctype="multipart/form-data">
      <div class="py-1">
        <input class="recipe-title" type="text" name="title" id="title-recipe" placeholder="Name of Recipe" required>
      </div>

      <div class="py-1">
        <textarea class="recipe-instruc" id="ingredients" placeholder="Name the Ingredient" name=" ingredients" required></textarea>
      </div>

      <div class="py-1">    
        <input class="categories" type="text" name="category" id="categor" placeholder="Enter the category" required>
      </div>

      <div class="py-1">
        <textarea class="recipe-desc" id="description" placeholder="Description of recipe" name="instructions" required></textarea>
      </div> 
      
      <div class="py-1">
        <input type="file" class="image-upload" id="uploading-img" placeholder="Upload Image" name="image" required>
      </div>

      <div class="py-1">
        <button type="submit">Upload</button>
      </div>
    </form>
  </div>
</body>

</html>