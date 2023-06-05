<?php
include 'database.php';

$id = $_GET['id'];

$sql = "SELECT * FROM livros WHERE id='$id'";
$result = $conn->query($sql);

if ($result !== false && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome_arquivo = $row['arquivo_nome'];
    $arquivo = $row['arquivo'];

    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename='".$nome_arquivo."'");
    echo $arquivo;
} else {
    echo "Arquivo não encontrado.";
}

$conn->close();
?>
