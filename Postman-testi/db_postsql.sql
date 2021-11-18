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


