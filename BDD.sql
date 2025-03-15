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