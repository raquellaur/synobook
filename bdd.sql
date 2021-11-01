CREATE TABLE user
(
    id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    firstname  VARCHAR(255) NOT NULL,
    lastname   VARCHAR(255) NOT NULL,
    login      VARCHAR(255) NOT NULL,
    email      VARCHAR(255) NOT NULL,
    password   VARCHAR(255) NOT NULL,
    created_at DATETIME     NOT NULL,
    updated_at DATETIME     NOT NULL,
    PRIMARY KEY (id)
)

CREATE TABLE post
(
    id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id    INT UNSIGNED NOT NULL,
    name       VARCHAR(255) NOT NULL,
    content    TEXT(650000) NOT NULL,
    created_at DATETIME     NOT NULL,
    PRIMARY KEY (id)
        CONSTRAINT fk_user
        FOREIGN KEY (user_id)
        REFERENCES user (id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT,
)
