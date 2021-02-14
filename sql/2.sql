# Select models with price from 30000 till 70000
SELECT name, price FROM models WHERE price BETWEEN 30000 AND 70000 ORDER BY price;

# Select count of models with price more then 70000
SELECT COUNT(name) AS vip_cars FROM models WHERE price > 70000;

# Select makes name, models name and price with sorting by make name and price
SELECT makes.name, models.name, models.price
FROM models
         LEFT JOIN makes ON models.make_id = makes.id
ORDER BY makes.name, models.price;

# Select makes name, models name, manufacturer and price with sorting by make
SELECT makes.name AS Make, models.name AS Model, models.price, manufacturers.name AS Manufacturer
FROM models
         LEFT JOIN makes ON models.make_id = makes.id
         LEFT JOIN manufacturers ON makes.manufacturer_id = manufacturers.id
ORDER BY makes.name;

# Select name and price from table "models" with price more then average price
SELECT name, price
FROM models
WHERE price > (SELECT AVG(price) FROM models)
ORDER BY price;

# Select manufacturer's name and total cost of every manufacturer's cars with sorting by manufacturer's name
SELECT manufacturers.name AS Manufacturer, SUM(models.price) AS Total_Cost
FROM models
         LEFT JOIN makes ON models.make_id = makes.id
         LEFT JOIN manufacturers ON makes.manufacturer_id = manufacturers.id
GROUP BY manufacturers.id
ORDER BY manufacturers.name;

# Select data from column "name" of all tables
SELECT name FROM manufacturers
UNION
SELECT name FROM makes
UNION
SELECT name FROM models;