<?php
include 'database.php';

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$ano_publicacao = $_POST['ano_publicacao'];

$nome_arquivo = $_FILES['arquivo']['name'];
$tmp_arquivo = $_FILES['arquivo']['tmp_name'];

$arquivo = file_get_contents($tmp_arquivo);
$arquivo = mysqli_real_escape_string($conn, $arquivo);

$sql = "INSERT INTO livros (titulo, autor, ano_publicacao, arquivo) VALUES ('$titulo', '$autor', '$ano_publicacao', '$arquivo')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Erro ao adicionar livro: " . $conn->error;
}

$conn->close();
?>
