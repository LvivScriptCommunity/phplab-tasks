SELECT name, amount FROM medicines WHERE amount > 25 ORDER BY amount;

SELECT COUNT(name) FROM medicines WHERE amount > 50;

SELECT nameDiseases FROM  diseases
UNION
SELECT name FROM medicines

SELECT name, amount FROM medicines
WHERE amount > (SELECT AVG(amount) FROM medicines) ORDER BY amount;

SELECT patients.firstName, patients.lastName AS patients, medicines.name, medicines.amount AS medicines, diseases.name AS diseases
FROM models
         LEFT JOIN medicines ON medicines.diseasesId = medicines.id
         LEFT JOIN diseases ON medicines.manufacturer_id = diseases.id
ORDER BY medicines.name;