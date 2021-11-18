insert into rooli (id, nimike) values
(0, 'Toimitusjohtaja'),
(1, 'Vuoropäällikkö'),
(2, 'Asiakaspalvelija'),
(3, 'Hallityöntekijä');

insert into tyontekija (id, etunimi, sukunimi, puhnro, sposti, osoite, postinro, postitmp, tunnus, salasana, rooli_id) values
(0, 'Tuija', 'Toimari', '0401234567', 'tuitoim@rengashotelli.org', 'Toimarikatu 1', '00001', 'Toimarila', 'Toimari', 'salasana', 0),
(1, 'Veera', 'Vuorari', '0402234567', 'veevuor@rengashotelli.org', 'Vuorarikatu 2', '00002', 'Vuorarila', 'Vuorari', 'salasana', 1),
(2, 'Aapo', 'Aspa', '0403234567', 'aapaspa@rengashotelli.org', 'Asparikatu 3', '00003', 'Asparila', 'Aspari', 'salasana', 2),
(3, 'Atte', 'Aspapapapa', '0404234567', 'attaspa@rengashotelli.org', 'Asparikatu 4', '00003', 'Asparila', 'Aspariatte', 'salasana', 2),
(4, 'Henna', 'Hallari', '0405234567', 'henhall@rengashotelli.org', 'Hallarikatu 5', '00004', 'Hallarila', 'Hallari', 'salasana', 3),
(5, 'Harri', 'Hallimestari', '0406234567', 'harhall@rengashotelli.org', 'Hallarikatu 6', '00004', 'Hallarila', 'Hallaripallari', 'salasana', 3);

insert into asiakas (id, etunimi, sukunimi, puhnro, sposti, osoite, postinro, postitmp, tallennus, tyontekija_id) values
(0, 'Martsa', 'Järvis', '0411234567', 'martsa@koulu.org', 'Martsankoti 1', '10001', 'Martsala', '17-11-2021 12:00:00', 2),
(1, 'Jontsa', 'Turus', '0412234567', 'jontsa@koulu.org', 'Jontsankämppä 2', '10002', 'Jontsala', '17-11-2021 12:10:10', 3),
(2, 'Altsa', 'Luomala', '0413234567', 'altsa@koulu.org', 'Altsankukkula 3', '10003', 'Altsala', '17-11-2021 12:20:20', 2),
(3, 'Katsa', 'Mäkis', '0414234567', 'katsa@koulu.org', 'Katsanmäki 4', '10004', 'Katsala', '17-11-2021 12:30:30', 2),
(4, 'Hantsa', 'Hirviölä', '0415234567', 'hantsa@koulu.org', 'Hantsankolo 5', '10005', 'Hantsala', '17-11-2021 12:40:40', 3);

insert into tilaus (id, pvm, asiakas_id, tyontekija_id) values
(0, '17-11-2021 12:00:00', 0, 2),
(1, '17-11-2021 12:10:10', 1, 3),
(2, '17-11-2021 12:20:20', 2, 2),
(3, '17-11-2021 12:30:30', 3, 2),
(4, '17-11-2021 12:40:40', 4, 3);

insert into tuote (id, nimi, hinta) values
(0, 'renkaanvaihto', 50),
(1, 'kesäsäilytys', 40),
(2, 'talvisäilytys', 55),
(3, 'renkaanvaihto ja kesäsäil', 80),
(4, 'renkaanvaihto ja talvisäi', 95);

insert into tilausrivi (id, tuote_id) values
(0, 4), (1, 2), (2, 0), (3, 1), (4, 3);

insert into auto (id, reknro, merkki, malli, rengaskoko, pultti) values
(0, 'KGU-848', 'Ferrari', 'Roma', '20', 'etu:20x8, taka:20x10'),
(1, 'PSI-254', 'Lamborghini', 'Diablo', '17', 'etu:20x8, taka:20x10'),
(2, 'LDH-298', 'Maserati', 'Ghibli', '17', 'etu:20x8, taka:20x10'),
(3, 'HGP-379', 'Aston Martin', 'Zagato', '17', 'etu:20x8, taka:20x10'),
(4, 'LOL-666', 'Lada', 'Riva', '14', '10x5');

insert into toimipiste (id, nimi, puhnro, sposti, osoite, postinro, postitmp, logo) values
(0, 'Päätoimipaikka', '0407654321', 'paatoim@rengashotelli.org', 'Rengashotellintie 6', '76543', 'Renkaala', 'logo.jpg'),
(1, 'Sivutoimipaikka', '0408654321', 'sivtoim@rengashotelli.org', 'Sivutoimipaikanosoite 5', '76643', 'Sivula', 'logo1.jpg');

insert into varasto (id, nimi, toimipiste_id) values
(0, 'iso varasto', 0),
(1, 'pieni varasto', 0),
(2, 'sivu varasto', 1);

insert into hylly (id, varasto_id) values
(0, 0), (1, 0), (2, 0), (3, 0), (4, 0), (5, 1), (6, 1), (7, 1), (8, 1), (9, 1), (10, 1), (11, 2), (12, 2), (13, 2), (14, 2);

insert into paikka (id, hylly_id) values
(0, 0), (1, 0), (2, 0), (3, 0), (4, 1), (5, 1), (6, 1), (7, 2), (8, 2), (9, 2), (10, 2), (11, 2);

insert into renkaat (id, asiakas_id, auto_id, paikka_id, tyontekija_id, merkki, malli, tyyppi, kapselit, urave, uraoe, uravt, uraot, teksti, vanteet, kasittelyaika, lisatiedot) values
(0, 1, 2, 3, 3, 'Firestone', 'etu:215/45ZR17, taka:245/40ZR17', 'kesä', 'ei', 4, 4, 4, 4, 'Renkaat hyvässä kunnossa', 'Maserati x 4', '17-11-2120 13:00:10', ''),
(1, 3, 0, 0, 2, 'Bridgestone', 'etu:245/35R20, taka:285/35R20', 'talvi', 'ei', 5, 5, 5, 5, 'Renkaat hyvässä kunnossa', 'Ferrari x 4', '17-11-2120 14:20:10', ''),
(2, 0, 1, 1, 2, 'Michelin', 'etu:245/40R17, taka:335/35R17', 'talvi', 'ei', 5, 5, 5, 5, 'Renkaat hyvässä kunnossa', 'Lamborghini x 4', '17-11-2120 15:40:10', ''),
(3, 2, 3, 6, 2, 'Goodyear', 'etu:245/40R17, taka:335/35R17', 'kesä', 'ei', 4, 4, 4, 4, 'Renkaat hyvässä kunnossa', 'Aston Martin x 4', '17-11-2120 16:15:10', ''),
(4, 4, 4, 11, 3, 'Purukumit', '195/32R14', 'kitka', 14, 'ei', 1, 1, 1, 1, 'Renkaat on mukavan sileät, poliisi-setä tykkää', 'ei', '17-11-2120 16:55:10', 'Asiakkaan kannattaisi ostaa uudet renkaat');