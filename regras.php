<?php
session_start(); 
require 'conexao.php'; 

// Consultando o leaderboard
$query = "SELECT nome, vitorias FROM leaderboard ORDER BY vitorias DESC";
$result = mysql_query($query);

// Armazenando os resultados do leaderboard em um array
$ranking = [];
while ($row = mysql_fetch_assoc($result)) {
    $ranking[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regras do Jogo</title>
    <link rel="stylesheet" href="jogo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Regras do Jogo</h1>
        <ul>
         <h2><li>Pedra ganha de Tesoura e Lagarto</li>
            <li>Papel ganha de Pedra e Spock</li>
            <li>Tesoura ganha de Papel e Lagarto</li>
            <li>Lagarto ganha de Papel e Spock</li>
            <li>Spock ganha de Tesoura e Pedra</li> </2>
        </ul>
        <a href="jogo.php" class="link">
        <a href="jogo.php" class="link">
            <br>
    <h4>Voltar ao Jogo</h4> <i class="fas fa-arrow-left"></i>
</a>

    </div>
</body>
</html>
