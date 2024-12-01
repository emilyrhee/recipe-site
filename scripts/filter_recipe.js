document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('searching');
    searchInput.addEventListener('keyup', filter_recipe);
  });

const filter_recipe = () => {
    const searchQuery = document.getElementById('searching').value.trim();
    const recipeContainer = document.querySelector('card h-100');

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../UserFeatures/recipe_image_filter.php");


    xhr.onload = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const recipeContainer = document.querySelector(".container .row.gy-5");
            recipeContainer.innerHTML = xhr.responseText.trim();

        }
    };

    xhr.send(searchQuery);

}