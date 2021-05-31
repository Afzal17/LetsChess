-- NIET VERGETEN: INSERT INTO STATEMENT BENEDEN AANMAKEN
CREATE DATABASE schaak_applicatie;

USE schaak_applicatie;

CREATE TABLE schaakvereniging
(
    id INT NOT NULL AUTO_INCREMENT,
    naam VARCHAR(255),
    telefoonnummer VARCHAR(255),
    PRIMARY KEY(id)
);

CREATE TABLE toernooi
(
    id INT NOT NULL AUTO_INCREMENT,
    toernooi VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE speler
(
    id INT NOT NULL AUTO_INCREMENT,
    voornaam VARCHAR(255) NOT NULL,
    tussenvoegsel VARCHAR(255) NOT NULL,
    achternaam VARCHAR(255) NOT NULL,
    schaakvereniging_id INT NOT NULL,
    neemtDeel BOOLEAN,
    PRIMARY KEY(id),
    FOREIGN KEY(schaakvereniging_id) REFERENCES schaakvereniging(id) ON DELETE CASCADE
);

CREATE TABLE wedstrijd
(
    id INT NOT NULL AUTO_INCREMENT,
    toernooi_id INT NOT NULL,
    speler1_id INT NOT NULL,
    speler2_id INT NOT NULL,
    ronde SMALLINT NOT NULL,
    punten1 INT,
    punten2 INT,

    -- Hier doen we ON DELETE CASCADE
    winnaar_id INT,
    PRIMARY KEY(id),
    FOREIGN KEY(toernooi_id) REFERENCES toernooi(id) ON DELETE CASCADE,
    FOREIGN KEY(speler1_id) REFERENCES speler(id) ON DELETE CASCADE,
    FOREIGN KEY(speler2_id) REFERENCES speler(id) ON DELETE CASCADE,
    FOREIGN KEY(winnaar_id) REFERENCES speler(id) ON DELETE CASCADE
);

-- Hierbij een insert into statement toevoegen
-- INSERT INTO schaakvereniging VALUES 'id=NULL', 'etc etc etc'