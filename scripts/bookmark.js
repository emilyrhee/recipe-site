document.addEventListener('DOMContentLoaded', () => {
    const bookmarkButtons = document.querySelectorAll('.bookmark-bttn');

    bookmarkButtons.forEach(button => {
        button.addEventListener('click', () => {
            const recipeId = button.getAttribute('data-recipe-id');

            const formData = new FormData();
            formData.append('recipe_id', recipeId);

            fetch('../UserFeatures/bookmarkfunct.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => {
                   /* console.log(response.status);
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }*/
                    return response.text();
                })
                .then(data => {
                    console.log(data);
                    alert(data || "'yeah nothing came thought"); // cope this script from AI, couldn't get my idea to work
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Kinda bad here')
                });
        });
    });
});
