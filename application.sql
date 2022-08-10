-- Apaga e recria banco de dados:
DROP DATABASE IF EXISTS application;
CREATE DATABASE application CHARACTER SET utf8 COLLATE utf8_general_ci;
USE application;

-- Cria tabela de usuários:
CREATE TABLE users (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    birth DATE NOT NULL,
    avatar VARCHAR(255) NOT NULL,
    bio TEXT,
    type ENUM('user', 'author', 'moderator', 'admin') DEFAULT 'user',
    status ENUM('active', 'inactive', 'deleted') DEFAULT 'active'
);

-- Insere alguns usuários para testes:
INSERT INTO users (
    name,
    email,
    password,
    avatar,
    birth,
    bio,
    type
) VALUES (
    'Joca da Silva',
    'joca@silva.com',
    SHA1('12345_Qwerty'),
    'https://randomuser.me/api/portraits/men/89.jpg',
    '2000-10-14',
    'Comentador, organizador, enrolador e coach.',
    'admin'
), (
    'Marineuza Siriliano',
    'mari@neuza.com',
    SHA1('12345_Qwerty'),
    'https://randomuser.me/api/portraits/women/22.jpg',
    '1998-02-27',
    'Especialista, modelista, arquivista e cientista.',
    'author'
), (
    'Setembrino Trocatapas',
    'set@tapas.net',
    SHA1('12345_Qwerty'),
    'https://randomuser.me/api/portraits/men/22.jpg',
    '1982-12-01',
    'Especialista em caçar o Patolino.',
    'author'
), (
    'Hermenegilda Sanguesuga',
    'hernema@sangue.suga',
    SHA1('12345_Qwerty'),
    'https://randomuser.me/api/portraits/women/12.jpg',
    '2002-03-03',
    'Formada em controle de pragas transdimensionais.',
    'author'
), (
    'Josyswaldo Penalha',
    'josy@waldinho.atc',
    SHA1('12345_Qwerty'),
    'https://randomuser.me/api/portraits/men/12.jpg',
    '2009-11-15',
    'Motorista de Uber sem rodas.',
    'user'
), (
    'Genensiana Astasiana',
    'genesia@astasia.ana',
    SHA1('12345_Qwerty'),
    'https://randomuser.me/api/portraits/women/42.jpg',
    '2011-07-16',
    'Contrabandista de códigos fonte Clipper e Pascal.',
    'user'
);