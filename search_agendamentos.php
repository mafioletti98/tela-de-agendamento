<?php
header('Content-Type: application/json');
include 'database.php';

$bql = isset($_GET['bql']) ? $_GET['bql'] : '';

$query = "SELECT bql, status, nome_cadastrador, agendamento_data, agendamento_hora, observacao
          FROM cadastro.v_lote";
$stmt = $pdo->prepare($query);
$stmt->execute(["%$bql%"]);

$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($agendamentos);

