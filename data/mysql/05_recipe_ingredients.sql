CREATE TABLE recipe_ingredients
(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    recipe_id     INT            NOT NULL,
    ingredient_id INT            NOT NULL,
    quantity      DECIMAL(10, 2) NOT NULL, -- Quantity for the ingredient
    unit          VARCHAR(50),             -- Unit of measurement (e.g., grams, cups)
    FOREIGN KEY (recipe_id) REFERENCES recipes (id),
    FOREIGN KEY (ingredient_id) REFERENCES ingredients (id)
);
