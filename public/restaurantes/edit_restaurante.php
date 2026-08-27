<?php
include '../../infra/conexao.php';
$id = $_GET['id'];
$restaurante = $conn->query("SELECT * FROM restaurantes WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome']; $categoria = $_POST['categoria']; $telefone = $_POST['telefone']; $endereco = $_POST['endereco'];
    $sql = "UPDATE restaurantes SET nome='$nome', categoria='$categoria', telefone='$telefone', endereco='$endereco' WHERE id=$id";
    if ($conn->query($sql) === TRUE) { echo "Atualizado com sucesso!<br>"; } else { echo "Erro: " . $conn->error; }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Editar Restaurante</h2>
    <form method="POST">
        <label>Nome:</label> <input type="text" name="nome" value="<?php echo $restaurante['nome']; ?>" required><br><br>
        <label>Categoria:</label> <input type="text" name="categoria" value="<?php echo $restaurante['categoria']; ?>" required><br><br>
        <label>Telefone:</label> <input type="text" name="telefone" value="<?php echo $restaurante['telefone']; ?>" required><br><br>
        <label>Endereço:</label> <input type="text" name="endereco" value="<?php echo $restaurante['endereco']; ?>" required><br><br>
        <button type="submit">Atualizar</button>
    </form> <br>  
    <button type="button" onclick="window.location.href='../../index.php'">Voltar</button>
</body>
</html>