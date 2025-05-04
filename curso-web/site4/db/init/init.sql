CREATE TABLE IF NOT EXISTS compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto VARCHAR(255),
    preco DECIMAL(10,2),
    dia_da_semana INT
);

INSERT INTO compras (produto, preco, dia_da_semana) VALUES
('Arroz', 20.90, 1),
('Feijão', 8.50, 2),
('Macarrão', 4.30, 3),
('Leite', 6.00, 4),
('Café', 12.90, 5),
('Açúcar', 3.50, 6),
('Sal', 2.00, 7),
('Farinha', 5.20, 1),
('Carne', 34.90, 2),
('Frango', 17.80, 3),
('Peixe', 22.00, 4),
('Ovo', 10.00, 5),
('Manteiga', 9.70, 6),
('Refrigerante', 6.99, 7),
('Suco', 4.99, 1),
('Sabão', 3.49, 2),
('Detergente', 2.99, 3),
('Papel Higiênico', 7.89, 4),
('Shampoo', 10.00, 5),
('Condicionador', 11.00, 6);
