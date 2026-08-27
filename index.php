<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Delivery</title>
</head>
<body>
    <h2>Plataforma de Delivery</h2>

    <button type="button" onclick="window.location.href='public/clientes/add_cliente.php'">Cadastrar Cliente</button>
    <button type="button" onclick="window.location.href='public/restaurantes/add_restaurante.php'">Cadastrar Restaurante</button>
    <button type="button" onclick="window.location.href='public/pedidos/add_pedido.php'">Cadastrar Pedido</button>
    <button type="button" onclick="window.location.href='public/pedidos/consulta_cliente.php'">Consultar Pedidos por Cliente</button>

    <br><br>

    <h2>Lista de Clientes</h2>
    <table border="1">
        <tr>
            <th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Endereço</th><th>Ações</th>
        </tr>
        <?php
        include 'infra/conexao.php';
        $clientes = $conn->query("SELECT * FROM clientes");
        while ($cliente = $clientes->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $cliente['id']; ?></td>
                <td><?php echo $cliente['nome']; ?></td>
                <td><?php echo $cliente['email']; ?></td>
                <td><?php echo $cliente['telefone']; ?></td>
                <td><?php echo $cliente['endereco']; ?></td>
                <td>
                    <button type="button" onclick="window.location.href='public/clientes/edit_cliente.php?id=<?php echo $cliente['id']; ?>'">Editar</button>
                    <button type="button" onclick="if (confirm('Excluir cliente?')) { window.location.href='public/clientes/delete_cliente.php?id=<?php echo $cliente['id']; ?>'; }">Excluir</button>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Lista de Restaurantes</h2>
    <table border="1">
        <tr>
            <th>ID</th><th>Nome</th><th>Categoria</th><th>Telefone</th><th>Endereço</th><th>Ações</th>
        </tr>
        <?php
        $restaurantes = $conn->query("SELECT * FROM restaurantes");
        while ($restaurante = $restaurantes->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $restaurante['id']; ?></td>
                <td><?php echo $restaurante['nome']; ?></td>
                <td><?php echo $restaurante['categoria']; ?></td>
                <td><?php echo $restaurante['telefone']; ?></td>
                <td><?php echo $restaurante['endereco']; ?></td>
                <td>
                    <button type="button" onclick="window.location.href='public/restaurantes/edit_restaurante.php?id=<?php echo $restaurante['id']; ?>'">Editar</button>
                    <button type="button" onclick="if (confirm('Excluir restaurante?')) { window.location.href='public/restaurantes/delete_restaurante.php?id=<?php echo $restaurante['id']; ?>'; }">Excluir</button>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Lista de Pedidos</h2>
    <table border="1">
        <tr>
            <th>ID Pedido</th><th>Cliente</th><th>Restaurante</th><th>Valor (R$)</th><th>Status</th><th>Ações</th>
        </tr>
        <?php
        $sqlPedidos = "SELECT p.id, c.nome AS cliente_nome, r.nome AS restaurante_nome, p.valor, p.status_p 
                       FROM pedidos p
                       JOIN clientes c ON p.cliente_id = c.id
                       JOIN restaurantes r ON p.restaurante_id = r.id";
        $pedidos = $conn->query($sqlPedidos);
        while ($pedido = $pedidos->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $pedido['id']; ?></td>
                <td><?php echo $pedido['cliente_nome']; ?></td>
                <td><?php echo $pedido['restaurante_nome']; ?></td>
                <td><?php echo number_format($pedido['valor'], 2, ',', '.'); ?></td>
                <td><?php echo $pedido['status_p']; ?></td>
                <td>
                    <button type="button" onclick="window.location.href='public/pedidos/edit_pedido.php?id=<?php echo $pedido['id']; ?>'">Editar</button>
                    <button type="button" onclick="if (confirm('Excluir pedido?')) { window.location.href='public/pedidos/delete_pedido.php?id=<?php echo $pedido['id']; ?>'; }">Excluir</button>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>