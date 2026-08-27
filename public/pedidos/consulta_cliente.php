<?php include '../../infra/conexao.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Consulta de Pedidos</title></head>
<body>
    <h2>Histórico de Pedidos por Cliente</h2>
    <form method="GET">
        <label>Cliente:</label>
        <select name="cliente_id" required>
            <option value="">Selecione...</option>
            <?php
                $clientes = $conn->query("SELECT id, nome FROM clientes");
                while ($c = $clientes->fetch_assoc()) {
                    $sel = (isset($_GET['cliente_id']) && $_GET['cliente_id'] == $c['id']) ? 'selected' : '';
                    echo "<option value='{$c['id']}' $sel>{$c['nome']}</option>";
                }
            ?>
        </select>
        <button type="submit">Pesquisar</button>
    </form>
    <br>

    <?php if(isset($_GET['cliente_id'])): 
        $cliente_id = $_GET['cliente_id'];
        $sql = "SELECT p.id, r.nome AS restaurante, p.valor, p.status_p, p.data_pedido 
                FROM pedidos p
                JOIN restaurantes r ON p.restaurante_id = r.id
                WHERE p.cliente_id = $cliente_id ORDER BY p.data_pedido DESC";
        $resultado = $conn->query($sql);
    ?>
        <table border="1">
            <tr> <th>Restaurante</th> <th>Valor (R$)</th> <th>Status</th> <th>Data</th> </tr>
            <?php if($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['restaurante']; ?></td>
                        <td><?php echo number_format($row['valor'], 2, ',', '.'); ?></td>
                        <td><?php echo $row['status_p']; ?></td>
                        <td><?php echo date("d/m/Y H:i", strtotime($row['data_pedido'])); ?></td>
                    </tr>
            <?php } } else { echo "<tr><td colspan='4'>Nenhum pedido encontrado.</td></tr>"; } ?>
        </table>
    <?php endif; ?>
    <br><button onclick="window.location.href='../../index.php'">Voltar</button>
</body>
</html>