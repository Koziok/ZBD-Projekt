
CREATE DATABASE IF NOT EXISTS `baza_zbd` DEFAULT CHARACTER SET latin1;
USE `baza_zbd`;

DROP TABLE IF EXISTS `wydawcy`;

CREATE TABLE `wydawcy` (
    `nazwa_wydawcy` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`nazwa_wydawcy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `wydawcy`
(`nazwa_wydawcy`)
VALUES
('Riot Games'),
('Garena'),
('Tencent'),
('Bethesda Softworks'),
('Valve Corporation'),
('Ubisoft'),
('Grupa kapitalowa CD Projekt'),
('Atari'),
('Atari Inc.'),
('CDP'),
('Warner Bros. Interactive Entertainment'),
('Mojang Studios'),
('Sony Interactive Entertainment'),
('Xobx Game Studios'),
('Epic Games'),
('Electronic Arts'),
('Aspyr Media'),
('Toby Fox'),
('Fangamer'),
('8-4'),
('Edmund McMillen'),
('Headup Games'),
('Nicalis'),
('From Software'),
('Namco Bandai Games'),
('Blizzard Entertainment');

DROP TABLE IF EXISTS `producenci`;

CREATE TABLE `producenci` (
    `nazwa_producenta` VARCHAR(30) NOT NULL,
    `data_powstania` DATE NOT NULL,
    `siedziba` VARCHAR(20),
    PRIMARY KEY (`nazwa_producenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `producenci`
(`nazwa_producenta`, `data_powstania`, `siedziba`)
VALUES
('Riot Games', '2006-09-01', 'Stany Zjednoczone'),
('Bethesda Game Studios', '1986-06-28', 'Stany Zjednoczone'),
('Valve Corporation', '1996-08-24', 'Stany Zjednoczone'),
('Crytek', '1999-09-01', 'Niemcy'),
('Ubisoft', '1999-03-28', 'Francja'),
('CD Projekt Red', '2002-02-01', 'Polska'),
('Mojang Studios', '2009-05-17', 'Sztokholm'),
('Epic Games', '1991-01-15', 'Stany Zjednoczone'),
('EA Maxis', '1987-01-01', 'Stany Zjednoczone'),
('The Sims Studio', '2006-01-01', 'Stany Zjednoczone'),
('Toby Fox', '2015-09-15', 'Stany Zjednoczone'),
('Edmund McMillen', '2011-09-28', 'Stany Zjednoczone'),
('From Software', '1986-11-01', 'Japonia'),
('Blizzard Entertainment', '1991-02-08', 'Stany Zjednoczone');

DROP TABLE IF EXISTS `deweloperzy`;

CREATE TABLE `deweloperzy` (
    `id_dewelopera` INT(10) NOT NULL AUTO_INCREMENT,
    `imie` VARCHAR(20) NOT NULL,
    `nazwisko` VARCHAR(30) NOT NULL,
    `nazwa_producenta` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`id_dewelopera`),
    KEY `nazwa_producenta` (`nazwa_producenta`),
    CONSTRAINT `deweloperzy_ibfk_1` FOREIGN KEY (`nazwa_producenta`) REFERENCES `producenci` (`nazwa_producenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `deweloperzy`
(`imie`, `nazwisko`, `nazwa_producenta`)
VALUES
('Jeff', 'Jew', 'Riot Games'),
('Jessica', 'Nam', 'Riot Games'),
('Joe', 'Tung', 'Riot Games'),
('Mike', 'Harrington', 'Valve Corporation'),
('Cevat', 'Yerli', 'Crytek'),
('Avni', 'Yerli', 'Crytek'),
('Faruk', 'Yerli', 'Crytek'),
('Konrad', 'Tomaszkiewicz', 'CD Projekt Red'),
('Michal', 'Dobrowolski', 'CD Projekt Red'),
('Pawel', 'Sasko', 'CD Projekt Red'),
('Toby', 'Fox', 'Toby Fox'),
('Edmund', 'McMillen', 'Edmund McMillen'),
('Florian', 'Himsl', 'Edmund McMillen');

DROP TABLE IF EXISTS `silniki`;

CREATE TABLE `silniki` (
    `nazwa_silnika` VARCHAR(60) NOT NULL,
    `data_powstania` DATE NOT NULL,
    PRIMARY KEY (`nazwa_silnika`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `silniki`
(`nazwa_silnika`, `data_powstania`)
VALUES
('League of Legends', '2009-10-27'),
('Unreal Engine', '1998-05-22'),
('Unity', '2005-06-01'),
('Creation Engine', '2011-11-11'),
('Source','2004-10-01'),
('CryEngine', '2002-05-02'),
('Aurora Engine', '2002-06-18'),
('RED Engine', '2011-05-17'),
('Render Dragon', '2011-11-18'),
('The Sims', '2000-02-04'),
('The Sims 2', '2004-09-14'),
('The Sims 3', '2009-06-02'),
('The Sims 4', '2014-09-02'),
('GameMaker', '1999-11-15'),
('Adobe Flash', '1996-01-01'),
('The Binding of Isaac: Rebirth', '2014-11-04'),
('The Binding of Isaac: Repentance', '2021-03-31'),
('PhyreEngine', '2011-02-28'),
('Dark Souls II', '2014-03-11'),
('Dark Souls III', '2016-03-24'),
('Overwatch', '2016-05-03');


DROP TABLE IF EXISTS `gry`;

CREATE TABLE `gry` (
    `tytul` VARCHAR(60) NOT NULL,
    `nazwa_producenta` VARCHAR(30) NOT NULL,
    `data_wydania` DATE NOT NULL,
    `czy_turniejowe` BOOLEAN NOT NULL,
    `nazwa_silnika` VARCHAR(60) NOT NULL,
    PRIMARY KEY (`tytul`, `nazwa_producenta`),
    KEY (`nazwa_producenta`),
    KEY `nazwa_silnika` (`nazwa_silnika`),
    CONSTRAINT `gry_ibfk_1` FOREIGN KEY (`nazwa_producenta`) REFERENCES `producenci` (`nazwa_producenta`),
    CONSTRAINT `gry_ibfk_2` FOREIGN KEY (`nazwa_silnika`) REFERENCES `silniki` (`nazwa_silnika`),
    CONSTRAINT `gry_ibfk_3` UNIQUE (`tytul`, `nazwa_producenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `gry` 
(`tytul`, `data_wydania`, `czy_turniejowe`, `nazwa_producenta`, `nazwa_silnika`)
VALUES
('League of Legends', '2009-10-27', TRUE, 'Riot Games', 'League of Legends'),
('Valorant', '2020-06-02', TRUE, 'Riot Games', 'Unreal Engine'),
('League of Legends: Wild Rift', '2020-10-27', TRUE, 'Riot Games', 'Unity'),
('The Elder Scrolls V: Skyrim', '2011-11-11', FALSE, 'Bethesda Game Studios', 'Creation Engine'),
('Counter-Strike: Global Offensive', '2012-08-21', TRUE, 'Valve Corporation', 'Source'),
('Far Cry', '2004-03-23', FALSE, 'Crytek', 'CryEngine'),
('Far Cry 2', '2008-10-21', FALSE, 'Ubisoft', 'CryEngine'),
('Far Cry 3', '2012-11-29', FALSE, 'Ubisoft', 'CryEngine'),
('Far Cry 4', '2014-11-18', FALSE, 'Ubisoft', 'CryEngine'),
('Far Cry 5', '2018-03-26', FALSE, 'Ubisoft', 'CryEngine'),
('Far Cry 6', '2021-10-06', FALSE, 'Ubisoft', 'CryEngine'),
('The Witcher', '2007-10-26', FALSE, 'CD Projekt Red', 'Aurora Engine'),
('The Witcher 2: Assassins of King', '2011-05-17', FALSE, 'CD Projekt Red', 'RED Engine'),
('The Witcher 3: Wild Hunt', '2015-05-18', FALSE, 'CD Projekt Red', 'RED Engine'),
('Cyberpunk 2077', '2020-09-17', FALSE, 'CD Projekt Red', 'RED Engine'),
('Minecraft', '2011-11-18', FALSE, 'Mojang Studios', 'Render Dragon'),
('Fortnite', '2017-07-21', TRUE, 'Epic Games', 'Unreal Engine'),
('The Sims', '2000-02-04', FALSE, 'EA Maxis', 'The Sims'),
('The Sims 2', '2004-09-14', FALSE, 'EA Maxis', 'The Sims 2'),
('The Sims 3', '2009-06-02', FALSE, 'The Sims Studio', 'The Sims 3'),
('The Sims 4', '2014-09-02', FALSE, 'EA Maxis', 'The Sims 4'),
('Undertale', '2015-09-15', FALSE, 'Toby Fox', 'GameMaker'),
('The Binding of Isaac', '2011-09-28', FALSE, 'Edmund McMillen', 'Adobe Flash'),
('The Binding of Isaac: Rebirth', '2014-11-04', FALSE, 'Edmund McMillen', 'The Binding of Isaac: Rebirth'),
('The Binding of Isaac: Repentance', '2021-03-31', FALSE, 'Edmund McMillen', 'The Binding of Isaac: Repentance'),
('Dark Souls', '2011-09-22', FALSE, 'From Software', 'PhyreEngine'),
('Dark Souls II', '2014-03-11', FALSE, 'From Software', 'Dark Souls II'),
('Dark Souls III', '2016-03-24', FALSE, 'From Software', 'Dark Souls III'),
('Overwatch', '2016-05-03', TRUE, 'Blizzard Entertainment', 'Overwatch');

DROP TABLE IF EXISTS `jezyki_programowania`;

CREATE TABLE `jezyki_programowania` (
    `nazwa_jezyka` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`nazwa_jezyka`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `jezyki_programowania`
(`nazwa_jezyka`)
VALUES
('C++'),
('C#'),
('Unity Script'),
('Boo'),
('C'),
('Lua'),
('NWScript'),
('Java'),
('Python'),
('GML'),
('ActionScript');

DROP TABLE IF EXISTS `wsparcia`;

CREATE TABLE `wsparcia` (
    `maks_wersja_silnika` VARCHAR(20),
    `nazwa_silnika` VARCHAR(60) NOT NULL,
    `nazwa_jezyka` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`nazwa_silnika`, `nazwa_jezyka`),
    KEY `nazwa_silnika` (`nazwa_silnika`),
    KEY `nazwa_jezyka` (`nazwa_jezyka`),
    CONSTRAINT `wsparcia_ibfk_1` FOREIGN KEY (`nazwa_silnika`) REFERENCES `silniki` (`nazwa_silnika`),
    CONSTRAINT `wsparcia_ibfk_2` FOREIGN KEY (`nazwa_jezyka`) REFERENCES `jezyki_programowania` (`nazwa_jezyka`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `wsparcia`
(`maks_wersja_silnika`, `nazwa_silnika`, `nazwa_jezyka`)
VALUES
(NULL, 'League of Legends', 'C++'),
('4.27.1', 'Unreal Engine', 'C++'),
(NULL, 'Unity', 'C++'),
(NULL, 'Unity', 'C#'),
(NULL, 'Unity', 'Unity Script'),
('4.6.1', 'Unity', 'Boo'),
(NULL, 'Creation Engine', 'C++'),
(NULL, 'Source', 'C++'),
(NULL, 'CryEngine', 'C'),
(NULL, 'CryEngine', 'C++'),
(NULL, 'CryEngine', 'Lua'),
(NULL, 'CryEngine', 'C#'),
(NULL, 'Aurora Engine', 'NWScript'),
(NULL, 'RED Engine', 'C++'),
(NULL, 'Render Dragon', 'Java'),
(NULL, 'The Sims', 'C++'),
(NULL, 'The Sims 2', 'C++'),
(NULL, 'The Sims 3', 'C++'),
(NULL, 'The Sims 3', 'C#'),
(NULL, 'The Sims 3', 'Python'),
(NULL, 'The Sims 4', 'C++'),
(NULL, 'The Sims 4', 'C#'),
(NULL, 'The Sims 4', 'Python'),
(NULL, 'GameMaker', 'GML'),
(NULL, 'Adobe Flash', 'ActionScript'),
(NULL, 'The Binding of Isaac: Rebirth', 'C++'),
(NULL, 'The Binding of Isaac: Repentance', 'C++'),
(NULL, 'PhyreEngine', 'C++'),
(NULL, 'PhyreEngine', 'C#'),
(NULL, 'Dark Souls II', 'C++'),
(NULL, 'Dark Souls II', 'C#'),
(NULL, 'Dark Souls III', 'C++'),
(NULL, 'Dark Souls III', 'C#'),
(NULL, 'Overwatch', 'C++');

DROP TABLE IF EXISTS `wspolprace`;

CREATE TABLE `wspolprace` (
    `no` INT(10) NOT NULL AUTO_INCREMENT,
    `data_rozpoczecia` DATE NOT NULL,
    `tytul` VARCHAR(60) NOT NULL,
    `nazwa_producenta` VARCHAR(30) NOT NULL,
    `nazwa_wydawcy` VARCHAR(30) NOT NULL,
    PRIMARY KEY(`no`),
    KEY (`tytul`,`nazwa_producenta`),
    KEY (`nazwa_wydawcy`),
    CONSTRAINT `wspolprace_ibfk_1` FOREIGN KEY (`tytul`, `nazwa_producenta`) REFERENCES `gry` (`tytul`, `nazwa_producenta`),
    CONSTRAINT `wspolprace_ibfk_2` FOREIGN KEY (`nazwa_wydawcy`) REFERENCES `wydawcy` (`nazwa_wydawcy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `wspolprace`
(`data_rozpoczecia`, `tytul`, `nazwa_producenta`, `nazwa_wydawcy`)
VALUES
('2009-10-27', 'League of Legends', 'Riot Games', 'Riot Games'),
('2009-10-27', 'League of Legends', 'Riot Games', 'Garena'),
('2011-01-01', 'League of Legends', 'Riot Games', 'Tencent'),
('2020-06-02', 'Valorant', 'Riot Games', 'Riot Games'),
('2020-10-27', 'League of Legends: Wild Rift', 'Riot Games', 'Riot Games'),
('2011-11-11', 'The Elder Scrolls V: Skyrim', 'Bethesda Game Studios', 'Bethesda Softworks'),
('2012-08-21', 'Counter-Strike: Global Offensive', 'Valve Corporation','Valve Corporation'),
('2004-03-23', 'Far Cry', 'Crytek', 'Ubisoft'),
('2008-10-21', 'Far Cry 2', 'Ubisoft', 'Ubisoft'),
('2012-11-29', 'Far Cry 3', 'Ubisoft', 'Ubisoft'),
('2014-11-18', 'Far Cry 4', 'Ubisoft', 'Ubisoft'),
('2018-03-26', 'Far Cry 5', 'Ubisoft', 'Ubisoft'),
('2021-10-06', 'Far Cry 6', 'Ubisoft', 'Ubisoft'),
('2007-10-26', 'The Witcher', 'CD Projekt Red', 'Grupa kapitalowa CD Projekt'),
('2007-10-26', 'The Witcher', 'CD Projekt Red', 'Atari'),
('2007-10-26', 'The Witcher', 'CD Projekt Red', 'Atari Inc.'),
('2007-10-26', 'The Witcher', 'CD Projekt Red', 'CDP'),
('2011-05-17', 'The Witcher 2: Assassins of King', 'CD Projekt Red', 'Grupa kapitalowa CD Projekt'),
('2015-05-18', 'The Witcher 3: Wild Hunt', 'CD Projekt Red', 'Grupa kapitalowa CD Projekt'),
('2015-05-18', 'The Witcher 3: Wild Hunt', 'CD Projekt Red', 'Warner Bros. Interactive Entertainment'),
('2020-09-17', 'Cyberpunk 2077', 'CD Projekt Red', 'Grupa kapitalowa CD Projekt'),
('2011-11-18', 'Minecraft', 'Mojang Studios', 'Mojang Studios'),
('2011-11-18', 'Minecraft', 'Mojang Studios', 'Sony Interactive Entertainment'),
('2011-11-18', 'Minecraft', 'Mojang Studios', 'Xobx Game Studios'),
('2017-07-21', 'Fortnite', 'Epic Games', 'Epic Games'),
('2000-02-04', 'The Sims', 'EA Maxis', 'Electronic Arts'),
('2000-02-04', 'The Sims', 'EA Maxis', 'Aspyr Media'),
('2004-09-14', 'The Sims 2', 'EA Maxis', 'Electronic Arts'),
('2009-06-02', 'The Sims 3', 'The Sims Studio', 'Electronic Arts'),
('2014-09-02', 'The Sims 4', 'EA Maxis', 'Electronic Arts'),
('2015-09-15', 'Undertale', 'Toby Fox', 'Toby Fox'),
('2015-09-15', 'Undertale', 'Toby Fox', 'Fangamer'),
('2015-09-15', 'Undertale', 'Toby Fox', '8-4'),
('2011-09-28', 'The Binding of Isaac', 'Edmund McMillen', 'Edmund McMillen'),
('2011-09-28', 'The Binding of Isaac', 'Edmund McMillen', 'Headup Games'),
('2014-11-04', 'The Binding of Isaac: Rebirth', 'Edmund McMillen', 'Nicalis'),
('2021-03-31', 'The Binding of Isaac: Repentance', 'Edmund McMillen', 'Nicalis'),
('2011-09-22', 'Dark Souls', 'From Software', 'From Software'),
('2011-09-22', 'Dark Souls', 'From Software', 'Namco Bandai Games'),
('2014-03-11', 'Dark Souls II', 'From Software', 'From Software'),
('2014-03-11', 'Dark Souls II', 'From Software', 'Namco Bandai Games'),
('2016-03-24', 'Dark Souls III', 'From Software', 'From Software'),
('2016-03-24', 'Dark Souls III', 'From Software', 'Namco Bandai Games'),
('2016-05-03', 'Overwatch', 'Blizzard Entertainment', 'Blizzard Entertainment');

DROP TABLE IF EXISTS `turnieje`;

CREATE TABLE `turnieje` (
    `nazwa_turnieju` VARCHAR(60) NOT NULL,
    `data_rozpoczecia` DATE NOT NULL,
    `data_zakonczenia` DATE NOT NULL,
    `pula_nagrod_pienieznych` VARCHAR(20) NOT NULL,
    `tytul` VARCHAR(60) NOT NULL,
    `nazwa_producenta` VARCHAR(30),
    PRIMARY KEY (`nazwa_turnieju`),
    KEY `tytul` (`tytul`, `nazwa_producenta`),
    KEY `nazwa_producenta` (`nazwa_producenta`),
    CONSTRAINT `turnieje_ibfk_1` FOREIGN KEY (`tytul`, `nazwa_producenta`) REFERENCES `gry` (`tytul`, `nazwa_producenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `turnieje`
(`nazwa_turnieju`, `data_rozpoczecia`, `data_zakonczenia`, `pula_nagrod_pienieznych`, `tytul`, `nazwa_producenta`)
VALUES
('2021 Mid-Season Invitational', '2021-05-06', '2021-05-23', '250.000 USD', 'League of Legends', 'Riot Games'),
('2021 Season League of Legends Worlds Championship', '2021-10-05', '2021-11-06', '2.225.000 USD', 'League of Legends', 'Riot Games'),
('VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', '2021-09-10', '2021-09-19', '700.000 USD', 'Valorant', 'Riot Games');

DROP TABLE IF EXISTS `druzyny`;

CREATE TABLE `druzyny` (
    `nazwa_druzyny` VARCHAR(20) NOT NULL,
    `data_zalozenia` DATE NOT NULL,
    `kraj_zalozenia` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`nazwa_druzyny`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `druzyny`
(`nazwa_druzyny`, `data_zalozenia`, `kraj_zalozenia`)
VALUES
('RNG', '2015-05-15', 'Chiny'),
('DWG KIA', '2017-05-28', 'Korea Poludniowa'),
('PSG Talon', '2020-06-18', 'Hongkong'),
('MAD Lions', '2019-11-29', 'Hiszapnia'),
('Cloud9', '2012-12-04', 'Stany Zjednoczone'),
('Pentanet.GG', '2019-12-01', 'Australia'),
('Unicorns Of Love', '2013-08-15', 'Rosja'),
('paiN Gaming', '2012-01-15', 'Brazylia'),
('DetonatioN FM', '2013-04-13', 'Japonia'),
('Istanbul Wildcats', '2019-04-16', 'Turcja'),
('Infinity Esports', '2009-11-01', 'Kostaryka'),
('EDward Gaming', '2014-02-07', 'Chiny'),
('T1', '2019-12-08', 'Korea Poludniowa'),
('GEN.G', '2018-05-03', 'Korea Poludniowa'),
('Hanwha Life', '2018-04-15', 'Korea Poludniowa'),
('Rogue', '2016-05-03', 'Stany Zjednoczone'),
('100 Thieves', '2017-11-20', 'Stany Zjednoczone'),
('Team Liquid', '2015-01-06', 'Holandia'),
('LNG Esports', '2019-05-21', 'Chiny'),
('FunPlus Phoenix', '2018-12-20', 'Chiny'),
('Fnatic', '2011-03-14', 'Wielka Brytania'),
('Beyond Gaming', '2021-01-26', 'Tajwan'),
('PEACE', '2021-02-23', 'Australia'),
('Galatasaray Esports', '1905-10-30', 'Turcja'),
('RED Canids', '2015-12-17', 'Brazylia'),
('Gambit Esports', '2013-01-14', 'Rosja'),
('Team Envy', '2007-11-19', 'Stany Zjednoczone'),
('G2 Esports', '2014-02-24', 'Hiszpania'),
('Acend', '2021-03-10', 'Austria'),
('Sentinels', '2018-06-06', 'Stany Zjednoczone'),
('Vision Strikers', '2020-06-01', 'Korea Poludniowa'),
('KRU Esports', '2020-10-15', 'Argentyna'),
('SuperMassive Blaze', '2019-07-23', 'Turcja'),
('Keyd Stars', '2010-06-01', 'Brazylia'),
('Crazy Raccoon', '2020-07-25', 'Japonia'),
('F4Q', '2020-10-08', 'Korea Poludniowa'),
('Paper Rex', '2020-01-01', 'Singapur'),
('ZETA DIVISION', '2020-04-07', 'Japonia'),
('Havan Liberty', '2018-06-07', 'Brazylia'),
('Bren Esports', '2020-08-28', 'Filipiny');

DROP TABLE IF EXISTS `zawodnicy`;

CREATE TABLE `zawodnicy` (
    `id_zawodnika` INT(10) NOT NULL AUTO_INCREMENT,
    `imie` VARCHAR(20) NOT NULL,
    `nazwisko` VARCHAR(30) NOT NULL,
    `data_urodzenia` DATE NOT NULL,
    `kraj_pochodzenia` VARCHAR(30) NOT NULL,
    `nazwa_druzyny` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`id_zawodnika`),
    KEY `nazwa_druzyny` (`nazwa_druzyny`),
    CONSTRAINT `zawodnicy_ibfk_1` FOREIGN KEY (`nazwa_druzyny`) REFERENCES `druzyny` (`nazwa_druzyny`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `zawodnicy`
(`imie`, `nazwisko`, `data_urodzenia`, `kraj_pochodzenia`, `nazwa_druzyny`)
VALUES
('Marcin', 'Jankowski', '1995-07-23', 'Polska', 'G2 Esports'),
('Rasmus', 'Borregaard Winther', '1999-11-17', 'Dania', 'G2 Esports');
DROP TABLE IF EXISTS `udzialy`;

CREATE TABLE `udzialy` (
    `nagroda_pieniezna` VARCHAR(20),
    `zajete_miejsce` VARCHAR(7) NOT NULL,
    `nazwa_turnieju` VARCHAR(60) NOT NULL,
    `nazwa_druzyny` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`nazwa_turnieju`,`nazwa_druzyny`),
    KEY `nazwa_turnieju` (`nazwa_turnieju`),
    KEY `nazwa_druzyny` (`nazwa_druzyny`),
    CONSTRAINT `udzialy_ibfk_1` FOREIGN KEY (`nazwa_turnieju`) REFERENCES `turnieje` (`nazwa_turnieju`),
    CONSTRAINT `udzialy_ibfk_2` FOREIGN KEY (`nazwa_druzyny`) REFERENCES `druzyny` (`nazwa_druzyny`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `udzialy`
(`nagroda_pieniezna`, `zajete_miejsce`, `nazwa_turnieju`, `nazwa_druzyny`)
VALUES
('75.000 USD', '1', '2021 Mid-Season Invitational', 'RNG'),
('50.000 USD', '2', '2021 Mid-Season Invitational', 'DWG KIA'),
('25.000 USD', '3-4', '2021 Mid-Season Invitational', 'PSG Talon'),
('25.000 USD', '3-4', '2021 Mid-Season Invitational', 'MAD Lions'),
('17.500 USD', '5-6', '2021 Mid-Season Invitational', 'Cloud9'),
('17.500 USD', '5-6', '2021 Mid-Season Invitational', 'Pentanet.GG'),
('8.325 USD', '7-9', '2021 Mid-Season Invitational', 'Unicorns Of Love'),
('8.325 USD', '7-9', '2021 Mid-Season Invitational', 'paiN Gaming'),
('8.325 USD', '7-9', '2021 Mid-Season Invitational', 'DetonatioN FM'),
('5.000 USD', '10-11', '2021 Mid-Season Invitational', 'Istanbul Wildcats'),
('5.000 USD', '10-11', '2021 Mid-Season Invitational', 'Infinity Esports'),
('489.500 USD', '1', '2021 Season League of Legends Worlds Championship', 'EDward Gaming'),
('333.750 USD', '2', '2021 Season League of Legends Worlds Championship', 'DWG KIA'),
('178.000 USD', '3-4', '2021 Season League of Legends Worlds Championship', 'T1'),
('178.000 USD', '3-4', '2021 Season League of Legends Worlds Championship', 'GEN.G'),
('100.125 USD', '5-8', '2021 Season League of Legends Worlds Championship', 'Hanwha Life'),
('100.125 USD', '5-8', '2021 Season League of Legends Worlds Championship', 'RNG'),
('100.125 USD', '5-8', '2021 Season League of Legends Worlds Championship', 'MAD Lions'),
('100.125 USD', '5-8', '2021 Season League of Legends Worlds Championship', 'Cloud9'),
('55.625 USD', '9-11', '2021 Season League of Legends Worlds Championship', 'Rogue'),
('55.625 USD', '9-11', '2021 Season League of Legends Worlds Championship', '100 Thieves'),
('55.625 USD', '9-11', '2021 Season League of Legends Worlds Championship', 'PSG Talon'),
('52.843,75 USD', '12-13', '2021 Season League of Legends Worlds Championship', 'Team Liquid'),
('52.843,75 USD', '12-13', '2021 Season League of Legends Worlds Championship', 'LNG Esports'),
('50.062,50 USD', '14-16', '2021 Season League of Legends Worlds Championship', 'FunPlus Phoenix'),
('50.062,50 USD', '14-16', '2021 Season League of Legends Worlds Championship', 'DetonatioN FM'),
('50.062,50 USD', '14-16', '2021 Season League of Legends Worlds Championship', 'Fnatic'),
('38.937,50 USD', '17-18', '2021 Season League of Legends Worlds Championship', 'Beyond Gaming'),
('38.937,50 USD', '17-18', '2021 Season League of Legends Worlds Championship', 'PEACE'),
('27.812,50 USD', '19-20', '2021 Season League of Legends Worlds Championship', 'Galatasaray Esports'),
('27.812,50 USD', '19-20', '2021 Season League of Legends Worlds Championship', 'RED Canids'),
('22.250 USD', '21-22', '2021 Season League of Legends Worlds Championship', 'Infinity Esports'),
('22.250 USD', '21-22', '2021 Season League of Legends Worlds Championship', 'Unicorns Of Love'),
('225.000 USD', '1', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'Gambit Esports'),
('225.000 USD', '2', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'Team Envy'),
('225.000 USD', '3-4', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', '100 Thieves'),
('225.000 USD', '3-4', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'G2 Esports'),
('225.000 USD', '5-8', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'Acend'),
('225.000 USD', '5-8', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'Sentinels'),
('225.000 USD', '5-8', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'Vision Strikers'),
('225.000 USD', '5-8', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'KRU Esports'),
('225.000 USD', '9-12', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'SuperMassive Blaze'),
('225.000 USD', '9-12', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'Keyd Stars'),
('225.000 USD', '9-12', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'Crazy Raccoon'),
('225.000 USD', '9-12', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'F4Q'),
('225.000 USD', '13-15', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'Paper Rex'),
('225.000 USD', '13-15', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'ZETA DIVISION'),
('225.000 USD', '13-15', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'Havan Liberty'),
('225.000 USD', 'DQ', 'VALORANT Champions Tour 2021: Stage 3 Masters - Berlin', 'Bren Esports');

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `wezZawodnikow`(
    in p_nazwa_druzyny varchar(60))
BEGIN
    SELECT imie, nazwisko, data_urodzenia, kraj_pochodzenia 
    FROM zawodnicy 
    WHERE nazwa_druzyny=p_nazwa_druzyny;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `sortujGry`(`s` VARCHAR(20)) RETURNS varchar(30) CHARSET latin1
    NO SQL
BEGIN
    DECLARE sortowanie VARCHAR(30);
    IF s = 'tytul_r' THEN
        SET sortowanie = 'gry.tytul ASC';
    ELSEIF s = 'tytul_m' THEN
        SET sortowanie = 'gry.tytul DESC';
    ELSEIF s = 'data_wydania_r' THEN
        SET sortowanie = 'gry.data_wydania ASC';
    ELSE
        SET sortowanie = 'gry.data_wydania DESC';
    END IF;

    RETURN sortowanie;
END$$
DELIMITER ;