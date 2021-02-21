use epam;
SELECT login FROM users;

SELECT * FROM products GROUP BY title;

SELECT * FROM users WHERE id=3;

SELECT * FROM products WHERE title='socks1' HAVING cost <= 50;

SELECT * FROM orders WHERE town = ( SELECT id FROM towns WHERE id = 4 );

SELECT `id`, `title` FROM category order by title DESC;

SELECT * FROM orders JOIN category ON orders.id = category.id WHERE orders.id > 5;

SELECT * FROM orders RIGHT JOIN category ON orders.id = category.id;

SELECT * FROM orders;

DELETE FROM orders WHERE id=10;

SELECT COUNT(DISTINCT id) FROM orders;

SELECT cost, AVG(count) FROM orders GROUP BY cost;

UPDATE `orders` SET `products`='qwerty' WHERE id = 3;

SELECT *
FROM orders LEFT JOIN towns ON orders.cost = towns.id
UNION
SELECT *
FROM orders RIGHT JOIN towns ON orders.cost = towns.id;