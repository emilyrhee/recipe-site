<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Recipes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div>
    <h3>Add Recipe</h3>

    <form class="adding-recipe" action="../handlers/recipeUpload.php" method="POST" enctype="multipart/form-data">
      <div><input class="recipe-title" type="text" name="title" id="title-recipe" placeholder="Name of Recipe" required></div>

      <div> <textarea class="recipe-instruc" id="ingredients" placeholder="Name the Ingredient" name=" ingredients" required></textarea> </div>
      <div>
        <input class="categories" type="text" name="category" id="categor" placeholder="Enter the category" required>
      </div>
      <div> <textarea class="recipe-desc" id="description" placeholder="Description of recipe" name="instructions" required></textarea> </div>

      <div> <input type="file" class="image-upload" id="uploading-img" placeholder="Upload Image" name="image" required> </div>

      <div> <button type="submit">Upload</button> </div>
    </form>
  </div>
</body>

</html>