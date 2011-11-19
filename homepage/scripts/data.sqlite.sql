    -- scripts/data.sqlite.sql
    --
    -- You can begin populating the database with the following SQL statements.
     
    INSERT INTO guestbook (email, comment, created) VALUES
        ('ralph.schindler@zend.com',
        'Hello! Hope you enjoy this sample zf application!',
        DATETIME('NOW'));
    INSERT INTO guestbook (email, comment, created) VALUES
        ('foo@bar.com',
        'Baz baz baz, baz baz Baz baz baz - baz baz baz.',
        DATETIME('NOW'));
    INSERT INTO guestbook (email, comment, created) VALUES
        ('hoohho@bar.com',
        'Baz baz baz, baz baz Baz baz baz - baz baz baz.',
        DATETIME('NOW'));

    INSERT INTO content (title,content,content_type,created) VALUES
         ('First post',
         'Blah blah! Baaa baa! Black sheep! Have you any wool?!',
         'blogpost',
         DATETIME('NOW'));