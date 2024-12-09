USE recipemanagementsystem;

ALTER TABLE Bookmark
DROP FOREIGN KEY Bookmark_ibfk_1;

ALTER TABLE Bookmark
ADD CONSTRAINT fk_bookmark_recipe
FOREIGN KEY (recipe_id)
REFERENCES Recipe(id)
ON DELETE CASCADE;