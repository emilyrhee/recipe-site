document.addEventListener('DOMContentLoaded', function () {
  const deleteButtons = document.querySelectorAll('.delete-btn');

  deleteButtons.forEach(button => {
    button.addEventListener('click', function (event) {
      event.preventDefault(); // Prevent page reload
      const recipeId = this.dataset.recipeId;

      if (confirm('Are you sure you want to delete this recipe?')) {
        fetch('../handlers/delete-recipe.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ recipe_id: recipeId })
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert('Recipe deleted successfully.');
              this.closest('.col-sm-6').remove();
            } else {
              alert('Error: ' + data.message);
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the recipe.');
          });
      }
    });
  });
});