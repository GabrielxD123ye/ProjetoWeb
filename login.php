<?php
session_start();
function redirect($DoDie = true) {
    echo "<script>
                window.location.href = 'index.php';
                </script>";
    if ($DoDie)
        die();
}


if (isset($_SESSION['login'])) {
    redirect();
}
if (isset($_SESSION['erro']) and $_SESSION['erro']) {
    $erro = "<div class='alert alert-danger' role='alert' style=' border: 1px solid red; margin-top:13px; font-weight:bold; padding-top:3px; padding-bottom:3px;'> Email ou senha incorretos!
                            </div>";
} else {
    $erro = "";
}
?>
<!DOCTYPE html>
<html>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css2/estilos.css">
    <title>Login</title>
    <link rel="icon" href="https://static.thenounproject.com/png/122214-200.png">
    <head>
        <style>
            .form-control:focus {
          border: 1px solid grey;
  box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0.0);
}
        </style>
    </head>
    <body style="background-color:#242629">
        <nav class="navbar navbar-expand-sm" style="background-color:darkslategrey; z-index:2;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="float:left">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse flex-grow-0" id="navbarNav">
                    <ul class="navbar-nav me-auto">  <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php" style="color:white; font-size:26px; padding-right:10px; font-weight:bold;">Inicio</a>
                        </li>
                        <li class="nav-item dropdown" style="font-size:26px; font-weight:bold;">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><span style="color:white;">Jogos</span>

                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="padding-right:10px;">
                                <li><a class="dropdown-item" href="jogos_recentes.php" ">Jogos recentes</a></li>
                                <li><a class="dropdown-item" href="melhores_review.php">Melhores Avaliados</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="color:white; font-size:26px; padding-right:10px; font-weight:bold;" href="reviews_usuario.php">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="color:white; font-size:26px; padding-right:10px; font-weight:bold;" href="lista_generos.php">Generos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="color:white; font-size:26px; font-weight:bold;" href="lista_jogos.php">Lista</a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="cadastro.php" style="color:lightblue; font-size:20px; text-align:right; text-shadow: 1px 1px #000000; font-weight:bold;">Cadastrar-se</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="fadeInFromBottom">
        <div class="container d-flex justify-content-center align-items-center vh-100" style="margin-top:50% 50%; z-index:-1;">
            <div class="card shadow-sm" style="max-width: 400px;">
                <div class="card-body" style="background: linear-gradient(rgba(107,107,107,0.3921848568528974) 100%, rgba(1,1,1,1) 50%);">
                    <h3 class="card-title text-center mb-4">Login</h3>
                    <form action="login_inserir.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Email</label>
                            <input type="text" class="form-control" name="nome" placeholder="Digite seu Email" maxlength="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha" placeholder="Digite sua senha" required>
                            <?php
                            echo $erro;
                            unset($_SESSION['erro']);
                            ?>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100" style="margin-top:10px;">Entrar</button>
                    </form>
                    <p>
                </div>
            </div>
        </div>
        </div>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-OgwmRWzUGE9VNw6aJfwdgnvwTbkKcwQzT5nlwGkE2riVVkJRLaXvBVbvTqQ8PwHd" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>

</html>