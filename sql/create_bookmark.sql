USE recipemanagementsystem;

CREATE TABLE Bookmark(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_id INT NOT NULL,
    recipe_id INT NOT NULL,
    title TEXT NOT NULL,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    image_url VARCHAR(555) NOT NULL,
    bookmark_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN  KEY(recipe_id) REFERENCES Recipe(id)  ON DELETE CASCADE,
    FOREIGN KEY(user_id) REFERENCES Users(id)  ON DELETE CASCADE,
    UNIQUE (user_id, recipe_id)
);