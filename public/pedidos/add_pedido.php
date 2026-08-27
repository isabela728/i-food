<?php
include '../../infra/conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = $_POST['cliente_id']; $restaurante_id = $_POST['restaurante_id']; $valor = $_POST['valor']; $status_p = $_POST['status_p'];
    $sql = "INSERT INTO pedidos (cliente_id, restaurante_id, valor, status_p) VALUES ('$cliente_id', '$restaurante_id', '$valor', '$status_p')";
    if ($conn->query($sql) === TRUE) { echo "Pedido cadastrado!<br>"; } else { echo "Erro: " . $conn->error; }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Novo Pedido</h2>
    <form method="POST">
        <label>Cliente:</label>
        <select name="cliente_id" required>
            <option value="">Selecione...</option>
            <?php
            $res = $conn->query("SELECT id, nome FROM clientes");
            while ($c = $res->fetch_assoc()) { echo "<option value='{$c['id']}'>{$c['nome']}</option>"; }
            ?>
        </select><br><br>

        <label>Restaurante:</label>
        <select name="restaurante_id" required>
            <option value="">Selecione...</option>
            <?php
            $res = $conn->query("SELECT id, nome FROM restaurantes");
            while ($r = $res->fetch_assoc()) { echo "<option value='{$r['id']}'>{$r['nome']}</option>"; }
            ?>
        </select><br><br>

        <label>Valor (R$):</label> 
        <input type="number" step="0.01" name="valor" required><br><br>
        <label>Status:</label>
        <select name="status_p" required>
            <option value="Recebido">Recebido</option>
            <option value="Em preparo">Em preparo</option>
            <option value="Em rota de entrega">Em rota de entrega</option>
            <option value="Entregue">Entregue</option>
        </select><br><br>
        <button type="submit">Cadastrar</button>
    </form> <br>
    <button onclick="window.location.href='../../index.php'">Voltar</button>
</body>
</html>