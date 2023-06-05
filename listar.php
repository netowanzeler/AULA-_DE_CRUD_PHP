<?php
include 'database.php';

$sql = "SELECT * FROM livros";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Título</th><th>Autor</th><th>Ano de Publicação</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo '<divstyle="width: 300px; background-color: red; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);">';
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['titulo']."</td>";
        echo "<td>".$row['autor']."</td>";
        echo "<td>".$row['ano_publicacao']."</td>";
        echo "<td><img src='data:image/jpeg;base64,".base64_encode($row['arquivo'])."' alt='Imagem' width='100px'></td>";
        echo "<td><a href='editar.php?id=".$row['id']."'>Editar</a></td>";
        echo "<td><a href='excluir.php?id=".$row['id']."'>Excluir</a></td>";
        echo "<td><a href='download.php?id=".$row['id']."'>Download</a></td>";
        echo "</tr>";
        echo '</div>';
    }
    echo "</table>";
} else {
    echo "Nenhum livro encontrado.";
}

$conn->close();
?>
