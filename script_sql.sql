create table centrale(
id int unsigned NOT NULL AUTO_INCREMENT,
autor_id int unsigned NOT NULL,
nume varchar(256) NOT NULL,
numar_reactoare int NOT NULL,
putere_reactor float NOT NULL,
altitudine float NOT NULL,
latitudine float NOT NULL,
longitudine float NOT NULL,
primary key (id),
foreign key(autor_id)
references users(id)
);

CREATE TABLE users (
  id int unsigned NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(100) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY username (username),
  UNIQUE KEY email (email)
)