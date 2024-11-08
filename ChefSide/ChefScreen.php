<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Recipe</title>
</head>
<body>
    <div>
        <button>Add Recipe</button>
    </div>

    <div>
        <h3 >Add Recipe</h3>

        <form class="adding-recipe" action="../components/recipeUpload.php" method="POST" enctype="multipart/form-data">
         <div><input class="recipe-title" type="text" name="title" id="title-recipe" placeholder="Name of Recipe" required></div>   

        <div> <textarea class="recipe-desc" id="description" placeholder="Description of recipe" required></textarea> </div>

        <div> <input type="file" class="image-upload" id="uploading-img" placeholder="Upload Image" name="image" required> </div>

       <div> <button type="submit">Upload</button> </div>
        </form>
    </div>
</body>
</html>