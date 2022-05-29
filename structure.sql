CREATE TABLE clienti (
    id integer primary key auto_increment,
    email varchar(255) not null unique,
    username varchar(16) not null unique,
    nome varchar(255) not null,
    cognome varchar(255) not null,    
    password varchar(255) not null
) Engine = InnoDB;

CREATE TABLE post (
    id integer primary key auto_increment,
    username VARCHAR(255) not null references clienti(username) on delete cascade on update cascade,
    url VARCHAR(255) NOT NULL,
    nlikes integer default 0,
    ncomments integer default 0
) Engine = InnoDB;

CREATE TABLE likes (
    username VARCHAR(16) not null references clienti(username) on delete cascade on update cascade,
    post varchar(255) not null references post(url) on delete cascade on update cascade,
    primary key(username, post)
) Engine = InnoDB;

CREATE TABLE comments (
    id integer primary key auto_increment references clienti(username) on delete cascade on update cascade,
    username VARCHAR(16) not null,
    post varchar(255) not null references post(url) on delete cascade on update cascade,
    text varchar(255)
) Engine = InnoDB;

INSERT into clienti VALUES(null,'logre.99@hotmail.it', 'lorenzogreco', 'Lorenzo', 'Greco', 'lorenzo99');
INSERT into clienti VALUES(null,'rossi@hotmail.it', 'mariorossi', 'Mario', 'Rossi', 'rossi99');
INSERT into clienti VALUES(null,'bianchi@gmail.com', 'pietrobianchi', 'Pietro', 'Bianchi', 'bianchi99');
INSERT into clienti VALUES(null,'delpiero@gmail.com', 'alessandrodelpiero', 'Alessandro', 'delpiero', 'delpiero10');




INSERT into post(username, url) VALUES('lorenzogreco','https://img.huffingtonpost.com/asset/607d548f260000c21cb40ef0.jpeg?ops=scalefit_630_noupscale');
INSERT into post(username, url) VALUES('pietrobianchi','https://www.attualfoto.it/sites/default/files/styles/blog/public/field/blog/Attualfotoblog_astrazione6.jpg?itok=WFtbOyue');
INSERT into post(username, url) VALUES('alessandrodelpiero','https://www.collater.al/wp-content/uploads/2018/02/Le-illustrazioni-astratte-di-Alessandro-Pautasso-aka-Kaneda-Collater.al-15.jpg');
INSERT into post(username, url) VALUES('mariorossi','https://static.myluxury.it/myluxury/fotogallery/780X0/87221/la-citta-piu-bella-del-mondo-venezia.jpg');
INSERT into post(username, url) VALUES('lorenzogreco','https://i.scdn.co/image/ab67616d0000b273a5087ad003963b4ca75091ef');



DELIMITER //
CREATE TRIGGER likes_trigger
AFTER INSERT ON likes
FOR EACH ROW
BEGIN
UPDATE post
SET nlikes = nlikes + 1
WHERE url = new.post;
END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER unlikes_trigger
AFTER DELETE ON likes
FOR EACH ROW
BEGIN
UPDATE post 
SET nlikes = nlikes - 1
WHERE url = old.post;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER comments_trigger
AFTER INSERT ON comments
FOR EACH ROW
BEGIN
UPDATE post 
SET ncomments = ncomments + 1
WHERE url = new.post;
END //
DELIMITER ;




INSERT into likes(username, post) VALUES('lorenzogreco','https://img.huffingtonpost.com/asset/607d548f260000c21cb40ef0.jpeg?ops=scalefit_630_noupscale');
INSERT into likes(username, post) VALUES('lorenzogreco','https://www.collater.al/wp-content/uploads/2018/02/Le-illustrazioni-astratte-di-Alessandro-Pautasso-aka-Kaneda-Collater.al-15.jpg');
INSERT into likes(username, post) VALUES('lorenzogreco','https://www.attualfoto.it/sites/default/files/styles/blog/public/field/blog/Attualfotoblog_astrazione6.jpg?itok=WFtbOyue');
INSERT into likes(username, post) VALUES('mariorossi','https://i.scdn.co/image/ab67616d0000b273a5087ad003963b4ca75091ef');
INSERT into likes(username, post) VALUES('lorenzogreco','https://i.scdn.co/image/ab67616d0000b273a5087ad003963b4ca75091ef');
INSERT into likes(username, post) VALUES('alessandrodelpiero','https://i.scdn.co/image/ab67616d0000b273a5087ad003963b4ca75091ef');
INSERT into likes(username, post) VALUES('pietrobianchi','https://i.scdn.co/image/ab67616d0000b273a5087ad003963b4ca75091ef');

INSERT into comments(username, post, text) VALUES('pietrobianchi','https://i.scdn.co/image/ab67616d0000b273a5087ad003963b4ca75091ef', 'Bella pizza!' );

INSERT into comments(username, post, text) VALUES('mariorossi','https://i.scdn.co/image/ab67616d0000b273a5087ad003963b4ca75091ef', 'Molto buona' );
