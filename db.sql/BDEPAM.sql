CREATE database epam;
USE epam;

CREATE table category (
id int unsigned primary key auto_increment,
title varchar (255),
time_created timestamp
);
CREATE table products (
id int unsigned primary key auto_increment,
title varchar (255),
content varchar (255),
image varchar (255),
cost varchar (10),
category_id int unsigned,
time_created timestamp,
index category_id (category_id),
foreign key (category_id)
	references category (id)
	on delete cascade
);

CREATE table towns (
id int unsigned primary key auto_increment,
town varchar (255) not null,
time_created timestamp
);

CREATE table users (
id int unsigned primary key auto_increment,
login varchar (255) not null default '',
email varchar (255) unique not null,
town int unsigned,
address varchar (255),
phone varchar (15),
time_created timestamp,
index parent_id (town),
foreign key (town)
	references towns (id)
	on delete cascade
);

CREATE table orders (
id int unsigned primary key auto_increment,
user_id int unsigned,
products varchar (255),
town int unsigned,
address varchar (255),
cost int (6),
count int (5),
time_created timestamp,
index user_id (user_id),
foreign key (user_id)
	references users (id)
	on delete cascade,
index town (town),
foreign key (town)
	references towns (id)
	on delete cascade
);

INSERT INTO `category` (`title`) 
VALUES ('pants'), ('shirts'), ('shoes'), ('shirts'), ('shoes'), ('caps'), ('dress'), ('t-shirts'), ('socks'), ('bags');

INSERT INTO `products` (`title`, `content`, `image`, `cost`, `category_id`)
VALUES 
('pant1', 'white pant', 'photo', '50', '1'),
('shirt1', 'white shirt', 'photo', '30', '2'),
('shoes1', 'black shoes', 'photo', '70', '3'),
('cap', 'white cap', 'photo', '20', '4'),
('dres1', 'white dress', 'photo', '80', '5'),
('t-shirts1', 'white t-shirts', 'photo', '10', '6'),
('shirts1', 'white shirts', 'photo', '54', '7'),
('socks1', 'white socks', 'photo', '34', '8'),
('socks1', 'white socks', 'photo', '5', '9'),
('bags1', 'white bags', 'photo', '51', '10');

INSERT INTO `towns` (`town`) 
VALUES ('Kyiv'), ('Lviv'), ('Odessa'), ('Vinnica'), ('Kherson'), ('Kharkiv'), ('Ternopil'), ('Rivne'), ('Dnipro'), ('Mykolaiv');

INSERT INTO `users` (`login`, `email`, `town`, `address`, `phone`)
VALUES 
('user1', 'user1@gmail', '1', 'street', '+380931111111'),
('user2', 'user2@gmail', '2', 'street', '+380931111111'),
('user3', 'user3@gmail', '3', 'street', '+380931111111'),
('user4', 'user4@gmail', '4', 'street', '+380931111111'),
('user5', 'user5@gmail', '5', 'street', '+380931111111'),
('user6', 'user6@gmail', '6', 'street', '+380931111111'),
('user7', 'user7@gmail', '7', 'street', '+380931111111'),
('user8', 'user8@gmail', '8', 'street', '+380931111111'),
('user9', 'user9@gmail', '9', 'street', '+380931111111'),
('user10', 'user10@gmail', '10', 'street', '+380931111111');

INSERT INTO `orders` (`user_id`, `products`, `town`, `address`, `cost`, `count`)
VALUES 
('1', 'white pant', '1', 'street', '676', '6'),
('2', 'white pant', '2', 'street', '66', '62'),
('3', 'white pant', '3', 'street', '67', '43'),
('4', 'white pant', '4', 'street', '76', '4'),
('5', 'white pant', '5', 'street', '6', '5'),
('6', 'white pant', '6', 'street', '7', '7'),
('7', 'white pant', '7', 'street', '506', '23'),
('8', 'white pant', '8', 'street', '650', '23'),
('9', 'white pant', '9', 'street', '50', '34'),
('10', 'white pant', '10', 'street', '34', '5');



