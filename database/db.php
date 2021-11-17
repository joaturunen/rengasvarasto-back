-- Database: rengasvarasto

-- drop database [if exists] rengasvarasto;

create database rengasvarasto
with
owner = postgres
ENCODING = 'UTF8'
lc_collate= 'English_Finland.1252'
lc_ctype = 'English_Finland.1252'
tablespace = pg_default
connection limit = -1;

create table rooli (
id smallserial primary key,
nimike varchar(25) not null
);

create table tyontekija (
id smallserial primary key,
etunimi varchar(25) not null,
sukunimi varchar(25) not null,
puhnro varchar(25) not null unique,
sposti varchar(25) not null unique,
osoite varchar(50) not null,
postinro char(5) not null,
postitmp varchar(25) not null,
tunnus varchar(25) not null unique,
salasana varchar(25) not null,
rooli_id int not null,
foreign key (rooli_id) references rooli(id)
on delete restrict
);

create index on tyontekija (
rooli_id
);

create table asiakas (
id smallserial primary key,
etunimi varchar(25) not null,
sukunimi varchar(25) not null,
puhnro varchar(25) not null unique,
sposti varchar(25) not null unique,
osoite varchar(50) not null,
postinro char(5) not null,
postitmp varchar(25) not null,
tallennus timestamp default current_timestamp,
tyontekija_id int not null,
foreign key (tyontekija_id) references tyontekija(id)
on delete restrict
);

create index on asiakas (
tyontekija_id
);

create table tilaus (
id smallserial primary key,
pvm timestamp default current_timestamp,
asiakas_id int not null,
tyontekija_id int not null,
foreign key (asiakas_id) references asiakas(id),
foreign key (tyontekija_id) references tyontekija(id)
on delete restrict
);

create index on tilaus (
asiakas_id, tyontekija_id
);

create table tuote (
id smallserial primary key,
nimi varchar(25) not null,
hinta int not null
);

create table tilausrivi (
id smallserial primary key,
tuote_id int not null,
foreign key (tuote_id) references tuote(id)
on delete restrict
);

create index on tilausrivi (
tuote_id
);

create table auto (
id smallserial primary key,
reknro varchar(25) not null unique,
merkki varchar(25) not null,
malli varchar(25) not null,
rengaskoko varchar(25) not null,
pultti varchar(25) not null
);

create table toimipiste (
id smallserial primary key,
nimi varchar(25) not null unique,
puhnro varchar(25) not null unique,
sposti varchar(25) not null unique,
osoite varchar(25) not null,
postinro char(5) not null,
postitmp varchar(25) not null,
logo varchar(25)
);

create table varasto (
id smallserial primary key,
nimi varchar(25),
toimipiste_id int not null,
foreign key (toimipiste_id) references toimipiste(id)
on delete restrict
);

create index on varasto (
toimipiste_id
);

create table hylly (
id smallserial primary key,
varasto_id int not null,
foreign key (varasto_id) references varasto(id)
on delete restrict
);

create index on hylly (
varasto_id
);

create table paikka (
id smallserial primary key,
hylly_id int not null,
foreign key (hylly_id) references hylly(id)
on delete restrict
);

create index on paikka (
hylly_id
);

create table renkaat (
id smallserial primary key,
asiakas_id int not null,
auto_id int not null,
paikka_id int not null,
tyontekija_id int not null,
foreign key (asiakas_id) references asiakas(id),
foreign key (auto_id) references auto(id),
foreign key (paikka_id) references paikka(id),
merkki varchar(25) not null,
malli varchar(25) not null,
koko varchar(25) not null,
tyyppi varchar(25) not null,
kapselit varchar(25) not null,
urave varchar(25) not null,
uraoe varchar(25) not null,
uravt varchar(25) not null,
uraot varchar(25) not null,
teksti text,
vanteet varchar(25) not null,
kasittelyaika timestamp default current_timestamp,
lisatiedot text,
foreign key (tyontekija_id) references tyontekija(id)
on delete restrict
);

create index on renkaat (
asiakas_id, auto_id, paikka_id, tyontekija_id
);