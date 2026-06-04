drop database if exists auto_ecole;
create database auto_ecole;
use auto_ecole;

-- Moniteur
create table Moniteur (
    numero_moniteur int auto_increment not null,
    nom_moniteur varchar(50),
    prenom_moniteur varchar(50),
    date_naissance_moniteur varchar(50),
    telephone_moniteur char(10),
    adresse_moniteur varchar(50),
    code_postal_moniteur varchar(50),
    ville_moniteur varchar(50),
    email_moniteur varchar(50),
    date_embauche varchar(50),
    administrateur boolean,
    mdp_moniteur varchar(50),
    constraint pk_moniteur primary key (numero_moniteur)

);

INSERT INTO Moniteur VALUES
    (NULL, 'Dupont', 'Jean','2002-05-14', '0612345678','12 rue de Paris','59000', 
    'Lille','jean.dupond@driftauto.mo',  curdate(), 1 , 'mdp123'),

    (NULL, 'TEST', 'Jean','2002-05-14', '0612345678','12 rue de Paris',
    '59000','Lille','jean.testing@driftauto.mo',  curdate(), 0, 'mdp123');



-- Client
create table Client (
    numero_client int auto_increment not null,
    pseudo_client varchar(50),
    nom_client varchar(50),
    prenom_client varchar(50),
    date_naissance_client varchar(42),
    telephone_client char(10),
    adresse_client varchar(50),
    code_postal_client varchar(50),
    ville_client varchar(50),
    email_client varchar(50),
    mdp_client varchar(50),
    constraint pk_client primary key (numero_client)
);

INSERT INTO Client VALUES
    (NULL, 'alice.d', 'Durand', 'Alice', '2002-05-14', '0612345678', '12 rue de Paris', '59000', 'Lille', 'a@gmail.com', 'pass1'),
    (NULL, 'paul.m', 'Moreau', 'Paul', '2001-09-22', '0623456789', '8 avenue Victor Hugo', 'Roubaix', '59100', 'm@gmail.com' , 'pass2'),
    (NULL, 'emma.l', 'Leroy', 'Emma', '2003-02-10', '0634567890', '25 boulevard Carnot', 'Tourcoing', '59200', 'l@gmail.com' , 'pass3');

-- Examen
create table Examen (
    numero_examen int auto_increment not null,
    date_heure_examen datetime,
    numero_moniteur int not null,
    numero_client int not null,
    constraint pk_examen primary key (numero_examen),
    constraint fk_examen_moniteur foreign key (numero_moniteur) references Moniteur (numero_moniteur),
    constraint fk_examen_client foreign key (numero_client) references Client (numero_client)
);


INSERT INTO Examen VALUES
    (NULL, '2026-04-10 08:00:00', 1, 1),
    (NULL, '2026-04-12 13:30:00', 2, 2),
    (NULL, '2026-04-15 10:00:00', 1, 3);


-- Voiture 
CREATE TABLE Voiture (
    numero_immatriculation VARCHAR(16) not null,
    date_achat DATE,
    nombre_km INT,
    CONSTRAINT pk_voiture PRIMARY KEY (numero_immatriculation)
);

INSERT INTO Voiture VALUES
('AA-123-BB', '2020-01-15', 45000),
('CC-456-DD', '2019-06-20', 62000),
('EE-789-FF', '2021-09-10', 30000);

-- Lecon 

CREATE TABLE Lecon (
    numero_lecon INT AUTO_INCREMENT NOT NULL,
    date_heure_lecon DATETIME,
    numero_moniteur INT NOT NULL,
    numero_client INT NOT NULL,
    numero_immatriculation VARCHAR(16) NOT NULL,
    statut VARCHAR(25),

    CONSTRAINT pk_lecon PRIMARY KEY (numero_lecon),
    CONSTRAINT fk_lecon_moniteur FOREIGN KEY (numero_moniteur) REFERENCES Moniteur(numero_moniteur),
    CONSTRAINT fk_lecon_client FOREIGN KEY (numero_client) REFERENCES Client(numero_client),
    CONSTRAINT fk_lecon_voiture FOREIGN KEY (numero_immatriculation) REFERENCES Voiture(numero_immatriculation)
);

INSERT INTO Lecon VALUES
(NULL, '2026-03-01 10:00:00', 1, 1, 'AA-123-BB', 'en attente'),
(NULL, '2026-03-02 14:00:00', 2, 2, 'CC-456-DD', 'annuler'),
(NULL, '2026-03-03 09:00:00', 1, 3, 'EE-789-FF', 'confirmer');


-- Formation 

CREATE TABLE Formation (
    numero_formation INT AUTO_INCREMENT NOT NULL,
    nom_formation VARCHAR(50) NOT NULL,
    prix_formation DECIMAL(6,2) NOT NULL, 
    total_heures INT, 

    
    CONSTRAINT pk_formation PRIMARY KEY (numero_formation)
);

INSERT INTO Formation VALUES
(NULL, 'Permis B', '1299.00', 21),
(NULL, 'AAC', '999.00', 00 ),
(NULL, 'Code en ligne ', '29.00', 00),
(NULL, 'Stage Intensif', '1599.00', 00);


-- Possede 
CREATE TABLE Possede (
    numero_examen INT NOT NULL,
    numero_formation INT NOT NULL,

    CONSTRAINT pk_possede PRIMARY KEY (numero_examen, numero_formation),

    CONSTRAINT fk_possede_examen FOREIGN KEY (numero_examen)
        REFERENCES Examen(numero_examen),

    CONSTRAINT fk_possede_formation FOREIGN KEY (numero_formation)
        REFERENCES Formation(numero_formation)
);

INSERT INTO Possede VALUES
(1, 1),
(1, 3);

-- Contient 

CREATE TABLE Contient (
    numero_lecon INT NOT NULL,
    numero_formation INT NOT NULL,

    CONSTRAINT pk_contient PRIMARY KEY (numero_lecon, numero_formation),

    CONSTRAINT fk_contient_lecon FOREIGN KEY (numero_lecon)
        REFERENCES Lecon(numero_lecon),

    CONSTRAINT fk_contient_formation FOREIGN KEY (numero_formation)
        REFERENCES Formation(numero_formation)
);

INSERT INTO Contient VALUES
(2, 1),
(2, 3);

-- achete 

CREATE TABLE Achete (
    numero_formation INT NOT NULL,
    numero_client INT NOT NULL,

    CONSTRAINT pk_achete PRIMARY KEY (numero_formation, numero_client),

    CONSTRAINT fk_achete_client FOREIGN KEY (numero_client) REFERENCES Client(numero_client),
    CONSTRAINT fk_achete_formation FOREIGN KEY (numero_formation) REFERENCES Formation(numero_formation)
);
