<?php

session_start();
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php

if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
    session_unset();
    echo "<link href='css2/estilos.css' type='text/css' rel='stylesheet'> "
    . "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js'></script>"
    . "<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css' rel='stylesheet'>"; // Adiciona o link para o CSS customizado
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                // Altera o background da página
                document.body.style.backgroundColor = '#37363d';
                
                Swal.fire({
                    title: 'Erro!',
                    text: 'Esta página só pode ser acessada por usuário logado!',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'custom-swal-popup'
                    },
                    allowOutsideClick: false, // Evita fechar ao clicar fora do alerta
                    timer: 3000,
                    timerProgressBar: true
                }).then((result) => {
                    window.location.href = 'login.php';
                });

                // Caso o SweetAlert2 seja fechado pelo temporizador, redirecionar para a página de login
                Swal.getTimerLeft();
                const timerInterval = setInterval(() => {
                    if (Swal.getTimerLeft() <= 0) {
                        clearInterval(timerInterval);
                        window.location.href = 'login.php';
                    }
                }, 100);
            });
          </script>";
    exit; // Certifique-se de parar a execução do script após redirecionar
}

require('conecta.php');

    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
    }
     if (!isset($_POST['username']) && !isset($_POST['email']) && 
    (!isset($_FILES['profile_pic']) || $_FILES['profile_pic']['error'] !== UPLOAD_ERR_OK)) {
    echo "<script>
            window.location.href = 'editar_usuario.php';
          </script>";
    exit;
}

    $nome = $_POST['username'];
    $email = $_POST['email'];
    $img_perfil = $_FILES['profile_pic'];
    $ok = true;
    
   

    $tenta_achar = "SELECT * FROM usuario WHERE email='$email' or nome_usuario='$nome' AND id_usuario <> '$id_usuario'";
    $resultado = $conecta->query($tenta_achar);


    if ($resultado->num_rows > 0) {

        while ($row = $resultado->fetch_assoc()) {

            if ($row['id_usuario'] != $id_usuario) {
                $_SESSION['erroinfo'] = true;
                echo "<script>
                    window.location.href = 'editar_usuario.php';
                    </script>";
                $ok = false;
                break;
            }
        }
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $ok = false;
    }
    if ((!isset($nome) or empty($nome))) {
        $ok = false;
    }
    if (!isset($email) or empty($email)) {
        $ok = false;
    }
    if($ok) {
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0 && $_FILES['profile_pic']['size'] > 0) {
    // Verifica se o arquivo enviado é uma imagem válida
    $tipoArquivo = $_FILES['profile_pic']['type'];
    if (!in_array($tipoArquivo, ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])) {
        echo "Erro: Tipo de arquivo inválido.";
        exit;
    }

    // Nome do arquivo enviado
    $nomeArquivo = $_FILES['profile_pic']['name'];
    // Substitui espaços por sublinhados no nome do arquivo
    $nomeArquivo = str_replace(' ', '_', $nomeArquivo);
    // Diretório onde os arquivos de imagem do usuário são armazenados
    $diretorio = "imagem_usuario/";

    // Verifica se o arquivo já existe no diretório
    $contador = 0;
    $nomeArquivoOriginal = $nomeArquivo;
    while (file_exists($diretorio . $nomeArquivo)) {
        $contador++;
        $nomeArquivo = pathinfo($nomeArquivoOriginal, PATHINFO_FILENAME) . '_' . $contador . '.' . pathinfo($nomeArquivoOriginal, PATHINFO_EXTENSION);
    }

    // Move o arquivo enviado para o diretório de imagens do usuário
    move_uploaded_file($_FILES['profile_pic']['tmp_name'], $diretorio . $nomeArquivo);

    // Caminho completo da nova imagem
    $linkImagem = $diretorio . $nomeArquivo;

    // Se houver uma nova imagem, exclui a imagem antiga antes de atualizar o banco de dados
    $sql_select_img = "SELECT img_perfil FROM usuario WHERE id_usuario = $id_usuario";
$result = $conecta->query($sql_select_img);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $caminhoImagemAntiga = $row['img_perfil'];
    $cabelo = $row['img_perfil'];
} else {
    // Defina um valor padrão para $cabelo, se necessário
    $cabelo = "imagens/user-icon.png";
}

// Verifica se um novo arquivo de imagem foi enviado
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0 && $_FILES['profile_pic']['size'] > 0) {
    if ($caminhoImagemAntiga !== null && $caminhoImagemAntiga !== 'imagens/user-icon.png' && $caminhoImagemAntiga !== $linkImagem) {
            unlink($caminhoImagemAntiga);
        }

    $sql2 = "UPDATE usuario SET img_perfil='$linkImagem' WHERE id_usuario = $id_usuario";

if ($conecta->query($sql2) === TRUE) {
    $_SESSION['login'] = $email;
    echo "<link href='css2/estilos.css' type='text/css' rel='stylesheet'> 
      <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js'></script>
      <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css' rel='stylesheet'>
      <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap' rel='stylesheet'>";

echo "<script>
        window.onload = function() {
            document.body.style.backgroundColor = '#37363d';
            Swal.fire({
                title: 'Sucesso!',
                text: 'Dados alterados com sucesso!',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'custom-swal-popup'
                },
                allowOutsideClick: false,
                timer: 3000,
                timerProgressBar: true
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = 'editar_usuario.php';
                } else if (result.isConfirmed) {
                    window.location.href = 'editar_usuario.php';
                }
            });
        }
      </script>";

echo "<style>
        .custom-swal-popup {
            font-family: 'Poppins', sans-serif !important;
        }
      </style>";

} else {
    echo "Erro na atualização do registro: " . $conecta->error . "<br>";
}
} else {
    
}

    }
    if (strlen($nome) > 4 and strlen($nome)< 20) {
    $sql2 = "UPDATE usuario SET email ='$email', nome_usuario = '$nome' WHERE id_usuario = $id_usuario";
    
    


if ($conecta->query($sql2) === TRUE) {
    $_SESSION['login'] = $email;
    echo "<link href='css2/estilos.css' type='text/css' rel='stylesheet'> 
      <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js'></script>
      <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css' rel='stylesheet'>
      <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap' rel='stylesheet'>";

echo "<script>
        window.onload = function() {
            document.body.style.backgroundColor = '#37363d';
            Swal.fire({
                title: 'Sucesso!',
                text: 'Dados alterados com sucesso!',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'custom-swal-popup'
                },
                allowOutsideClick: false,
                timer: 3000,
                timerProgressBar: true
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = 'editar_usuario.php';
                } else if (result.isConfirmed) {
                    window.location.href = 'editar_usuario.php';
                }
            });
        }
      </script>";

echo "<style>
        .custom-swal-popup {
            font-family: 'Poppins', sans-serif !important;
        }
      </style>";

} else {
    echo "Erro na atualização do registro: " . $conecta->error . "<br>";
}
    }else {
        echo "<script>
                window.location.href = 'editar_usuario.php';
                </script>";
    }
    }
            