drop table if exists news;
drop table if exists user_friend_request;
drop table if exists user_friend;
drop table if exists friend_request_status;
drop table if exists user_champion;
drop table if exists user_skin_collection;
drop table if exists users;
drop table if exists skins;
drop table if exists champions;
drop table if exists champion_roles;
drop table if exists visibility_settings;

create table visibility_settings (
	id           int(11)      NOT NULL AUTO_INCREMENT,
	name         varchar(255) NOT NULL,
	date_created datetime     NOT NULL,
	last_updated datetime     NOT NULL,
	PRIMARY KEY (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

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
	PRIMARY KEY (id),
	FOREIGN KEY (role_id) REFERENCES champion_roles (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

create table skins (
	id           int(11)      NOT NULL AUTO_INCREMENT,
	champion_id  int(11)      NOT NULL,
	is_default   bit(1)       NOT NULL,
	name         varchar(255) NOT NULL,
	img_url      varchar(255) NULL,
	date_created datetime     NOT NULL,
	last_updated datetime     NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (champion_id) REFERENCES champions (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

create table users (
	id           int(11)      NOT NULL AUTO_INCREMENT,
	user_name    varchar(255) NOT NULL,
	password     varchar(255) NOT NULL,
	avatar_img   varchar(255) NULL,
	visibility   int(11)      NOT NULL,
	is_admin     bit(1)       NOT NULL,
	last_login   datetime     NULL,
	date_created datetime     NOT NULL,
	last_updated datetime     NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (visibility) REFERENCES visibility_settings (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

create table user_skin_collection (-- owned
	id               int(11)  NOT NULL AUTO_INCREMENT,
	user_id          int(11)  NOT NULL,
	skin_id          int(11)  NOT NULL,
	ownership_status varchar(50), -- Owned, Wih List, ect
	date_created     datetime NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES users (id),
	FOREIGN KEY (skin_id) REFERENCES skins (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

create table user_champion (
	id           int(11)  NOT NULL AUTO_INCREMENT,
	user_id      int(11)  NOT NULL,
	champion_id  int(11)  NOT NULL,
	date_created datetime NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES users (id),
	FOREIGN KEY (champion_id) REFERENCES champions (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

create table friend_request_status (
	id   INT(11)     NOT NULL AUTO_INCREMENT,
	name VARCHAR(55) NOT NULL,
	PRIMARY KEY (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1;

create table user_friend (
	user_id   int(11) NOT NULL,
	friend_id int(11) NOT NULL,
  date_created datetime NOT NULL,
	PRIMARY KEY (user_id, friend_id),
	FOREIGN KEY (user_id) REFERENCES users (id),
	FOREIGN KEY (friend_id) REFERENCES users (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1;

create table user_friend_request (
  user_id   int(11) NOT NULL,
  friend_id int(11) NOT NULL,
  status_id int(11) NOT NULL,
  date_created datetime NOT NULL,
  last_updated datetime NOT NULL,
  PRIMARY KEY (user_id, friend_id),
  FOREIGN KEY (user_id) REFERENCES users (id),
  FOREIGN KEY (friend_id) REFERENCES users (id),
  FOREIGN KEY (status_id) REFERENCES friend_request_status (id)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =latin1;

create table news (
	id           int(11)  NOT NULL AUTO_INCREMENT,
	message      text     NOT NULL,
	champion_id  int(11)  NULL,
	skin_id      int(11)  NULL,
	date_created datetime NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (champion_id) REFERENCES champions (id),
	FOREIGN KEY (skin_id) REFERENCES skins (id)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =latin1
	AUTO_INCREMENT =1;

insert into visibility_settings (id, name) values (1, 'Public');
insert into visibility_settings (id, name) values (2, 'Private');
insert into visibility_settings (id, name) values (3, 'Friends');

insert into champion_roles (id, name) values (1, 'Assassin');
insert into champion_roles (id, name) values (2, 'Mage');
insert into champion_roles (id, name) values (3, 'Marksman');
insert into champion_roles (id, name) values (4, 'Jungler');

insert into champions (id, name, title, role_id, icon_img_url, date_created, last_updated)
values
	(1, 'Nocturn', 'the Eternal Nightmare', 1, 'http://www.mobafire.com/images/champion/icon/nocturne.png', now(), now());
insert into champions (id, name, title, role_id, icon_img_url, date_created, last_updated)
values (2, 'Morgana', 'the Fallen Angel', 2, 'http://www.mobafire.com/images/champion/icon/morgana.png', now(), now());
insert into champions (id, name, title, role_id, icon_img_url, date_created, last_updated)
values (3, 'Ashe', 'the Frost Archer', 3, 'http://www.mobafire.com/images/champion/icon/ashe.png', now(), now());
insert into champions (id, name, title, role_id, icon_img_url, date_created, last_updated)
values (4, 'Gankplank', 'the Saltwater Scourge', 4, 'http://www.mobafire.com/images/champion/icon/gangplank.png', now(),
				now());
insert into champions (id, name, title, role_id, icon_img_url, date_created, last_updated)
values (5, 'Vi', 'the Piltover Enforcer', 4, 'http://www.mobafire.com/images/champion/icon/vi.png', now(), now());
insert into champions (id, name, title, role_id, icon_img_url, date_created, last_updated)
values
	(6, 'Varus', 'the Arrow of Retribution', 3, 'http://www.mobafire.com/images/champion/icon/varus.png', now(), now());
insert into champions (id, name, title, role_id, icon_img_url, date_created, last_updated)
values
	(7, 'Jarvan IV', 'the Exemplar of Demacia', 4, 'http://www.mobafire.com/images/champion/icon/jarvan-iv.png', now(),
	 now());
insert into champions (id, name, title, role_id, icon_img_url, date_created, last_updated)
values
	(8, 'Kalista', 'the Spear of Vengence', 3, 'http://www.mobafire.com/images/champion/icon/kalista.png', now(), now());

insert into skins (id, name, champion_id, is_default, img_url, date_created, last_updated)
values (1, 'Classic', 2, false,
				'http://img4.wikia.nocookie.net/__cb20120912044527/leagueoflegends/images/thumb/a/a5/Morgana_OriginalSkin.jpg/1080px-Morgana_OriginalSkin.jpg',
				now(), now());
insert into skins (id, name, champion_id, is_default, img_url, date_created, last_updated)
values (2, 'Exiled Morgana', 2, true,
				'http://img2.wikia.nocookie.net/__cb20110112020357/leagueoflegends/images/thumb/f/f8/Morgana_ExiledSkin.jpg/1080px-Morgana_ExiledSkin.jpg',
				now(), now());
insert into skins (id, name, champion_id, is_default, img_url, date_created, last_updated)
values (3, 'Blade Mistress Morgana', 2, false, 'skin1.gif', now(), now());
insert into skins (id, name, champion_id, is_default, img_url, date_created, last_updated)
values (4, 'Sinful Succulence Morgana', 2, false, 'skin1.gif', now(), now());
insert into skins (id, name, champion_id, is_default, img_url, date_created, last_updated)
values (5, 'Blackthorn Morgana', 2, false, 'skin1.gif', now(), now());
insert into skins (id, name, champion_id, is_default, img_url, date_created, last_updated)
values (6, 'Ghost Bride Morgana', 2, false, 'skin1.gif', now(), now());
insert into skins (id, name, champion_id, is_default, img_url, date_created, last_updated)
values (7, 'Victorious Morgana', 2, false, 'skin1.gif', now(), now());
insert into skins (id, name, champion_id, is_default, img_url, date_created, last_updated)
values (8, 'Classic', 1, true, 'skin2.gif', now(), now());
insert into skins (id, name, champion_id, is_default, img_url, date_created, last_updated)
values (9, 'Frozen Terror Nocturn', 1, false, 'skin3.gif', now(), now());
insert into skins (id, name, champion_id, is_default, img_url, date_created, last_updated)
values (10, 'Void', 1, false, 'skin4.gif', now(), now());

insert into users (user_name, password, visibility, is_admin, last_login, date_created, last_updated)
values ('Brandon', '$2y$10$R7A7s0PWE6fQBKm66oWdQO1c4xOmYPm2ETDMwCGr9D6PXo7il/uey', 1, true, '2014-11-27 14:23:45',
				'2014-11-06 14:23:45', '2014-11-28 09:55:45');
insert into users (user_name, password, avatar_img, visibility, is_admin, last_login, date_created, last_updated)
values ('Jeffrey', '$2y$10$R7A7s0PWE6fQBKm66oWdQO1c4xOmYPm2ETDMwCGr9D6PXo7il/uey', 'jeff.jpg', 1, false,
				'2014-11-26 22:09:44', '2014-11-12 22:09:44', '2014-11-27 12:32:34');
insert into users (user_name, password, visibility, is_admin, last_login, date_created, last_updated)
values ('Lauren', '$2y$10$R7A7s0PWE6fQBKm66oWdQO1c4xOmYPm2ETDMwCGr9D6PXo7il/uey', 2, false, '2014-11-02 02:44:23',
				'2014-10-30 02:44:09', '2014-11-03 20:06:32');

insert into user_skin_collection (user_id, skin_id, ownership_status, date_created)
values (1, 1, 'collected', now());
insert into user_skin_collection (user_id, skin_id, ownership_status, date_created)
values (1, 2, 'collected', now());
insert into user_skin_collection (user_id, skin_id, ownership_status, date_created)
values (1, 3, 'wished', now());

insert into user_champion (user_id, champion_id, date_created)
values (1, 3, now());
insert into user_champion (user_id, champion_id, date_created)
values (1, 4, now());
insert into user_champion (user_id, champion_id, date_created)
values (2, 3, now());
insert into user_champion (user_id, champion_id, date_created)
values (2, 2, now());
insert into user_champion (user_id, champion_id, date_created)
values (3, 3, now());

insert into friend_request_status (id, name) values (1, 'requested');
insert into friend_request_status (id, name) values (2, 'confirmed');

insert into user_friend (user_id, friend_id, date_created) values (2, 3, now());
insert into user_friend (user_id, friend_id, date_created) values (3, 2, now());

insert into user_friend_request (user_id, friend_id, status_id, date_created, last_updated) values (2, 3, 2, now(), now());
insert into user_friend_request (user_id, friend_id, status_id, date_created, last_updated) values (2, 1, 1, now(), now());
insert into user_friend_request (user_id, friend_id, status_id, date_created, last_updated) values (3, 1, 1, now(), now());

insert into news (id, message, date_created)
values (1, 'The Skin Shop is now open.', '2014-11-01');
insert into news (id, message, date_created)
values (2, 'This site gives you the most current information about League of Legends skins!', '2014-11-14');
insert into news (id, message, champion_id, date_created)
values (3, 'Please check out the updated Diana champion', 3, '2014-11-23');
insert into news (id, message, champion_id, skin_id, date_created)
values (4, 'There is a new skin available for Diana', 3, 2, '2014-11-25');
insert into news (id, message, date_created)
values (5,
				'During battle days, you can buy the best league-tested skins at discount rates.  Check us now, and buy before 11/30/14!',
				'2014-11-26');

