CREATE DATABASE gamevault;
USE gamevault;

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL
);

CREATE TABLE plataformas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL
);

CREATE TABLE jogos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT,
    imagem_capa VARCHAR(255),
    categoria_id INT,
    plataforma_id INT,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id),
    FOREIGN KEY (plataforma_id) REFERENCES plataformas(id)
);

CREATE TABLE avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jogo_id INT NOT NULL,
    usuario_nome VARCHAR(50),
    nota INT CHECK (nota >= 1 AND nota <= 5),
    comentario TEXT,
    data_avaliacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (jogo_id) REFERENCES jogos(id) ON DELETE CASCADE
);

-- Dados Iniciais
INSERT INTO categorias (nome) VALUES ('Corrida'), ('Esportes'), ('Ação/Aventura');
INSERT INTO plataformas (nome) VALUES ('PC'), ('PlayStation 5'), ('Xbox Series');
INSERT INTO jogos (titulo, descricao, categoria_id, plataforma_id) VALUES 
('Forza Horizon 5', 'O festival de carros definitivo no México.', 1, 3),
('EA Sports FC 26', 'A nova era do futebol mundial.', 2, 2),
('God of War Ragnarok', 'Kratos e Atreus enfrentam o fim do mundo.', 3, 2);