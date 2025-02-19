-- Table des rôles
CREATE TABLE role (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL
);

-- Table des utilisateurs
CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    telephone VARCHAR(50),
    adresse VARCHAR(50),
    date_naissance DATE,
    photo LONGBLOB,
    pseudo VARCHAR(50) NOT NULL UNIQUE
);

-- Table pivot entre utilisateurs et rôles
CREATE TABLE utilisateur_role (
    utilisateur_id INT NOT NULL,
    role_id INT NOT NULL,
    PRIMARY KEY (utilisateur_id, role_id),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES role(id) ON DELETE CASCADE
);

-- Table des marques de voitures
CREATE TABLE marque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL
);

-- Table des voitures
CREATE TABLE voiture (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    marque_id INT NOT NULL,
    modele VARCHAR(50) NOT NULL,
    immatriculation VARCHAR(50) NOT NULL UNIQUE,
    energie VARCHAR(50) NOT NULL,
    couleur VARCHAR(50),
    date_premiere_immatriculation DATE NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id),
    FOREIGN KEY (marque_id) REFERENCES marque(id)
);

-- Table des avis
CREATE TABLE avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commentaire TEXT NOT NULL,
    note INT NOT NULL CHECK (note BETWEEN 1 AND 5),
    statut VARCHAR(50) NOT NULL,
    depose_par_id INT NOT NULL,
    concerne_id INT NOT NULL,
    FOREIGN KEY (depose_par_id) REFERENCES utilisateur(id),
    FOREIGN KEY (concerne_id) REFERENCES utilisateur(id)
);

-- Table des trajets de covoiturage
CREATE TABLE covoiturage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilise_id INT NOT NULL,
    date_depart DATE NOT NULL,
    heure_depart TIME NOT NULL,
    lieu_depart VARCHAR(50) NOT NULL,
    date_arivee DATE NOT NULL,
    heure_arivee TIME NOT NULL,
    lieu_arivee VARCHAR(50) NOT NULL,
    statut VARCHAR(50) NOT NULL,
    nb_place INT NOT NULL,
    prix_personne DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (utilise_id) REFERENCES voiture(id)
);

-- Table pivot entre utilisateurs et trajets de covoiturage
CREATE TABLE utilisateur_covoiturage (
    utilisateur_id INT NOT NULL,
    covoiturage_id INT NOT NULL,
    PRIMARY KEY (utilisateur_id, covoiturage_id),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id) ON DELETE CASCADE,
    FOREIGN KEY (covoiturage_id) REFERENCES covoiturage(id) ON DELETE CASCADE
);
