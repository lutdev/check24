CREATE TABLE `users`
(
    `id`              SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    `login`           VARCHAR(100)         NOT NULL,
    `password`        VARCHAR(255)          NOT NULL,
    `created_at`      DATETIME             NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `login` (`login`)
)
    ENGINE = InnoDB;

CREATE TABLE `articles`
(
    `id`              SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    `title`           VARCHAR(100)         NOT NULL,
    `description`     TEXT                 CHARACTER SET  utf8mb4 NOT NULL,
    `user_id`         SMALLINT(5) UNSIGNED NOT NULL,
    `created_at`      DATETIME             NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_user_id_users`
        FOREIGN KEY (`user_id`)
            REFERENCES `users` (`id`)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT
)
    ENGINE = InnoDB;

/** password is 123456*/
INSERT INTO `users` (`login`, `password`) VALUES ('check24', '$2y$10$fgQNUpAXSI3sblDQ3vrEseD7.ESL1h2NUO3PdtTgGOEg6O3HH927m');
SET @user_id = LAST_INSERT_ID();

INSERT INTO `articles` (`title`, `description`, `user_id`) VALUES ('My first article', 'My description', @user_id);
