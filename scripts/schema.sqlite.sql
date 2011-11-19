    -- scripts/schema.sqlite.sql
    --
    -- You will need load your database schema with this SQL.
     
    CREATE TABLE IF NOT EXISTS content (
        id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        title VARCHAR(2500),
        created DATETIME,
        content text,
        content_type text
    );

    CREATE INDEX "content_id" ON "content" ("id");
    CREATE INDEX "content_time" ON "content" ("created");
    CREATE INDEX "content_type" ON "content" ("content_type");

    CREATE TABLE IF NOT EXISTS comments (
        id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        postid INTEGER,
        reply_to_id INTEGER,
        created DATETIME,
        user text,
        url text,
        comment text,
        email text        
    );

    CREATE INDEX "comment_id" ON "comments" ("id");
    CREATE INDEX "comment_time" ON "comments" ("created");

    CREATE TABLE IF NOT EXISTS problems (
       id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
       name VARCHAR(2500),
       created DATETIME,
       uri VARCHAR(2500),
       description text,
       content text,
       code text,
       difficulty INTEGER,
       cuteness INTEGER
    );

    CREATE INDEX "problem_id" ON "problems" ("id");
    CREATE INDEX "problem_time" ON "problems" ("created");

    CREATE TABLE IF NOT EXISTS tags (
       id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
       name VARCHAR(2500),
       description text
    );

    CREATE INDEX "tag_id" ON "tags" ("id");

    CREATE TABLE IF NOT EXISTS tagmap (
       id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
       problem_id INTEGER,
       tag_id INTEGER
    );
              

CREATE TABLE IF NOT EXISTS users (
    id INTEGER NOT NULL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(32) NULL,
    password_salt VARCHAR(32) NULL,
    real_name VARCHAR(150) NULL,
    role VARCHAR(50) NULL
)
