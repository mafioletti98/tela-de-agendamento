<?php
require 'database.php';

header('Content-Type: application/json');

// Obtém o BQL do pedido
$bql = $_POST['bql'] ?? '';

$response = ['message' => ''];

if (!empty($bql)) {
    try {
        // Atualiza o status do agendamento para vazio ('')
        $stmt = $conn->prepare("UPDATE cadastro.v_lote SET status = '' WHERE bql = :bql");
        $stmt->bindParam(':bql', $bql);

        $stmt->execute();

        $response['message'] = 'Agendamento removido com sucesso.';
    } catch (Exception $e) {
        $response['message'] = 'Erro ao remover o agendamento: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'O BQL não foi fornecido.';
}


echo json_encode($response);
