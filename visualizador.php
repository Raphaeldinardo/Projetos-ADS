<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Livros</title>
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
            color: #333;
        }

        .container {
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 600px;
        }

        h1 {
            color: #5c67f2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #5c67f2;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a button {
            padding: 5px 10px;
            font-size: 14px;
            color: white;
            background-color: #5c67f2;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        a button:hover {
            background-color: #4854d6;
        }

        .action-buttons a {
            margin: 0 5px;
        }

        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #5c67f2;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #4854d6;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Livros Cadastrados</h1>

        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Nota</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require("conecta.php");

                $dados_select = mysqli_query($conn, "SELECT id_livro, TITULO, AUTOR, NOTA FROM livros");

                if (mysqli_num_rows($dados_select) > 0) {
                    while ($dado = mysqli_fetch_assoc($dados_select)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($dado['TITULO']) . '</td>';
                        echo '<td>' . htmlspecialchars($dado['AUTOR']) . '</td>';
                        echo '<td>' . htmlspecialchars($dado['NOTA']) . '</td>';
                        echo '<td class="action-buttons">';
                        echo '<a href="editar.php?id=' . $dado['id_livro'] . '"><button>Editar</button></a>';
                        echo '<a href="deletar.php?id=' . $dado['id_livro'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este livro?\')"><button>Excluir</button></a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">Nenhum livro cadastrado.</td></tr>';
                }
                ?>
            </tbody>
        </table>
        <a href="index.html"><button class="back-button">Voltar</button></a>
    </div>
</body>

</html>
