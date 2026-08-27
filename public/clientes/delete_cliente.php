<?php
include '../../infra/conexao.php';
$id = $_GET['id'];
if ($conn->query("DELETE FROM clientes WHERE id = $id") === TRUE) {
    header("Location: ../../index.php");
} else {
    echo "Erro ao excluir cliente: O cliente possui pedidos registrados! Exclua os pedidos primeiro.";
    echo "<br><button onclick=\"window.location.href='../../index.php'\">Voltar</button>";
}
?>