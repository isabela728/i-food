<?php
include '../../infra/conexao.php';
$id = $_GET['id'];
$cliente = $conn->query("SELECT * FROM clientes WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome']; $email = $_POST['email']; $telefone = $_POST['telefone']; $endereco = $_POST['endereco'];
    $sql = "UPDATE clientes SET nome='$nome', email='$email', telefone='$telefone', endereco='$endereco' WHERE id=$id";
    if ($conn->query($sql) === TRUE) { echo "Atualizado com sucesso!<br>"; } else { echo "Erro: " . $conn->error; }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Editar Cliente</h2>
    <form method="POST">
        <label>Nome:</label> <input type="text" name="nome" value="<?php echo $cliente['nome']; ?>" required><br><br>
        <label>Email:</label> <input type="email" name="email" value="<?php echo $cliente['email']; ?>" required><br><br>
        <label>Telefone:</label> <input type="text" name="telefone" value="<?php echo $cliente['telefone']; ?>" required><br><br>
        <label>Endereço:</label> <input type="text" name="endereco" value="<?php echo $cliente['endereco']; ?>" required><br><br>
        <button type="submit">Atualizar</button>
    </form> <br>  
    <button type="button" onclick="window.location.href='../../index.php'">Voltar</button>
</body>
</html>