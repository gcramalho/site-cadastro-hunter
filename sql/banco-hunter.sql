CREATE TABLE usuarios (
	id INT AUTO_INCREMENT PRIMARY KEY,
	login VARCHAR(30) NOT NULL,
	email VARCHAR(100) NOT NULL,
	senha VARCHAR(100)
);