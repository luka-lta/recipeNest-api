CREATE TABLE weekly_recipes
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    recipe_id  INT  NOT NULL,
    week_start DATE NOT NULL,
    week_end   DATE NOT NULL,
    FOREIGN KEY (recipe_id) REFERENCES recipes (id)
);
