DROP DATABASE IF EXISTS final_web_design;
CREATE DATABASE final_web_design;
ALTER DATABASE final_web_design OWNER TO pgsql_rojo;

CREATE TABLE role_user (
    role_id         SMALLINT NOT NULL PRIMARY KEY,
    role_label      VARCHAR(6) NOT NULL,
    UNIQUE (role_label)
);

CREATE TABLE users (
    user_id         SMALLINT NOT NULL PRIMARY KEY,
    username        VARCHAR(100) NOT NULL,
    first_name      VARCHAR(100) NOT NULL,
    last_name       VARCHAR(100) NOT NULL,
    "password"      VARCHAR(36) NOT NULL,
    "role"          SMALLINT NOT NULL REFERENCES role_user (role_id),
    UNIQUE (username, "password"),
    UNIQUE (username, "role")
);

CREATE TABLE article_category (
    article_category_id     SMALLINT NOT NULL PRIMARY KEY,
    category_label          VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE articles (
    article_id      SMALLSERIAL NOT NULL PRIMARY KEY,
    title           VARCHAR(255) NOT NULL,
    category        SMALLINT NOT NULL REFERENCES article_category (article_category_id),
    picture         TEXT NOT NULL,
    content         TEXT NOT NULL,
    summary         VARCHAR(255) NOT NULL,
    author          SMALLINT NOT NULL REFERENCES users (user_id),
    udpated_on      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
