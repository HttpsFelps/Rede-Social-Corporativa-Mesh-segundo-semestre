<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil </title>
    <link rel="stylesheet" href="mainperfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
<?php
session_start();
$email_usuario = $_SESSION['email_usuario'];
include 'conexao.php';

$sql= "Select * From tb_contas where Email = '$email_usuario'";
$resultado = mysql_query($sql);

if ($resultado && mysql_num_rows($resultado) > 0) {
    while ($row = mysql_fetch_assoc($resultado)) {
    $nomeUsuario = htmlspecialchars($row['Nome']);
    $cidadeUsuario = htmlspecialchars($row['Cidade']);
    $instaUsuario = htmlspecialchars($row['Instagram']);
    $faceUsuario = htmlspecialchars($row['Facebook']);
    $linkedinUsuario = htmlspecialchars($row['Linkedin']);
    $seguidoresUsuario = htmlspecialchars($row['Seguidores']);
    $sobreUsuario = htmlspecialchars($row['Sobre']);
    
      // Converte a imagem do contato para base64
      if (!empty($row['Imagem'])) {
        $imagemSrc = 'data:image/jpeg;base64,' . base64_encode($row['Imagem']);
    } else {
        $imagemSrc = './Images/noPhoto.png'; // Imagem padrão
    }}}
    
        
   

?>
    <div class="container">
        <div class="profile-card">
            <div class="header">
                <div class="profile-info">
                    <h1 class="name"><?php echo htmlspecialchars($nomeUsuario); ?> </h1>
                    <p class="username"><?php echo htmlspecialchars($cidadeUsuario); ?></p>
                    <p class="bio"><?php echo htmlspecialchars($sobreUsuario); ?></p>
                    <div class="followers">
                        <img src="silueta.jpg" alt="Seguidor 1">
                        <img src="silueta.jpg" alt="Seguidor 2">
                        <span><?php echo htmlspecialchars($seguidoresUsuario); ?> seguidores</span>
                    </div>
                </div>
                <div class="profile-pic"><?php
               echo' <img src= "' . $imagemSrc . '"   alt="Foto de Perfil">'; ?>
                </div>
            </div>
            <div class="edit-profile">
            <button onclick="window.location.href='cadperfil.html';">
             <i class="fas fa-edit"></i> Editar perfil
                            </button>

               <ul class="icones"><li> <a href="<?php echo htmlspecialchars($instaUsuario); ?>" class="instagram-link" target="_blank">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="<?php echo htmlspecialchars($linkedinUsuario); ?>" class="instagram-link" target="_blank">
                    <i class="fa-brands fa-linkedin"></i>
                </a>
                <a href="<?php echo htmlspecialchars($faceUsuario); ?>" class="instagram-link" target="_blank">
                    <i class="fa-brands fa-facebook"></i>
                </a></li></ul>
            </div>
            <div class="menu">
                <ul>
                    <span>Publicações</span>
                   
                </ul>
            </div>
            <div class="threads">
            <div id="post">
<?php


// Definindo o fuso horário
date_default_timezone_set('America/Sao_Paulo');

$query = "SELECT * FROM republicar";

$resultado = mysql_query($query);

if ($resultado && mysql_num_rows($resultado) > 0) {
    while ($row = mysql_fetch_assoc($resultado)) {
    $hora = htmlspecialchars($row['Hora']);
    $dia = htmlspecialchars($row['Dia']);
    $autimg = htmlspecialchars($row['Imgautor']);
    $autor = htmlspecialchars($row['usuario_email']);
    $id = htmlspecialchars($row['Id_Posts']);

    $query = "INSERT INTO tb_posts (Autor, Conteudo, Dia, Hora, Imagem, AutImg, likes) 
    SELECT '$autor', Conteudo, '$dia', '$hora', Imagem, '$autimg', 0 
    FROM tb_posts 
    WHERE Id_Posts = $id";

    
    $result = mysql_query($query) or die('Erro na consulta: ' . mysql_error());
    $query = "DELETE FROM republicar;";
    $result = mysql_query($query) or die('Erro na consulta: ' . mysql_error());
    }}


    $email_usuario = mysql_real_escape_string($email_usuario);

    $query = "SELECT * FROM tb_posts 
    WHERE Email = '$email_usuario' ORDER BY Dia DESC, Hora DESC";
    
    
    

$result = mysql_query($query);

if ($result && mysql_num_rows($result) > 0) {
    while ($row = mysql_fetch_assoc($result)) {
        // Extrai os dados da linha do banco de dados
        $hora = htmlspecialchars($row['Hora']);
        $dataantiga = htmlspecialchars($row['Dia']);
        $autor = htmlspecialchars($row['Autor']);
        $conteudo = htmlspecialchars($row['Conteudo']);
        $img = htmlspecialchars($row['Imagem']);
        $autimg = htmlspecialchars($row['AutImg']);
        $like = htmlspecialchars($row['likes']);

        // Converte a data e hora para UTC
        $dataHora = new DateTime($dataantiga . ' ' . $hora, new DateTimeZone('America/Sao_Paulo'));
        
        $dataHoraUTC = $dataHora->format('H:i d/m/Y');

        // Exibe o post formatado
        
        echo '<div class="infoUserPost">
                <div class="imgUserPost">
                <img src="' . $autimg . '" alt="Profile Picture">
                </div>
                <div class="nameAndHour">
                <strong>' . $autor . '</strong><p>' . $dataHoraUTC . '</p>
                </div>
            </div>';
        if (!empty($conteudo)) {
            echo '<div id="contp">
                    <p>' . $conteudo . '</p>
                </div>';
        }

        if (!empty($img)) {
            echo '<div class="postImage">
                    <img src="' . $img . '" alt="Post Image">
                </div>';
        }

        echo '
    <div class="actionBtnPost">
        <button type="button" onclick="toggleLike(this, ' . $row['Id_Posts'] . ')" class="filesPost like">
            <img src="./assets/heart.png" alt="Curtir">
            <p>Curtir</p>
            <span class="likeCount">' . $like . '</span>
        </button>
        <button type="button" onclick="toggleRepublicar(this, '. $row['Id_Posts'] . ')" class="filesPost share">
            <img src="./assets/share.svg" alt="Compartilhar">
            <p>Republicar</p>
        </button>
        <form action="toggle_delete.php" method="POST">
            <input type="hidden" name="post_id" value="' . $row['Id_Posts'] . '">
            <button type="submit" class="filesPost excluir">
                <img src="./assets/lixeira.png" alt="excluir">
                <p>Excluir</p>
            </button>
        </form>
        
    </div>
    <br>
    <div class="linha"></div>
';


    }
} else {
    echo '<p>Nenhum post encontrado.</p>';
}
?>
</div>
</div>




            </div>
        </div>
       
    </div>
    <script>
    function toggleLike(button, postId) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'toggle_like.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Atualiza a contagem de likes
                const likeCountElement = button.querySelector('.likeCount');
                likeCountElement.textContent = response.newLikeCount;

                // Alterna o ícone e texto de Curtir/Descurtir
                const img = button.querySelector('img');
                const p = button.querySelector('p');
                if (response.liked) {
                    img.src = './assets/heart-filled.png';  // Ícone de curtida
                    p.textContent = 'Descurtir';
                } else {
                    img.src = './assets/heart.png';  // Ícone de não curtida
                    p.textContent = 'Curtir';
                }
            }
        }
    };

    // Envia o ID do post
    xhr.send('post_id=' + postId);
}

function toggleRepublicar(button, postId) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'toggle_republicar.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                const postsContainer = document.getElementById('post'); // Usando o ID 'post'
                
                // Insere o HTML do post diretamente na div existente
                postsContainer.insertAdjacentHTML('afterbegin', response.postHtml);
                
                alert("Republicado com sucesso!!!");
            } else {
                console.error(response.message);
            }
        }
    };

    xhr.send('post_id=' + postId);
}
</script>
</body>
</html>
