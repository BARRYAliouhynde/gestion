--- table User----
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    cpassword VARCHAR(255) NOT NULL,
    role ENUM('admin', 'etudiant','professionnel') NOT NULL,
    cree_le TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
--- table taches----
CREATE TABLE taches (
    id_tache INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    user_concerne  INT NOT NULL,
    statut ENUM('A Faire', 'En cours', 'Termine') DEFAULT 'En cours',
    cree_le TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_concerne) REFERENCES users(id)
);