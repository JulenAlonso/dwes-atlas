CREATE DATABASE IF NOT EXISTS dwes;
USE dwes;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
	nombre VARCHAR(50),
	password VARCHAR(25),
	CONSTRAINT pk_usuario PRIMARY KEY (nombre)
);
INSERT INTO usuarios VALUES
('admin','atlas'),('usuario','usuario');

CREATE DATABASE IF NOT EXISTS dwes;
USE dwes;
DROP TABLE IF EXISTS atlas;
CREATE TABLE atlas(
	pais VARCHAR(50),
	capital VARCHAR(50),
	CONSTRAINT pk_atlas PRIMARY KEY (pais)
);
INSERT INTO atlas
VALUES ('Francia','París'), ('Italia','Roma');
