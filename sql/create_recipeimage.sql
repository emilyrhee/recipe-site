USE recipemanagementsystem;

CREATE TABLE RecipeImages(
	id INT AUTO_INCREMENT PRIMARY KEY,
    recipe_id INT,
    image_url VARCHAR(555),
    instructions VARCHAR(255),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (recipe_id) REFERENCES Recipe(id)
);

ALTER TABLE RecipeImages 
CHANGE COLUMN description instructions VARCHAR(255);