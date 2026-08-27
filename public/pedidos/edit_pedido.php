<?php
include '../../infra/conexao.php';
$id = $_GET['id'];
$pedido = $conn->query("SELECT * FROM pedidos WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = $_POST['cliente_id']; $restaurante_id = $_POST['restaurante_id']; $valor = $_POST['valor']; $status_p = $_POST['status'];
    $sql = "UPDATE pedidos SET cliente_id='$cliente_id', restaurante_id='$restaurante_id', valor='$valor', status_p='$status_p' WHERE id=$id";
    if ($conn->query($sql) === TRUE) { echo "Atualizado!<br>"; } else { echo "Erro: " . $conn->error; }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Editar Pedido</h2>
    <form method="POST">
        <label>Cliente:</label>
        <select name="cliente_id" required>
            <?php
            $res = $conn->query("SELECT id, nome FROM clientes");
            while ($c = $res->fetch_assoc()) { 
                $sel = ($c['id'] == $pedido['cliente_id']) ? 'selected' : '';
                echo "<option value='{$c['id']}' $sel>{$c['nome']}</option>"; 
            }
            ?>
        </select><br><br>

        <label>Restaurante:</label>
        <select name="restaurante_id" required>
            <?php
            $res = $conn->query("SELECT id, nome FROM restaurantes");
            while ($r = $res->fetch_assoc()) { 
                $sel = ($r['id'] == $pedido['restaurante_id']) ? 'selected' : '';
                echo "<option value='{$r['id']}' $sel>{$r['nome']}</option>"; 
            }
            ?>
        </select><br><br>

        <label>Valor (R$):</label> <input type="number" step="0.01" name="valor" value="<?php echo $pedido['valor']; ?>" required><br><br>
        
        <label>Status:</label>
        <select name="status_p" required>
            <option value="Recebido" <?php echo ($pedido['status_p']=='Recebido')?'selected':''; ?>>Recebido</option>
            <option value="Em preparo" <?php echo ($pedido['status_p']=='Em preparo')?'selected':''; ?>>Em preparo</option>
            <option value="Em rota de entrega" <?php echo ($pedido['status_p']=='Em rota de entrega')?'selected':''; ?>>Em rota</option>
            <option value="Entregue" <?php echo ($pedido['status_p']=='Entregue')?'selected':''; ?>>Entregue</option>
        </select><br><br>
        <button type="submit">Atualizar</button>
    </form><br>
    <button onclick="window.location.href='../../index.php'">Voltar</button>
</body>
</html>