<?php
include '../../infra/conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $sql = "INSERT INTO clientes (nome, email, telefone, endereco) VALUES ('$nome', '$email', '$telefone', '$endereco')";
    if ($conn->query($sql) === TRUE) { echo "Cliente cadastrado com sucesso!<br>"; } else { echo "Erro: " . $conn->error; }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Adicionar Cliente</h2>
    <form method="POST">
        <label>Nome:</label> <input type="text" name="nome" required><br><br>
        <label>Email:</label> <input type="email" name="email" required><br><br>
        <label>Telefone:</label> <input type="text" name="telefone" required><br><br>
        <label>Endereço:</label> <input type="text" name="endereco" required><br><br>
        <button type="submit">Cadastrar</button>
    </form> <br>  
    <button type="button" onclick="window.location.href='../../index.php'">Voltar</button>
</body>
</html>