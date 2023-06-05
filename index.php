
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula de CRUD</title>
</head>
<body>
    <h2>Adicionar Livro</h2>
    <form action="add_livro.php" method="post" enctype="multipart/form-data">
        <label>Título:</label>
        <input type="text" name="titulo" required><br><br>

        <label>Autor:</label>
        <input type="text" name="autor" required><br><br>

        <label>Ano de Publicação:</label>
        <input type="text" name="ano_publicacao" required><br><br>

        <label>Arquivo:</label>
        <input type="file" name="arquivo"><br><br>

        <input type="submit" value="Adicionar">
    </form>

    <h2>Lista de Livros</h2>
    <?php include 'listar.php'; ?>
</body>

</html>
