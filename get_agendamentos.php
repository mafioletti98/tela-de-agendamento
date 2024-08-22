<?php
header('Content-Type: application/json');
include 'database.php';

//$query = "SELECT * FROM cadastro.v_lote WHERE status = 'AGENDADO'";
$query = "SELECT bql, nome_cadastrador, status, agendamento_data, agendamento_hora, observacao
	FROM cadastro.v_lote WHERE status = 'AGENDADO';";

try {
    // Prepara e executa a consulta
    $stmt = $conn->prepare($query);
    $stmt->execute();
    
    // Busca todos os resultados como um array associativo
    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Retorna os resultados como JSON
    echo json_encode($agendamentos);
} catch (Exception $e) {
    // Em caso de erro, retorna uma mensagem de erro
    echo json_encode(['message' => 'Erro ao buscar agendamentos: ' . $e->getMessage()]);
}
