CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE IF NOT EXISTS users
(
    id        UUID         NOT NULL DEFAULT (uuid_generate_v4()),
    full_name VARCHAR(255) NOT NULL,
    email     VARCHAR(255) NOT NULL,
    username  CHAR(20)     NOT NULL,
    password  CHAR(32)     NOT NULL,
    is_admin  BOOLEAN      NOT NULL DEFAULT FALSE,
    PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS scores
(
    id                         UUID NOT NULL DEFAULT (uuid_generate_v4()),
    user_id                    UUID NOT NULL,
    articulate_requirements    INT  NOT NULL,
    appropriate_tools          INT  NOT NULL,
    coherent_oral_presentation INT  NOT NULL,
    functioned_as_team         INT  NOT NULL,
    comments                   TEXT NOT NULL,
    total_score                INT  NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users (id)
);

SELECT *
FROM scores;

SELECT *
FROM users;