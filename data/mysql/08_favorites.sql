CREATE TABLE favorites
(
    id        INT AUTO_INCREMENT PRIMARY KEY,
    user_id   INT NOT NULL,
    recipe_id INT NOT NULL,
    added_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (recipe_id) REFERENCES recipes (id)
);
