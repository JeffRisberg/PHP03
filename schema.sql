drop table if exists orders;
drop table if exists users;
drop table if exists skin_types;

create table skin_types (
	id           int(11)      NOT NULL AUTO_INCREMENT,
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

insert into skin_types (name, img_url, date_created, last_updated) values ('Alpha', 'skin1.gif', now(), now());
insert into skin_types (name, img_url, date_created, last_updated) values ('Beta', 'skin2.gif', now(), now());
insert into skin_types (name, img_url, date_created, last_updated) values ('Gamma', 'skin3.gif', now(), now());
insert into skin_types (name, img_url, date_created, last_updated) values ('Delta', 'skin4.gif', now(), now());


insert into users (user_name, password, date_created, last_updated) values ('Brandon', 'abcd', now(), now());
insert into users (user_name, password, date_created, last_updated) values ('Jeffrey', 'abcd', now(), now());
insert into users (user_name, password, date_created, last_updated) values ('Lauren', 'abcd', now(), now());
