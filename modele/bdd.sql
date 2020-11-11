-- Création des tables

CREATE TABLE IF NOT EXISTS client(
    id_client INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_client VARCHAR(40) NOT NULL,
    mdp_client TEXT NOT NULL,
    mail_client TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS entreprise(
    id_entreprise INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_entreprise TEXT NOT NULL,
    mdp_entreprise TEXT NOT NULL,
    mail_entreprise TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS vehicule(
    id_vehicule INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_client INT NOT NULL,
    type_vehicule TEXT NOT NULL,
    nb_vehicule INT NOT NULL,
    caract_vehicule TEXT NOT NULL,
    location_vehicule TEXT NOT NULL,
    prix_vehicule INT NOT NULL,
    photo_vehicule TEXT NOT NULL,
    CONSTRAINT FK_vehicule_id_client
        FOREIGN KEY(id_client)
        REFERENCES client(id_client)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS facturation(
    id_facturation INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_vehicule INT NOT NULL,
    id_entreprise INT NOT NULL,
    dateD_facturation DATE NOT NULL,
    dateF_facturation DATE,
    valeur_facturation INT NOT NULL,
    etat_facturation TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Contraintes sur la table facturation

ALTER TABLE facturation
ADD ( CONSTRAINT FK_facturation_id_vehicule
    FOREIGN KEY(id_vehicule)
    REFERENCES vehicule(id_vehicule)
);

ALTER TABLE facturation
ADD ( CONSTRAINT FK_facturation_id_entreprise
    FOREIGN KEY(id_entreprise)
    REFERENCES entreprise(id_entreprise)
);

-- Insertion des données dans la bdd

INSERT INTO client (id_client, nom_client, mdp_client, mail_client) VALUES 
(1, 'Julien Sunshine', SHA1('password'), 'julien.sunshine@mail.com');

INSERT INTO entreprise (id_entreprise, nom_entreprise, mdp_entreprise, mail_entreprise) VALUES
(1, 'Bouygues Telecom', SHA1('76DXLpid2'), 'CEO@bouygues.fr'),
(2, 'Orange CyberDefense', SHA1('F4r5yVq7Y'), 'pentester1@orange.fr'),
(3, 'AMT', SHA1('EfBr222kL'), 'employe1@amt.fr'),
(4, 'Microsoft', SHA1('zfC63Q4Wm'), 'employe1@microsoft.fr');

INSERT INTO vehicule (id_vehicule, id_client, type_vehicule, nb_vehicule, caract_vehicule, location_vehicule, prix_vehicule, photo_vehicule) VALUES
(1, 1, 'Clio', 1, '{"marque":"Renault","couleur":"Blanc","moteur":"Diesel", "vitesse":"Manuelle", "nbPlace":"5"}', '2', 45, 'RenaultClioBlanc1'),
(2, 1, 'Tributo', 1, '{"marque":"Ferrari","couleur":"Rouge","moteur":"Diesel", "vitesse":"Manuelle", "nbPlace":"2"}', '4', 200, 'FerrariTributoRouge2'),
(3, 1, 'Mustang', 1, '{"marque":"Ford","couleur":"Vert","moteur":"Essence", "vitesse":"Manuelle", "nbPlace":"5"}', 'disponible', 85, 'FordMustangVert3'),
(4, 1, 'C3', 1, '{"marque":"Citroën","couleur":"Rouge","moteur":"Diesel", "vitesse":"Manuelle", "nbPlace":"5"}', 'en_revision', 36, 'CitroënC3Rouge4'),
(5, 1, 'Model X', 1, '{"marque":"Tesla","couleur":"Blanc","moteur":"Electrique", "vitesse":"Automatique", "nbPlace":"7"}', '2', 175, 'TeslaModel XBlanc5'),
(6, 1, 'POLO', 1, '{"marque":"Volkswagen","couleur":"Gris","moteur":"Essence", "vitesse":"Manuelle", "nbPlace":"5"}', 'disponible', 27, 'VolkswagenPOLOGris6'),
(7, 1, '206', 1, '{"marque":"Peugeot","couleur":"Gris","moteur":"Essence", "vitesse":"Manuelle", "nbPlace":"5"}', 'disponible', 25, 'Peugeot206Gris7'),
(8, 1, 'AMI', 1, '{"marque":"Citroën","couleur":"Vert","moteur":"Electrique", "vitesse":"Automatique", "nbPlace":"2"}', 'disponible', 75, 'CitroënAMIVert8');

INSERT INTO facturation (id_facturation, id_vehicule, id_entreprise, dateD_facturation, dateF_facturation, valeur_facturation, etat_facturation) VALUES
(1, 2, 4, '2020-12-1', '2021-01-01', 6400, 'réglement fait'),
(2, 5, 2, '2020-11-20', NULL, 5250, 'réglement_non_termine(mensualités)'),
(3, 1, 2, '2020-11-30', '2020-12-20', 945, 'réglement fait');