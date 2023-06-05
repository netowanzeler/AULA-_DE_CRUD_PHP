# AULA_DE_CRUD_PHP
Esse projeto destina-se ao entendimento de um sistema que utiliza o CRUD. Aqui será abordado de forma prática o CRUD, facilitando o entendimento para todos aqueles que ainda não entende a lógica utilizada nele. Este projeto utilizará as tecnologias PHP, PHPMYADMIN(SQL), HTML.

Elaborei um passo a passo, onde seguindo-o, será capaz de criar um sistema com o CRUD. 

Passo 1: Configuração do banco de dados
Começaremos criando o banco de dados e a tabela para armazenar nossos dados. Vou usar um exemplo simples de um sistema de gerenciamento de livros.

Abra o console ou a interface do MySQL e execute o seguinte comando para criar o banco de dados:

sql
Copy code
CREATE DATABASE livros;
Em seguida, selecione o banco de dados:

Copy code
USE livros;
Agora vamos criar a tabela livros com as colunas id, titulo, autor e ano_publicacao:

sql
Copy code
CREATE TABLE livros (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255),
  autor VARCHAR(255),
  ano_publicacao INT
);
Ótimo! Agora estamos prontos para começar a escrever nosso código em PHP.

Passo 2: Conexão com o banco de dados
Crie um arquivo chamado conexao.php e adicione o seguinte código:

php
Copy code
<?php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "livros";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
Certifique-se de substituir "seu_usuario" e "sua_senha" pelas suas credenciais do MySQL.

Passo 3: Criação do formulário
Crie um arquivo chamado index.php e adicione o seguinte código:

php
Copy code
<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Gerenciamento de Livros</title>
</head>
<body>
    <h1>Sistema de Gerenciamento de Livros</h1>

    <h2>Adicionar Livro</h2>
    <form action="adicionar.php" method="post">
        <label>Título:</label>
        <input type="text" name="titulo" required><br><br>

        <label>Autor:</label>
        <input type="text" name="autor" required><br><br>

        <label>Ano de Publicação:</label>
        <input type="text" name="ano_publicacao" required><br><br>

        <input type="submit" value="Adicionar">
    </form>

    <h2>Lista de Livros</h2>
    <?php include 'listar.php'; ?>
</body>
</html>
Este código cria um formulário para adicionar livros e também inclui o arquivo listar.php que criaremos a seguir para exibir a lista de livros.

Passo 4: Inserção de dados
Crie um arquivo chamado adicionar.php e adicione o seguinte código:

php
Copy code
<?php
include 'conexao.php';

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$ano_publicacao = $_POST['ano_publicacao'];

$sql = "INSERT INTO livros (titulo, autor, ano_publicacao) VALUES ('$titulo', '$autor', '$ano_publicacao')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Erro ao adicionar livro: " . $conn->error;
}

$conn->close();
?>
Este código recebe os dados do formulário enviado por POST, insere os dados no banco de dados e redireciona de volta para a página inicial (index.php).

Passo 5: Listagem dos dados
Crie um arquivo chamado listar.php e adicione o seguinte código:

php
Copy code
<?php
include 'conexao.php';

$sql = "SELECT * FROM livros";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Título</th><th>Autor</th><th>Ano de Publicação</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['titulo']."</td>";
        echo "<td>".$row['autor']."</td>";
        echo "<td>".$row['ano_publicacao']."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum livro encontrado.";
}

$conn->close();
?>
Este código recupera todos os livros da tabela livros e os exibe em uma tabela na página principal (index.php).

Passo 6: Atualização e exclusão de dados
Para implementar a funcionalidade de atualizar e excluir registros, vamos adicionar alguns links na tabela de listagem dos livros, dentro do arquivo listar.php. Modifique o trecho dentro do while para:

php
Copy code
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['titulo']."</td>";
    echo "<td>".$row['autor']."</td>";
    echo "<td>".$row['ano_publicacao']."</td>";
    echo "<td><a href='editar.php?id=".$row['id']."'>Editar</a></td>";
    echo "<td><a href='excluir.php?id=".$row['id']."'>Excluir</a></td>";
    echo "</tr>";
}
Agora vamos criar os arquivos editar.php e excluir.php para implementar as ações de atualização e exclusão, respectivamente.

Crie um arquivo chamado editar.php e adicione o seguinte código:

php
Copy code
<?php
include 'conexao.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano_publicacao = $_POST['ano_publicacao'];

    $sql = "UPDATE livros SET titulo='$titulo', autor='$autor', ano_publicacao='$ano_publicacao' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar livro: " . $conn->error;
    }
}

$sql = "SELECT * FROM livros WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Gerenciamento de Livros - Editar</title>
</head>
<body>
    <h2>Editar Livro</h2>
    <form action="" method="post">
        <label>Título:</label>
        <input type="text" name="titulo" value="<?php echo $row['titulo']; ?>" required><br><br>

        <label>Autor:</label>
        <input type="text" name="autor" value="<?php echo $row['autor']; ?>" required><br><br>

        <label>Ano de Publicação:</label>
        <input type="text" name="ano_publicacao" value="<?php echo $row['ano_publicacao']; ?>" required><br><br>

        <input type="submit" value="Atualizar">
    </form>
</body>
</html>
Este código exibe um formulário pré-preenchido com os dados do livro selecionado para edição. Quando o formulário é enviado, ele atualiza os dados no banco de dados.

Por fim, crie um arquivo chamado excluir.php e adicione o seguinte código:

php
Copy code
<?php
include 'conexao.php';

$id = $_GET['id'];

$sql = "DELETE FROM livros WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Erro ao excluir livro: " . $conn->error;
}

$conn->close();
?>
Este código exclui o livro com o ID especificado da tabela livros.

E isso é tudo! Agora você tem um sistema CRUD básico em PHP e MySQL. Ele permite adicionar, visualizar, editar e excluir livros. Lembre-se de criar os arquivos .php com o código correspondente e acessar o sistema através do arquivo index.php.
