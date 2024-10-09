CREATE TABLE recipe_sections
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    recipe_id   INT          NOT NULL,
    title       VARCHAR(255) NOT NULL, -- Section title like "Preparation" or "Cooking"
    description TEXT,                  -- Instructions for this section
    position    INT,                   -- Order of the section within the recipe
    FOREIGN KEY (recipe_id) REFERENCES recipes (id)
);
