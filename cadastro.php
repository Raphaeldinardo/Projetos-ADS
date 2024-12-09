<?php
// Exibir todos os erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclui o arquivo de conexão com o banco de dados
require("conecta.php");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados enviados pelo formulário
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $autor = mysqli_real_escape_string($conn, $_POST['autor']);
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $nota = (int)$_POST['nota'];
    $resumo = mysqli_real_escape_string($conn, $_POST['resumo']);

    // Verificação dos valores capturados
    echo "Título: $titulo<br>";
    echo "Autor: $autor<br>";
    echo "Gênero: $genero<br>";
    echo "Status: $status<br>";
    echo "Nota: $nota<br>";
    echo "Resumo: $resumo<br>";

    // Monta a query de inserção
    $sql = "INSERT INTO livros (TITULO, AUTOR, GENERO, STATUS, NOTA, RESUMO) 
            VALUES ('$titulo', '$autor', '$genero', '$status', '$nota', '$resumo')";
    
    // Mostrar a query de inserção para depuração
    echo "Query: $sql<br>";

    // Executa a query e verifica se deu certo
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Livro cadastrado com sucesso!');
                window.location.href = 'index.html';
              </script>";
    } else {
        echo "Erro ao cadastrar o livro: " . $conn->error . "<br>";
        echo "Código de Erro: " . $conn->errno . "<br>";
        echo "Descrição do Erro: " . $conn->error_list[0]['error'] . "<br>";
    }
}

// Fecha a conexão com o banco
$conn->close();
?>
