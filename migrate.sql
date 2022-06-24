CREATE TABLE `users`
(
    `id`              SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    `login`           VARCHAR(100)         NOT NULL,
    `password`        VARCHAR(100)          NOT NULL,
    `created_at`      DATETIME             NOT NULL,
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
    `created_at`      DATETIME             NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_user_id_users`
        FOREIGN KEY (`user_id`)
            REFERENCES `users` (`id`)
            ON DELETE RESTRICT
            ON UPDATE RESTRICT
)
    ENGINE = InnoDB;