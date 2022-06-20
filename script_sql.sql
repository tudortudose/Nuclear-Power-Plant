create table power_plants(
id int unsigned NOT NULL AUTO_INCREMENT,
author_id int unsigned NOT NULL,
name varchar(256) NOT NULL unique,
reactorCount int NOT NULL,
reactorPower float NOT NULL,
altitude float NOT NULL,
latitude float NOT NULL,
longitude float NOT NULL,
primary key (id),
foreign key(author_id)
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