CREATE DATABASE knjiga_dojmova;
USE knjiga_dojmova;

CREATE TABLE dojmovi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ime_prezime VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    tekst TEXT NOT NULL,
    datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
