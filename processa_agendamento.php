<?php
header('Content-Type: application/json');
include 'database.php';


// Obtém os dados do formulário
$nome_cadastrador = $_POST['nome_cadastrador'] ?? '';
$agendamento_hora = $_POST['agendamento_hora'] ?? '';
$agendamento_data = $_POST['agendamento_data'] ?? '';
$observacao = $_POST['observacao'] ?? '';
$bql = $_POST['bql'] ?? '';

$response = ['message' => ''];


try {
    if (!empty($bql)) {
        // Atualiza o agendamento existente
        $stmt = $conn->prepare("
            UPDATE cadastro.v_lote
            SET nome_cadastrador = :nome_cadastrador, 
                agendamento_hora = :agendamento_hora, 
                agendamento_data = :agendamento_data, 
                observacao = :observacao 
            WHERE bql = :bql
        ");

        // Vincula os parâmetros
        $stmt->bindParam(':nome_cadastrador', $nome_cadastrador);
        $stmt->bindParam(':agendamento_hora', $agendamento_hora);
        $stmt->bindParam(':agendamento_data', $agendamento_data);
        $stmt->bindParam(':observacao', $observacao);
        $stmt->bindParam(':bql', $bql);

        // Executa a consulta
        $stmt->execute();

        $response['message'] = 'Agendamento atualizado com sucesso.';
    } else {
        $response['message'] = 'O BQL não foi fornecido.';
    }
} catch (Exception $e) {
    // Retorna mensagem de erro em caso de exceção
    $response['message'] = 'Erro ao processar o agendamento: ' . $e->getMessage();
}

// Retorna a resposta como JSON
echo json_encode($response);
