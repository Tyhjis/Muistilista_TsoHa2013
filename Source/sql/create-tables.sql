CREATE TABLE kayttaja
(
ID serial primary key,
etunimi varchar(30),
sukunimi varchar(30),
s_posti varchar(50),
salasana varchar(25),
yllapitaja boolean
);

CREATE TABLE askare
(
ID serial primary key,
otsikko varchar(50),
kuvaus varchar(200)
);

CREATE TABLE tagi
(
ID serial primary key,
nimi varchar(20)
);

CREATE TABLE tagilista
(
ID serial primary key,
tagi_ID serial references tagi(ID),
askare_ID serial references askare(ID)
);

CREATE TABLE muistilista
(
ID serial primary key,
kayttaja_ID serial references kayttaja(ID),
askare_ID serial references askare(ID)
);
