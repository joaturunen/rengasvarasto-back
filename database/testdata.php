insert into role (title) values
('Toimitusjohtaja'),
('Vuoropäällikkö'),
('Asiakaspalvelija'),
('Hallityöntekijä');

insert into employee (firstname, lastname, phone, email, address, zipcode, city, login, password, role_id) values
('Tuija', 'Toimari', '0401234567', 'tuitoim@rengashotelli.org', 'Toimarikatu 1', '00001', 'Toimarila', 'Toimari', 'salasana', 1),
('Veera', 'Vuorari', '0402234567', 'veevuor@rengashotelli.org', 'Vuorarikatu 2', '00002', 'Vuorarila', 'Vuorari', 'salasana', 2),
('Aapo', 'Aspa', '0403234567', 'aapaspa@rengashotelli.org', 'Asparikatu 3', '00003', 'Asparila', 'Aspari', 'salasana', 3),
('Atte', 'Aspapapapa', '0404234567', 'attaspa@rengashotelli.org', 'Asparikatu 4', '00003', 'Asparila', 'Aspariatte', 'salasana', 4),
('Henna', 'Hallari', '0405234567', 'henhall@rengashotelli.org', 'Hallarikatu 5', '00004', 'Hallarila', 'Hallari', 'salasana', 4),
('Harri', 'Hallimestari', '0406234567', 'harhall@rengashotelli.org', 'Hallarikatu 6', '00004', 'Hallarila', 'Hallaripallari', 'salasana', 4);

insert into customer (firstname, lastname, phone, email, address, zipcode, city, customersaved, employee_id) values
('Martsa', 'Järvis', '0411234567', 'martsa@koulu.org', 'Martsankoti 1', '10001', 'Martsala', '17-11-2021 12:00:00', 2),
('Jontsa', 'Turus', '0412234567', 'jontsa@koulu.org', 'Jontsankämppä 2', '10002', 'Jontsala', '17-11-2021 12:10:10', 3),
('Altsa', 'Luomala', '0413234567', 'altsa@koulu.org', 'Altsankukkula 3', '10003', 'Altsala', '17-11-2021 12:20:20', 2),
('Katsa', 'Mäkis', '0414234567', 'katsa@koulu.org', 'Katsanmäki 4', '10004', 'Katsala', '17-11-2021 12:30:30', 4),
('Hantsa', 'Hirviölä', '0415234567', 'hantsa@koulu.org', 'Hantsankolo 5', '10005', 'Hantsala', '17-11-2021 12:40:40', 4);

insert into order (orderdate, customer_id, employee_id) values
('17-11-2021 12:00:00', 1, 3),
('17-11-2021 12:10:10', 2, 4),
('17-11-2021 12:20:20', 3, 3),
('17-11-2021 12:30:30', 4, 2),
('17-11-2021 12:40:40', 5, 4);

insert into services (service, price) values
('renkaanvaihto', 50),
('kesäsäilytys', 40),
('talvisäilytys', 55),
('renkaanvaihto ja kesäsäil', 80),
('renkaanvaihto ja talvisäi', 95);

insert into order_row (service_id, order_id) values
(4,1), (2,1), (5,2), (1,2), (3,4);


insert into office (name, phone, email, address, zipcode, city, logo) values
('Päätoimipaikka', '0407654321', 'paatoim@rengashotelli.org', 'Rengashotellintie 6', '76543', 'Renkaala', 'logo.jpg'),
('Sivutoimipaikka', '0408654321', 'sivtoim@rengashotelli.org', 'Sivutoimipaikanosoite 5', '76643', 'Sivula', 'logo1.jpg');

insert into warehouse (name, office_id) values
('iso varasto', 1),
('pieni varasto', 1),
('sivu varasto', 2);

insert into shelf (id, warehouse_id) values
(1, 1), (2, 1), (3, 1), (4, 1), (5, 1), (6, 1), (7, 2), (8, 2), (9, 2), (10, 2), (11, 2), (12, 2), (13, 2), (14, 2), (15, 2);

insert into slot (id, shelf_id) values
(1, 1), (2, 1), (3, 1), (4, 1), (5, 2), (6, 2), (7, 2), (8, 2), (9, 3), (10, 3), (11, 3), (12, 3);

insert into car (register, brand, model, customer_id) values
('KGU-848', 'Ferrari', 'Roma', 1),
('PSI-254', 'Lamborghini', 'Diablo', 2),
('LDH-298', 'Maserati', 'Ghibli', 3),
('HGP-379', 'Aston Martin', 'Zagato', 4),
('LOL-666', 'Lada', 'Riva', 5);

insert into tires (car_id, slot_id, brand, model, type, dustrims, groovefl, groovefr, groovebl, groovebr, text, rims, servicedate, info, tiresize, tirebolt) values
(1, 4, 'Firestone', 'etu:215/45ZR17, taka:245/40ZR17', 'kesä', 'ei', 4, 4, 4, 4, 'Renkaat hyvässä kunnossa', 'Maserati x 4', '17-11-2120 13:00:10', '', '20', 'etu:20x8, taka:20x10'),
(2, 1, 'Bridgestone', 'etu:245/35R20, taka:285/35R20', 'talvi', 'ei', 5, 5, 5, 5, 'Renkaat hyvässä kunnossa', 'Ferrari x 4', '17-11-2120 14:20:10', '', '17', 'etu:20x8, taka:20x10'),
(3, 2, 'Michelin', 'etu:245/40R17, taka:335/35R17', 'talvi', 'ei', 5, 5, 5, 5, 'Renkaat hyvässä kunnossa', 'Lamborghini x 4', '17-11-2120 15:40:10', '', '17', 'etu:20x8, taka:20x10'),
(4, 7, 'Goodyear', 'etu:245/40R17, taka:335/35R17', 'kesä', 'ei', 4, 4, 4, 4, 'Renkaat hyvässä kunnossa', 'Aston Martin x 4', '17-11-2120 16:15:10', '', '17', 'etu:20x8, taka:20x10'),
(5, 12, 'Purukumit', '195/32R14', 'kitka', 'ei', 1, 1, 1, 1, 'Renkaat on mukavan sileät, poliisi-setä tykkää', 'ei', '17-11-2120 16:55:10', 'Asiakkaan kannattaisi ostaa uudet renkaat', '14', '10x5');