CREATE TABLE IF NOT EXISTS livros (
    id_livro INT AUTO_INCREMENT PRIMARY KEY,
    TITULO VARCHAR(100) NOT NULL,
    AUTOR VARCHAR(100) NOT NULL,
    GENERO VARCHAR(100) NOT NULL,
    STATUS ENUM('Lendo', 'Concluído') NOT NULL,
    NOTA TINYINT(1) CHECK (NOTA BETWEEN 1 AND 5),
    RESUMO TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
