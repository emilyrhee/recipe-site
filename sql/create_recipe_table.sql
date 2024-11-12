USE recipemanagementsystem;

CREATE TABLE Recipe(
	id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    category VARCHAR(100),
    chef_id INT, 
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN kEY (chef_id) REFERENCES Users(id)
);

ALTER TABLE recipe
ADD COLUMN image_url VARCHAR(555);
