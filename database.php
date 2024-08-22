<?php
// database.php
$db_nome    = "";
$db_host    = "";
$db_user    = "";
$db_pass    = "";
$dns        = "pgsql:host=$db_host;port=5432;dbname=$db_nome;user=$db_user;password=$db_pass options='--client_encoding=UTF8'";

try {
    $conn = new PDO($dns);
    $conn->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $Exception) {
    echo "<h2>Erro na conexão com o banco de dados</h2>" . $Exception->getMessage();
    exit();
}

