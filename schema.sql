drop table if exists users;
drop table if exists skin_types;
drop table if exists champions;

create table champion_roles (
	id           int(11)      NOT NULL AUTO_INCREMENT,
	name         varchar(255) NOT NULL,
	date_created datetime     NOT NULL,
	last_updated datetime     NOT NULL,
	PRIMARY KEY (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

create table champions (
	id           int(11)      NOT NULL AUTO_INCREMENT,
	name         varchar(255) NOT NULL,
	title        varchar(255) NOT NULL,
	role_id      int(11)      NOT NULL,
	icon_img_url varchar(255) NULL,
	date_created datetime     NOT NULL,
	last_updated datetime     NOT NULL,
	PRIMARY KEY (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

create table skins (
	id           int(11)      NOT NULL AUTO_INCREMENT,
	champion_id  int(11)      NOT NULL,
	name         varchar(255) NOT NULL,
	img_url      varchar(255) NULL,
	date_created datetime     NOT NULL,
	last_updated datetime     NOT NULL,
	PRIMARY KEY (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

create table users (
	id           int(11)      NOT NULL AUTO_INCREMENT,
	user_name    varchar(255) NOT NULL,
	password     varchar(255) NOT NULL,
	date_created datetime     NOT NULL,
	last_updated datetime     NOT NULL,
	PRIMARY KEY (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

create table user_skin_collection (-- owned
	id           int(11)  NOT NULL AUTO_INCREMENT,
	user_id      int(11)  NOT NULL,
	skin_id      int(11)  NOT NULL,
	date_created datetime NOT NULL,
	PRIMARY KEY (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

create table user_skin_wishlist (
	id           int(11)  NOT NULL AUTO_INCREMENT,
	user_id      int(11)  NOT NULL,
	skin_id      int(11)  NOT NULL,
	date_created datetime NOT NULL,
	PRIMARY KEY (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

create table user_champion (
	id           int(11)  NOT NULL AUTO_INCREMENT,
	user_id      int(11)  NOT NULL,
	champion_id  int(11)  NOT NULL,
	date_created datetime NOT NULL,
	PRIMARY KEY (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

insert into champion_role (name) values ('Assassin');
insert into champion_role (name) values ('Mage');
insert into champion_role (name) values ('Marksman');
insert into champion_role (name) values ('Jungler');

insert into champions (name, role, splash_img_url, date_created, last_updated)
values ('Nocturn', 'Assassin', 'skin1.gif', now(), now());
insert into champions (name, role, splash_img_url, date_created, last_updated)
values ('Morgana', 'Mage', 'skin2.gif', now(), now());
insert into champions (name, role, splash_img_url, date_created, last_updated)
values ('Ashe', 'Marksman', 'skin3.gif', now(), now());
insert into champions (name, role, splash_img_url, date_created, last_updated)
values ('Gankplank', 'Jungler', 'skin4.gif', now(), now());

insert into skins (name, img_url, date_created, last_updated) values ('Alpha', 'skin1.gif', now(), now());
insert into skins (name, img_url, date_created, last_updated) values ('Beta', 'skin2.gif', now(), now());
insert into skins (name, img_url, date_created, last_updated) values ('Gamma', 'skin3.gif', now(), now());
insert into skins (name, img_url, date_created, last_updated) values ('Delta', 'skin4.gif', now(), now());

insert into users (user_name, password, date_created, last_updated) values ('Brandon', 'abcd', now(), now());
insert into users (user_name, password, date_created, last_updated) values ('Jeffrey', 'abcd', now(), now());
insert into users (user_name, password, date_created, last_updated) values ('Lauren', 'abcd', now(), now());

insert into user_skin_collection (user_id, skin_id, date_created)
values (1, 1, now());

insert into user_skin_collection (user_id, skin_id, date_created)
values (1, 2, now());

insert into user_skin_wishlist (user_id, skin_id, date_created)
values (1, 3, now());

insert into user_champion (user_id, champion_id, date_created)
values (1, 3, now());
