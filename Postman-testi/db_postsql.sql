CREATE TABLE asiakas (
    id BIGSERIAL NOT NULL PRIMARY KEY,
    etunimi varchar(25) not null,
    sukunimi varchar(25) not null,
    puhnro varchar(25) not null,
    sposti varchar(25) not null,
    osoite varchar(50) not null,
    postinro char(5) not null,
    postitmp varchar(25) not null,
    tallennettu TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

 INSERT INTO asiakas(etunimi, sukunimi, puhnro, sposti, osoite, postinro, postitmp) VALUES ('podd','podd','987123','gagaege','jjflaf f','hlia','sfsdf');


CREATE TABLE car (
id smallserial primary key,
reknro varchar(25) not null unique,
merkki varchar(25) not null,
koko varchar(25) not null,
pultti varchar(25) not null,
asiakas_id int not null,
foreign key (asiakas_id) references asiakas(id)
on delete restrict
);


CREATE TABLE tires (
id smallserial primary key,
car_id int not null,
foreign key (car_id) references car(id),
merkki varchar(25) not null,
keli varchar(50) not null,
tyyppi varchar(25) not null,
kapselit varchar(25) not null,
urave varchar(25),
uraoe varchar(25),
uravt varchar(25),
uraot varchar(25),
teksti text,
kasittelyaika timestamp default current_timestamp
);
