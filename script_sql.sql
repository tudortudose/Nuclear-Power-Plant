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
);

CREATE TABLE configurations (
  id int NOT NULL AUTO_INCREMENT,
  id_centrala int unsigned DEFAULT NULL,
  reactoare_active int DEFAULT NULL,
  temperatura_nucleu int DEFAULT NULL,
  putere_racire int DEFAULT NULL,
  putere_produsa int DEFAULT NULL,
  putere_ceruta int DEFAULT NULL,
  vreme varchar(150) DEFAULT NULL,
  data_examinare datetime DEFAULT NULL,
  putere_energie int DEFAULT NULL,
  PRIMARY KEY (id),
  KEY id_centrala (id_centrala),
  CONSTRAINT configurations_ibfk_1 FOREIGN KEY (id_centrala) REFERENCES power_plants (id) ON DELETE CASCADE
);

CREATE TABLE `pp_states` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_centrala` int unsigned DEFAULT NULL,
  `putere_racire` int DEFAULT NULL,
  `putere_energie` int DEFAULT NULL,
  `temperatura_nucleu` int DEFAULT NULL,
  `putere_ceruta` int DEFAULT NULL,
  `putere_produsa` int DEFAULT NULL,
  `reactoare_active` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_centrala` (`id_centrala`),
  CONSTRAINT `pp_states_ibfk_1` FOREIGN KEY (`id_centrala`) REFERENCES `power_plants` (`id`) ON DELETE CASCADE
)