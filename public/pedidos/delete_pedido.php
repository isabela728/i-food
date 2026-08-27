<?php
include '../../infra/conexao.php';
$id = $_GET['id'];
if ($conn->query("DELETE FROM pedidos WHERE id = $id") === TRUE) {
    header("Location: ../../index.php");
} else {
    echo "Erro ao excluir: " . $conn->error;
}
?>