CREATE TABLE IF NOT EXISTS client(
    id_client INT(11) NOT NULL AUTO_INCREMENT,
    nom_client VARCHAR(40) NOT NULL,
    mdp_client TEXT NOT NULL,
    mail_client TEXT NOT NULL,
    PRIMARY KEY (id_client)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS entreprise(
    id_entreprise INT(11) NOT NULL AUTO_INCREMENT,
    nom_entreprise TEXT NOT NULL,
    mdp_entreprise TEXT NOT NULL,
    mail_entreprise TEXT NOT NULL,
    PRIMARY KEY(id_entreprise)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS vehicule(
    id_vehicule INT(11) NOT NULL AUTO_INCREMENT,
    type_vehicule TEXT NOT NULL,
    nb_vehicule INT NOT NULL,
    caract_vehicule TEXT NOT NULL,
    location_vehicule TEXT NOT NULL,
    photo_vehicule TEXT NOT NULL,
    PRIMARY KEY (id_vehicule)
)  ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS facturation(
    id_facturation INT(11) NOT NULL AUTO_INCREMENT,
    id_vehicule INT NOT NULL,
    id_entreprise INT NOT NULL,
    valeur_facturation INT NOT NULL,
    etat_faturation BOOLEAN NOT NULL,
    PRIMARY KEY (id_facturation)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE facturation
ADD ( CONSTRAINT FK_facturation_id_vehicule
    FOREIGN KEY(id_vehicule)
    REFERENCES vehicule(id_vehicule)
);

ALTER TABLE facturation
ADD ( CONSTRAINT FK_facturation_id_entreprise
    FOREIGN KEY(id_entreprise)
    REFERENCES vehicule(id_vehicule)
);

INSERT INTO client (id_client, nom_client, mdp_client ,mail_client) VALUES
(1, 'Aravindan Colbert', '1234','aravindan.colbert@mail.com'),
(2, 'Loïc Lim', 'AZERTY','loic.lim@mail.com'),
(3, 'James Martin', 'password','james.martin@mail.com'),
(4, 'Karim Karl', 'motdepasse','karim.karl@gmail.com');

INSERT INTO entreprise (id_entreprise, nom_entreprise, mdp_entreprise, mail_entreprise) VALUES