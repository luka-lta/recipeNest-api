CREATE TABLE users
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    firstname       VARCHAR(50)         NOT NULL,
    lastname        VARCHAR(50)         NOT NULL,
    username        VARCHAR(50) UNIQUE  NOT NULL,
    email           VARCHAR(100) UNIQUE NOT NULL,
    profile_picture VARCHAR(100)        NULL,
    public_recipes  BOOLEAN   DEFAULT true,
    password        VARCHAR(255)        NOT NULL,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
