<?php
// Inclui o arquivo de conexão com o banco de dados
require("conecta.php");

// Verifica se o ID foi passado via GET
if (isset($_GET['id'])) {
    $id_livro = (int)$_GET['id'];

    // Comando SQL para deletar o livro
    $sql = "DELETE FROM livros WHERE id_livro = $id_livro";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Livro excluído com sucesso!');
                window.location.href = 'visualizador.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao excluir o livro: " . $conn->error . "');
                window.location.href = 'visualizador.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID do livro não fornecido!');
            window.location.href = 'visualizador.php';
          </script>";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
