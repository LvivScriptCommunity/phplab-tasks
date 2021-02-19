
CREATE DATABASE IF NOT EXISTS `epam` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `epam`;

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_add` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL,
  `model` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


INSERT IGNORE INTO `product` (`product_id`, `date_add`, `date_update`, `status`, `model`) VALUES
(1, '2021-02-18 13:32:33', '2021-02-18 13:32:33', 1, '213451'),
(2, '2021-02-18 13:32:47', '2021-02-18 13:32:47', 1, '54321'),
(3, '2021-02-18 13:32:58', '2021-02-18 13:32:58', 1, '87654'),
(4, '2021-02-18 13:33:37', '2021-02-18 13:33:37', 1, '58278'),
(5, '2021-02-18 13:33:37', '2021-02-18 13:33:37', 1, '45691');


CREATE TABLE IF NOT EXISTS `product_description` (
  `product_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  UNIQUE KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT IGNORE INTO `product_description` (`product_id`, `title`, `meta_title`, `meta_description`, `description`, `image`) VALUES
(1, 'test1', 'test1', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'no-image.png'),
(2, 'test2', 'test2', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'no-image.png'),
(3, 'test3', 'test3', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'no-image.png'),
(4, 'test4', 'test4', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'no-image.png'),
(5, 'test5', 'test5', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'no-image.png');


CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('admin','manager','smm','operator') NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


INSERT IGNORE INTO `user` (`user_id`, `role`, `password`, `salt`, `status`) VALUES
(1, 'admin', '*9106525D164D5491E228529812EF651CC4334CF2', '15', 1),
(2, 'manager', '*BD667D10964D14CC0568104E134363B13B5D06CD', '234', 1),
(3, 'operator', '*5D9AEE2EA7F4D8553289E85EF6F46A781A44B1F9', '589', 1),
(4, 'smm', '*C73725411B7005C65D445641947B78B94523647D', '879', 1);


CREATE TABLE IF NOT EXISTS `user_description` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT current_timestamp(),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT IGNORE INTO `user_description` (`user_id`, `firstname`, `lastname`, `email`, `date_add`) VALUES
(1, 'Sergiy', 'Iunash', 'test1@gmail.com', '2021-02-17 22:00:00'),
(2, 'Andriy', 'Ivanyk', 'test2@gmail.com', '2021-02-17 22:00:00'),
(3, 'Eugen', 'Petchenko', 'test3gmail.com', '2021-02-18 13:30:18'),
(4, 'Maks', 'Ignatchenko', 'test4@gmail.com', '2021-02-18 13:30:47');

ALTER TABLE `product_description`
  ADD CONSTRAINT `product_description_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);


ALTER TABLE `user_description`
  ADD CONSTRAINT `user_description_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);


SELECT * FROM user as u JOIN user_description as ud WHERE u.user_id = ud.user_id;
SELECT u.user_id, ud.firstname, ud.lastname, u.role, ud.date_add FROM user as u JOIN user_description as ud WHERE u.user_id = ud.user_id GROUP BY u.user_id;

UPDATE `user` SET `status`=0 WHERE `user_id` = 3;
SELECT * FROM `user` WHERE `status` = 1;
SELECT * FROM `user` WHERE `role` = "admin";
SELECT * FROM `user` LIMIT 0, 2;
SELECT COUNT(*) FROM `user`;
SELECT COUNT(*) FROM `user` WHERE `status` = 1;
SELECT * FROM `user` ORDER BY user_id DESC;


ALTER TABLE `users` AUTO_INCREMENT = 1
SELECT count(*) FROM `oc_order` WHERE date_added BETWEEN '2018-12-26 00:00:00' AND '2018-12-26 10:27:47'
TRUNCATE TABLE developers_copy;
SELECT
    `seo_url_id`, `query`, COUNT(`query`)
FROM
    `oc_seo_url`
GROUP BY
    `seo_url_id`, `query`
HAVING
        COUNT(`query`) > 1

DELETE FROM `oc_product_description` WHERE `product_id` IN (SELECT `product_id` FROM `oc_product` WHERE `model` LIKE "%sk%")

SELECT`language_id`,`keyword`,COUNT(`keyword`)FROM`oc_customer_search`GROUPBY`language_id`,`keyword`ORDERBYCOUNT(`keyword`)DESC

sed 's/ENGINE=MyISAM/ENGINE=InnoDB/g' new_zoo.14.08.2019.sql > new_zoo.14.08.2019_INNODB.sql

SELECT oc_product_to_category.product_id, oc_product_description.name, oc_product_to_category.category_id, oc_category_description.name, COUNT( DISTINCT oc_product_to_category.category_id )
FROM oc_product_to_category
         JOIN oc_category_description ON oc_category_description.category_id = oc_product_to_category.category_id
         JOIN oc_product_description ON oc_product_description.product_id = oc_product_to_category.product_id
GROUP BY`product_id`
HAVING COUNT( DISTINCT oc_product_to_category.category_id ) =1
ORDER BY`oc_category_description`.`name` ASC

UPDATE `oc_mfilter_url_alias` SET `alias` = CONCAT("ua-", `alias`) WHERE `language_id` = 2

    $sql = 'SELECT table1.`order_id`,table2.product_id,table2.name,table2.model,table2.quantity,table2.price,table2.total FROM `oc_order` as table1 LEFT JOIN `oc_order_product` as table2 ON table1.`order_id` = table2.`order_id` WHERE `email` = "sales@petz.com.ua"';

SELECT * FROM oc_product p WHERE p.product_id NOT IN (SELECT pd.product_id FROM oc_product_description pd)


SELECTCOUNT(*)FROMoc_orderocoWHEREoco.order_idNOTIN(SELECTocot.order_idFROMoc_order_totalocotWHEREocot.`code`='coupon')ANDoco.order_status_id!=0

SELECT COUNT(*) FROM oc_order oco WHERE oco.order_id IN (SELECT ocot.order_id FROM oc_order_total ocot WHERE ocot.`code` = 'coupon') AND oco.order_status_id != 0

UPDATE `oc_product_attribute` SET `attribute_id`= 452 WHERE `attribute_id` = 516
UPDATE `oc_product_attribute` SET `attribute_id`= 33 WHERE `attribute_id` = 22 OR `attribute_id` = 1

SELECT c.customer_id,c.firstname,c.lastname,c.telephone,c.email,c.customer_group_id,c.status,cgd.name FROM `oc_customer` AS c INNER JOIN `oc_customer_group_description` AS cgd ON c.customer_group_id= cgd.customer_group_id GROUP BY c.email ORDER BY c.customer_id ASC

DELETE FROM `ttn_info` WHERENOW()> `date_delete`

UPDATE `oc_product_attribute` SET `text`="Універсальний" WHERE `attribute_id` = 489 AND `language_id` = 2 AND `text` = "Универсальный"


SELECT c.customer_id,c.firstname,c.lastname,c.telephone,c.email,c.customer_group_id,c.status,cgd.name,c_order.order_id,c_order.order_status_id FROM `oc_customer` AS c INNER JOIN `oc_customer_group_description`
    AS cgd ON c.customer_group_id= cgd.customer_group_id INNER JOIN `oc_order` AS c_order ON c.email = c_order.email GROUP BY c_order.order_idid INNER JOIN `oc_order` AS c_order ON c.email = c_order.email GROUP BY c_order.order_id
ORDER BY `c`.`firstname` ASC

SELECT * FROM `oc_attribute`
                  INNER JOIN `oc_attribute_group_description` ON `oc_attribute`.`attribute_group_id` = `oc_attribute_group_description`.`attribute_group_id`
                  INNER JOIN `oc_attribute_description` ON `oc_attribute`.`attribute_id` = `oc_attribute_description`.`attribute_id` GROUP BY `oc_attribute`.`attribute_id` ORDER BY `oc_attribute_description`.`name` ASC

SELECTocc.`customer_id`,occ.`email`,occ.`telephone`,oco.order_id,ocop.*,ocptc.*,occd.name,occgd.nameasgroup_nameFROM`oc_customer`asoccINNERJOIN`oc_order`asocoONoco.`customer_id`=occ.`customer_id`INNERJOIN`oc_order_product`asocopONocop.order_id=oco.order_idINNERJOIN`oc_product_to_category`asocptcONocop.product_id=ocptc.product_idINNERJOIN`oc_category_description`asoccdONoccd.category_id=ocptc.category_idINNERJOIN`oc_customer_group_description`asoccgdONoccgd.customer_group_id=occ.customer_group_idWHEREoco.order_status_id>0GROUPBYocptc.category_id
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
SELECT COUNT(*) FROM `oc_order` WHERE `date_added` BETWEEN "2020-01-01" AND "2020-01-31" AND `order_status_id` !=0 AND `email` = "sales@petz.com.ua"
