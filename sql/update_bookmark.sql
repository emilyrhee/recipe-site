USE recipemanagementsystem;

ALTER TABLE Bookmark
DROP FOREIGN KEY Bookmark_ibfk_1;

ALTER TABLE Bookmark
ADD CONSTRAINT fk_bookmark_recipe
FOREIGN KEY (recipe_id)
REFERENCES Recipe(id)
ON DELETE CASCADE;

ALTER TABLE Bookmark
DROP FOREIGN KEY Bookmark_ibfk_2;

ALTER TABLE Bookmark
ADD CONSTRAINT Bookmark_ibfk_2 FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE;