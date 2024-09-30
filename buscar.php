<?php
include 'conexao.php'; // Inclua seu arquivo de conexão

// Pegar o termo de busca enviado pelo formulário
$search = mysql_real_escape_string($_POST['search']); // Protege contra injeção SQL

// Consultar os contatos no banco de dados
$sql = "SELECT Nome, Email FROM tb_contas WHERE Nome LIKE '%$search%' LIMIT 15";

// Executar a consulta
$result = mysql_query($sql);

// Verificar se a consulta foi bem-sucedida
if (!$result) {
    die('Erro na consulta: ' . mysql_error());
}

// Exibir a lista de contatos com e-mails como links para seleção
while ($row = mysql_fetch_assoc($result)) {
    echo '<li><a href="chat.php?contato=' . urlencode($row['Nome']) . '&email=' . urlencode($row['Email']) . '">' . htmlspecialchars($row['Nome']) . '</a></li>';
}

// Fechar a conexão com o banco de dados
mysql_close();
?>
<?php
// Conexão com o banco de dados
include 'conexao.php';

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['email_usuario'])) {
    header("Location: index.html");
    exit();
}

// Definir fuso horário
date_default_timezone_set('America/Sao_Paulo');

// Captura os dados do contato selecionado (enviados via POST)
$nomeSelecionado = isset($_POST['nome_contato']) ? $_POST['nome_contato'] : '';
$emailSelecionado = isset($_POST['email_contato']) ? $_POST['email_contato'] : '';
?>

