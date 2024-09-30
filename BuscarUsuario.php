<?php
include 'conexao.php'; // Inclua seu arquivo de conexão ao banco de dados


// Inicializa a variável para armazenar a busca
$searchTerm = '';
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $searchTerm = mysql_real_escape_string($_POST['search']);
    $query = "SELECT Nome, Email, Imagem FROM tb_contas WHERE Nome LIKE '%$searchTerm%' LIMIT 15";
    $result = mysql_query($query);
} else {
    // Caso não haja busca, retorna todos os registros (opcional)
    $query = "SELECT Nome, Email, Imagem FROM tb_contas LIMIT 15";
    $result = mysql_query($query);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Busca de Contatos</title>
    <link rel="stylesheet" href="Busca.css">
</head>

<body>


<h1>Busca de Contatos</h1>
<div class>
<form method="POST" action="busca.php" class="search-bar">
    Digite um nome: <input type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
    <input type="submit" value="Buscar">
</form>
</div>
<ul class="contacts">
<?php
if (mysql_num_rows($result) > 0) {
    while ($row = mysql_fetch_assoc($result)) {
        // Verifica se a imagem está disponível
        if (!empty($row['Imagem'])) {
            // Codifica a imagem em base64
            $imagemData = base64_encode($row['Imagem']);
            // Gera a Data URI (supondo que a imagem seja do tipo jpeg, altere se for png ou outro formato)
            $imagemSrc = 'data:image/jpeg;base64,' . $imagemData;
        } else {
            // Se não houver imagem, usa uma imagem padrão
            $imagemSrc = './Images/noPhoto.png';
        }

        echo '<li>
                <div class="d-flex bd-highlight">
                  <div class="img_cont">
                    <img src="' . $imagemSrc . '" class="rounded-circle user_img"> <!-- Imagem do BLOB exibida aqui -->
                  </div>
                  <div class="user_info">
                    <span>' . htmlspecialchars($row['Nome']) . '</span>
                  </div>
                  <div class="follow_btn">
                    <button class="btn-seguir">Seguir</button>
                  </div>
                </div>
              </li>';
    }
} else {
    echo '<li>Nenhum contato encontrado</li>';
}
?>

</ul>

</body>
</html>
