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
    dateF_facturation DATE NOT NULL,
    valeur_facturation INT NOT NULL,
    etat_facturation TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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