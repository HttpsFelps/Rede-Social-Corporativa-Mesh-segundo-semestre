<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['email_usuario'])) {
    // Redireciona para a página de login se o usuário não estiver logado
    header("Location: index.html");
    exit();
}

// Conecta ao banco de dados
include 'conexao.php';

// Obtém o e-mail do usuário logado da sessão
$email = $_SESSION['email_usuario'];

// Inicializa as variáveis
$imagem = isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK ? file_get_contents($_FILES['imagem']['tmp_name']) : null;
$instagram = isset($_POST['instagram']) ? mysql_real_escape_string($_POST['instagram']) : '';
$linkedin = isset($_POST['linkedin']) ? mysql_real_escape_string($_POST['linkedin']) : '';
$facebook = isset($_POST['facebook']) ? mysql_real_escape_string($_POST['facebook']) : '';
$cargo = isset($_POST['cargo']) ? mysql_real_escape_string($_POST['cargo']) : '';
$empresa = isset($_POST['empresa']) ? mysql_real_escape_string($_POST['empresa']) : '';
$nasc = isset($_POST['nasc']) ? mysql_real_escape_string($_POST['nasc']) : '';
$telefone = isset($_POST['telefone']) ? mysql_real_escape_string($_POST['telefone']) : '';
$habilidade = isset($_POST['habilidade']) ? mysql_real_escape_string($_POST['habilidade']) : '';
$interesses = isset($_POST['interesses']) ? mysql_real_escape_string($_POST['interesses']) : '';
$estado = isset($_POST['estado']) ? mysql_real_escape_string($_POST['estado']) : '';
$cidade = isset($_POST['cidade']) ? mysql_real_escape_string($_POST['cidade']) : '';

// Monta a consulta de atualização
$sql = "UPDATE tb_contas SET ";

if ($imagem !== null) {
    $sql .= "imagem = '" . mysql_real_escape_string($imagem) . "', ";
}
$sql .= "Instagram = '$instagram', ";
$sql .= "Linkedin = '$linkedin', ";
$sql .= "Facebook = '$facebook', ";
$sql .= "Cargo = '$cargo', ";
$sql .= "Empresa = '$empresa', ";
$sql .= "Data_Nascimento = '$nasc', ";
$sql .= "Telefone = '$telefone', ";
$sql .= "Habilidades = '$habilidade', ";
$sql .= "Interesses = '$interesses', ";
$sql .= "Estado = '$estado', ";
$sql .= "Cidade = '$cidade' ";

$sql .= "WHERE Email = '$email'";

// Executa a consulta
if (mysql_query($sql)) {
    echo "Informações atualizadas com sucesso.";
    header("Location: mainperfil.php");
    exit();
} else {
    echo "Erro ao atualizar informações: " . mysql_error();
}

// Fecha a conexão com o banco de dados
mysql_close();
?>
