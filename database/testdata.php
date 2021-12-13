insert into role (title) values
('Toimitusjohtaja'),
('Vuoropäällikkö'),
('Asiakaspalvelija'),
('Hallityöntekijä');

insert into employee (firstname, lastname, phone, email, address, zipcode, city, login, password, role_id) values
('Tuija', 'Toimari', '0401234567', 'tuitoim@rengashotelli.org', 'Toimarikatu 1', '00001', 'Toimarila', 'Toimari', 'salasana', 1),
('Veera', 'Vuorari', '0402234567', 'veevuor@rengashotelli.org', 'Vuorarikatu 2', '00002', 'Vuorarila', 'Vuorari', 'salasana', 2),
('Aapo', 'Aspa', '0403234567', 'aapaspa@rengashotelli.org', 'Asparikatu 3', '00003', 'Asparila', 'Aspari', 'salasana', 3),
('Atte', 'Aspapapapa', '0404234567', 'attaspa@rengashotelli.org', 'Asparikatu 4', '00003', 'Asparila', 'Aspariatte', 'salasana', 3),
('Henna', 'Hallari', '0405234567', 'henhall@rengashotelli.org', 'Hallarikatu 5', '00004', 'Hallarila', 'Hallari', 'salasana', 4),
('Harri', 'Hallimestari', '0406234567', 'harhall@rengashotelli.org', 'Hallarikatu 6', '00004', 'Hallarila', 'Hallaripallari', 'salasana', 4);

insert into customer (firstname, lastname, phone, email, address, zipcode, city, employee_id) values
('Martsa', 'Järvis', '0411234567', 'martsa@koulu.org', 'Martsankoti 1', '10001', 'Martsala', 2),
('Jontsa', 'Turus', '0412234567', 'jontsa@koulu.org', 'Jontsankämppä 2', '10002', 'Jontsala', 3),
('Altsa', 'Luomala', '0413234567', 'altsa@koulu.org', 'Altsankukkula 3', '10003', 'Altsala', 2),
('Katsa', 'Mäkis', '0414234567', 'katsa@koulu.org', 'Katsanmäki 4', '10004', 'Katsala', 4),
('Hantsa', 'Hirviölä', '0415234567', 'hantsa@koulu.org', 'Hantsankolo 5', '10005', 'Hantsala', 4);

insert into orders (customer_id, employee_id) values
(1, 3),
(2, 4),
(3, 3),
(4, 5),
(5, 4),
(3, 3),
(3, 4),
(3, 5);

insert into category (name) values
('kausisäilytys'),
('palvelu');

insert into services (service, price, category_id) values
('renkaanvaihto', 49.99, 2),
('renkaiden pesu', 10.50, 2),
('renkaiden tasopainotus', 10.50, 2);

insert into services (service, price, category_id, season) values
('kesäsäilytys', 39.99, 1 , 'kesä'),
('talvisäilytys', 55.00, 1, 'talvi'),
('renkaanvaihto ja kesäsäilytys', 80.00, 1, 'kesä'),
('renkaanvaihto ja talvisäilytys', 95.00, 1, 'talvi');

insert into ordertable (orders_id, services_id) values
(1, 4), (2, 2), (3, 5), (4, 1), (5, 3), (6, 3), (7, 4), (8, 4);

insert into car (register, brand, model, customer_id) values
('KGU-848', 'Ferrari', 'Roma', 1),
('PSI-254', 'Lamborghini', 'Diablo', 3),
('LDH-298', 'Maserati', 'Ghibli', 5),
('HGP-379', 'Aston Martin', 'Zagato', 2),
('LOL-666', 'Lada', 'Riva', 4),
('TES-123', 'Tesla', 'S', 3),
('AOR-999', 'Alfa Romeo', 'Scighera', 3),
('VEC-1', 'Vector', 'W8', 3);

insert into tires (car_id, brand, model, type, hubcups, groovefl, groovefr, groovebl, groovebr, tiresize, tirebolt, text, rims, servicedate, info) values
(1,'Firestone', 'etu:215/45ZR17, taka:245/40ZR17', 'kesä', true, 4, 4, 4, 4, 17, 'etu:5x15, taka 5x20', 'Renkaat hyvässä kunnossa', 'Maserati x 4', '17-11-2120 13:00:10', ''),
(2,'Bridgestone', 'etu:245/35R20, taka:285/35R20', 'talvi', true, 5, 5, 5, 5, 20, 'etu:5x15, taka 5x20', 'Renkaat hyvässä kunnossa', 'Ferrari x 4', '17-11-2120 14:20:10', ''),
(3,'Michelin', 'etu:245/40R17, taka:335/35R17', 'talvi', true, 5, 5, 5, 5, 17, 'etu:5x15, taka 5x20', 'Renkaat hyvässä kunnossa', 'Lamborghini x 4', '17-11-2120 15:40:10', ''),
(4,'Goodyear', 'etu:245/40R17, taka:335/35R17', 'kesä', true, 4, 4, 4, 4, 17, 'etu:5x15, taka 5x20', 'Renkaat hyvässä kunnossa', 'Aston Martin x 4', '17-11-2120 16:15:10', ''),
(5, 'Purukumit', '195/32R14', 'kitka', false, 1, 1, 1, 1, 14, '5x10', 'Renkaat on mukavan sileät, poliisi-setä tykkää', 'Latukkax4', '17-11-2120 16:55:10', 'Asiakkaan kannattaisi ostaa uudet renkaat'),
(6, 'Tulikivi', 'etu:245/40R17, taka:335/35R17', 'kesä', true, 6, 3.5, 6, 4, 17, 'etu:5x18, taka 5x20', 'Renkaat are noice!', 'Tesla x 4', '30-11-2120 18:55:10', 'Sähköpirssin renkaat ei toimi sähköllä'),
(7, 'Siltakivi', 'etu:245/40R17, taka:335/35R17', 'talvi', true, 5, 3.3, 5, 3.2, 19, 'etu:5x15, taka 5x20', 'Renkaat toispuoleiset', 'Alfa Romeo x 4', '01-12-2120 07:15:10', 'Ei kannata mennä mutkiin ovi eellä'),
(8, 'Hyvävuosi', 'etu:245/40R17, taka:335/35R17', 'kitka', true, 2.2, 2.2, 5, 3.2, 19, 'etu:5x15, taka 5x20', 'Marketeilla rallattu', 'Vector x 4', '02-12-2120 03:00:10', 'Mukava vaihtaa renkaita näin kolmelta aamuyöstä');

UPDATE slot_order SET tires_id = 1 WHERE slot_id = 13;
UPDATE slot_order SET tires_id = 2 WHERE slot_id = 14; 
UPDATE slot_order SET tires_id = 3 WHERE slot_id = 3; 
UPDATE slot_order SET tires_id = 4 WHERE slot_id = 200; 
UPDATE slot_order SET tires_id = 5 WHERE slot_id = 150; 
