insert into role (title) values
('Toimitusjohtaja'),
('Vuoropäällikkö'),
(Asiakaspalvelija'),
('Hallityöntekijä');

insert into employee (firstname, lastname, phone, email, address, zipcode, city, login, password, role_id) values
('Tuija', 'Toimari', '0401234567', 'tuitoim@rengashotelli.org', 'Toimarikatu 1', '00001', 'Toimarila', 'Toimari', 'salasana', 1),
('Veera', 'Vuorari', '0402234567', 'veevuor@rengashotelli.org', 'Vuorarikatu 2', '00002', 'Vuorarila', 'Vuorari', 'salasana', 2),
('Aapo', 'Aspa', '0403234567', 'aapaspa@rengashotelli.org', 'Asparikatu 3', '00003', 'Asparila', 'Aspari', 'salasana', 3),
('Atte', 'Aspapapapa', '0404234567', 'attaspa@rengashotelli.org', 'Asparikatu 4', '00003', 'Asparila', 'Aspariatte', 'salasana', 4),
('Henna', 'Hallari', '0405234567', 'henhall@rengashotelli.org', 'Hallarikatu 5', '00004', 'Hallarila', 'Hallari', 'salasana', 5),
('Harri', 'Hallimestari', '0406234567', 'harhall@rengashotelli.org', 'Hallarikatu 6', '00004', 'Hallarila', 'Hallaripallari', 'salasana', 6);

insert into customer (id, firstname, lastname, phone, email, address, zipcode, city, customersaved, employee_id) values
('Martsa', 'Järvis', '0411234567', 'martsa@koulu.org', 'Martsankoti 1', '10001', 'Martsala', '17-11-2021 12:00:00', 2),
('Jontsa', 'Turus', '0412234567', 'jontsa@koulu.org', 'Jontsankämppä 2', '10002', 'Jontsala', '17-11-2021 12:10:10', 3),
('Altsa', 'Luomala', '0413234567', 'altsa@koulu.org', 'Altsankukkula 3', '10003', 'Altsala', '17-11-2021 12:20:20', 2),
('Katsa', 'Mäkis', '0414234567', 'katsa@koulu.org', 'Katsanmäki 4', '10004', 'Katsala', '17-11-2021 12:30:30', 4),
('Hantsa', 'Hirviölä', '0415234567', 'hantsa@koulu.org', 'Hantsankolo 5', '10005', 'Hantsala', '17-11-2021 12:40:40', 4);

insert into orders (orderdate, customer_id, employee_id) values
('17-11-2021 12:00:00', 1, 3),
('17-11-2021 12:10:10', 2, 4),
('17-11-2021 12:20:20', 3, 3),
('17-11-2021 12:30:30', 4, 5),
('17-11-2021 12:40:40', 5, 4);

insert into services (service, price) values
('renkaanvaihto', 50),
('kesäsäilytys', 40),
('talvisäilytys', 55),
('renkaanvaihto ja kesäsäilytys', 80),
('renkaanvaihto ja talvisäilytys', 95);

insert into ordertable (orders_id, services_id) values
(1, 4), (2, 2), (3, 5), (4, 1), (5, 3);

insert into car (register, brand, model, year, customer_id) values
('KGU-848', 'Ferrari', 'Roma', '2020', 1),
('PSI-254', 'Lamborghini', 'Diablo', '2019', 3),
('LDH-298', 'Maserati', 'Ghibli', '2018', 5),
('HGP-379', 'Aston Martin', 'Zagato', '2021', 2),
('LOL-666', 'Lada', 'Riva', '1971', 4);

insert into tires (car_register, slot_id, brand, model, type, hubcups, groovefl, groovefr, groovebl, groovebr, tiresize, tirebolt, text, rims, servicedate, info) values
('LDH-298', 3,'Firestone', 'etu:215/45ZR17, taka:245/40ZR17', 'kesä', true, 4, 4, 4, 4, 17, 'etu:5x15, taka 5x20', 'Renkaat hyvässä kunnossa', 'Maserati x 4', '17-11-2120 13:00:10', ''),
('KGU-848', 5,'Bridgestone', 'etu:245/35R20, taka:285/35R20', 'talvi', true, 5, 5, 5, 5, 20, 'etu:5x15, taka 5x20', 'Renkaat hyvässä kunnossa', 'Ferrari x 4', '17-11-2120 14:20:10', ''),
('PSI-254', 1,'Michelin', 'etu:245/40R17, taka:335/35R17', 'talvi', true, 5, 5, 5, 5, 17, 'etu:5x15, taka 5x20', 'Renkaat hyvässä kunnossa', 'Lamborghini x 4', '17-11-2120 15:40:10', ''),
('HGP-379', 6,'Goodyear', 'etu:245/40R17, taka:335/35R17', 'kesä', true, 4, 4, 4, 4, 17, 'etu:5x15, taka 5x20', 'Renkaat hyvässä kunnossa', 'Aston Martin x 4', '17-11-2120 16:15:10', ''),
('LOL-666', 11, 'Purukumit', '195/32R14', 'kitka', false, 1, 1, 1, 1, 14, '5x10', 'Renkaat on mukavan sileät, poliisi-setä tykkää', 'Latukkax4', '17-11-2120 16:55:10', 'Asiakkaan kannattaisi ostaa uudet renkaat');