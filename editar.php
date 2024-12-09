<?php
// Inclui o arquivo de conexão com o banco de dados
require("conecta.php");

// Verifica se um ID foi passado via GET
if (isset($_GET['id'])) {
    $id_livro = (int)$_GET['id'];

    // Consulta para obter os dados do livro
    $sql = "SELECT * FROM livros WHERE id_livro = $id_livro";
    $resultado = $conn->query($sql);

    // Verifica se o livro existe
    if ($resultado->num_rows > 0) {
        $livro = $resultado->fetch_assoc();
    } else {
        echo "<script>
                alert('Livro não encontrado!');
                window.location.href = 'visualizador.php';
              </script>";
        exit;
    }
} else {
    echo "<script>
            alert('ID do livro não fornecido!');
            window.location.href = 'visualizador.php';
          </script>";
    exit;
}

// Verifica se o formulário foi enviado para atualizar o livro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $autor = mysqli_real_escape_string($conn, $_POST['autor']);
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $nota = (int)$_POST['nota'];
    $resumo = mysqli_real_escape_string($conn, $_POST['resumo']);

    // Atualiza os dados do livro no banco
    $sql = "UPDATE livros 
            SET TITULO = '$titulo', AUTOR = '$autor', GENERO = '$genero', 
                STATUS = '$status', NOTA = $nota, RESUMO = '$resumo' 
            WHERE id_livro = $id_livro";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Livro atualizado com sucesso!');
                window.location.href = 'visualizador.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao atualizar o livro: " . $conn->error . "');
              </script>";
    }
}

// Fecha a conexão com o banco
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }

        form label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        form input,
        form select,
        form textarea,
        form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            background-color: #5c67f2;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #4854d6;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Editar Livro</h1>
        <form method="POST">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($livro['TITULO']); ?>" required>

            <label for="autor">Autor:</label>
            <input type="text" name="autor" id="autor" value="<?php echo htmlspecialchars($livro['AUTOR']); ?>" required>

            <label for="genero">Gênero:</label>
            <select name="genero" id="genero" required>
                <option value="" disabled>Selecione um gênero</option>
                <option value="Ficção" <?php echo ($livro['GENERO'] == 'Ficção') ? 'selected' : ''; ?>>Ficção</option>
                <option value="Não-ficção" <?php echo ($livro['GENERO'] == 'Não-ficção') ? 'selected' : ''; ?>>Não-ficção</option>
                <option value="Romance" <?php echo ($livro['GENERO'] == 'Romance') ? 'selected' : ''; ?>>Romance</option>
                <option value="Fantasia" <?php echo ($livro['GENERO'] == 'Fantasia') ? 'selected' : ''; ?>>Fantasia</option>
                <option value="Aventura" <?php echo ($livro['GENERO'] == 'Aventura') ? 'selected' : ''; ?>>Aventura</option>
                <option value="Mistério" <?php echo ($livro['GENERO'] == 'Mistério') ? 'selected' : ''; ?>>Mistério</option>
                <option value="Biografia" <?php echo ($livro['GENERO'] == 'Biografia') ? 'selected' : ''; ?>>Biografia</option>
                <option value="Histórico" <?php echo ($livro['GENERO'] == 'Histórico') ? 'selected' : ''; ?>>Histórico</option>
                <option value="Terror" <?php echo ($livro['GENERO'] == 'Terror') ? 'selected' : ''; ?>>Terror</option>
                <option value="Poesia" <?php echo ($livro['GENERO'] == 'Poesia') ? 'selected' : ''; ?>>Poesia</option>
                <option value="Ficção Científica" <?php echo ($livro['GENERO'] == 'Ficção Científica') ? 'selected' : ''; ?>>Ficção Científica</option>
            </select>

            <label for="status">Status de Leitura:</label>
            <select name="status" id="status" required>
                <option value="Lendo" <?php echo ($livro['STATUS'] == 'Lendo') ? 'selected' : ''; ?>>Lendo</option>
                <option value="Concluído" <?php echo ($livro['STATUS'] == 'Concluído') ? 'selected' : ''; ?>>Concluído</option>
            </select>

            <label for="nota">Nota (1 a 5):</label>
            <input type="number" name="nota" id="nota" min="1" max="5" value="<?php echo htmlspecialchars($livro['NOTA']); ?>" required>

            <label for="resumo">Resumo:</label>
            <textarea name="resumo" id="resumo" rows="4"><?php echo htmlspecialchars($livro['RESUMO']); ?></textarea>

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>

</html>
