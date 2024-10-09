CREATE TABLE recipes
(
    id               INT AUTO_INCREMENT PRIMARY KEY,
    user_id          INT          NOT NULL,
    title            VARCHAR(255) NOT NULL,
    description      TEXT,
    preparation_time INT,                   -- in minutes
    cooking_time     INT,                   -- in minutes
    servings         INT          NOT NULL, -- number of servings
    created_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id)
);
