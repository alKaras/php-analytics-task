CREATE
DATABASE IF NOT EXISTS analytics;

USE
analytics;

DROP TABLE IF EXISTS page_views;

CREATE TABLE page_views
(
    id          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id     INT UNSIGNED NULL,
    url         VARCHAR(128) NOT NULL,
    country     CHAR(2)       NOT NULL,
    device      VARCHAR(16) NOT NULL COMMENT 'Allowed values: desktop, mobile, tablet...',
    created_at  DATETIME      NOT NULL,
    duration_ms INT UNSIGNED NULL,
    PRIMARY KEY (id),
    INDEX       idx_created_country (created_at, country),
    INDEX       idx_url (url),
    INDEX       idx_user_id (user_id)
) ENGINE=InnoDB;

INSERT INTO page_views (user_id, url, country, device, created_at, duration_ms)
VALUES (1, '/product/42', 'UA', 'desktop', '2025-09-15 10:11:12', 350),
       (2, '/product/42', 'UA', 'mobile', '2025-09-15 11:01:02', 900),
       (1, '/home', 'PL', 'mobile', '2025-09-16 08:21:00', 120),
       (3, '/product/7', 'UA', 'desktop', '2025-09-16 09:01:00', 220),
       (4, '/product/42', 'DE', 'tablet', '2025-09-17 12:00:00', 460);