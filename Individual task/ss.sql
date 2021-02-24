
create database TodoListDB;
use todolistdb;
create table users(
id int(10) unsigned not null auto_increment,
username varchar(255) not null unique,
email varchar(255) not null,
pasword varchar(255) not null,
primary key (id)
);
create table todo_lists (
id int(10) unsigned not null auto_increment,
user_id int(10) unsigned,
list_name varchar(255) not null,
created_at date,
primary key (id),
foreign key (user_id) references users(id)
);
create table todo_tasks(
id int(10) unsigned not null auto_increment,
user_id int(10) unsigned,
list_id int(10) unsigned,
created_at date,
is_done tinyint(1),
title varchar(255) not null,
primary key (id),
foreign key (user_id) references users(id),
foreign key (list_id) references todo_lists(id)
);
