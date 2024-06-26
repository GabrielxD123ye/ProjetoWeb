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
if (isset($_SESSION['erro1']) and $_SESSION['erro1']) {
    $erro = "<div class='alert alert-danger' role='alert' style=' border: 1px solid red; margin-top:13px; font-weight:bold; padding-top:3px; padding-bottom:3px;'> Email ou usuário já existem!
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
    <title>Cadastro</title>
    <link rel="icon" href="https://static.thenounproject.com/png/122214-200.png">
    <head>
        <style>
            .form-control:focus {
                border: 1px solid grey;
                box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0.0);
            }
        </style>


        
    </head>
    <body style="background-color:#242629; overflow: hidden;">
        <nav class="navbar navbar-expand-sm" style="background-color:darkslategrey; z-index:2;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="float:left">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse flex-grow-0" id="navbarNav">
                    <ul class="navbar-nav me-auto">  <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php" style="color:white; font-size:26px; padding-right:10px; font-weight:bold;">Inicio</a>
                        </li>
                        <li class="nav-item dropdown" style="font-size:26px;">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><span style="color:white; font-weight:bold;">Jogos</span>

                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="padding-right:10px; ">
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
                        <a class="nav-link active" aria-current="page" href="login.php" style="color:lightblue; font-size:20px; text-align:right; text-shadow: 1px 1px #000000; font-weight:bold;">Fazer Login</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="fadeInFromBottom">
        <div class="container d-flex justify-content-center align-items-center vh-100 " style="margin-top:50% 50%; z-index:-1;">
            <div class="card shadow-sm" style="max-width: 400px;">
                <div class="card-body" style="background: linear-gradient(rgba(107,107,107,0.3921848568528974) 100%, rgba(1,1,1,1) 50%);">
                    <h3 class="card-title text-center mb-4">Cadastro</h3>
                    <form action="cadastro_inserir.php" method="POST">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome Usuario (Nickname)</label>
                            <input id="nome" type="text" class="form-control" name="nomecad" placeholder="Digite seu nome de usuario" required>
                            <div id="name-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id ="email" type="email" class="form-control" name="emailcad" placeholder="Digite seu email" required>
                            <div id="email-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input id ="senha" type="password" class="form-control" name="senhacad" placeholder="Digite sua senha" required>
                            <div id="password-error"></div>
                        </div>
                        <?php
                        echo $erro;
                        unset($_SESSION['erro1']);
                        ?>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100 value=submit">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-OgwmRWzUGE9VNw6aJfwdgnvwTbkKcwQzT5nlwGkE2riVVkJRLaXvBVbvTqQ8PwHd" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                $('input[type="text"], input[type="email"], input[type="password"]').on('input', function () {
                    var minLength = 4; // Minimum length required for input fields
                    var $input = $(this);

                    // Check input length and apply invalid-input class if necessary
                    if ($input.val().length < minLength) {
                        $input.addClass('invalid-input');
                        $input.removeClass('valid-input');
                    } else {
                        $input.removeClass('invalid-input');
                        $input.addClass('valid-input');
                    }

                    // Check if the input is the password field and apply additional validation
                    if ($input.attr('name') === 'senhacad') {
                        if ($input.val().length < 8) {
                            $input.addClass('invalid-input');
                            $input.removeClass('valid-input');
                        } else {
                            $input.removeClass('invalid-input');
                            $input.addClass('valid-input');
                        }
                    }
                    if ($input.attr('name') === 'emailcad') {
                        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (emailRegex.test($input.val())) {
                            $input.addClass('valid-input');
                            $input.removeClass('invalid-input');
                        } else {
                            $input.removeClass('valid-input');
                            $input.addClass('invalid-input');
                        }
                    }
                });

                $('form').submit(function (event) {
                    // Prevent the form from submitting normally
                    event.preventDefault();

                    var input_pass = document.getElementById("senha");
                    var input_nome = document.getElementById("nome");
                    var input_email = document.getElementById("email");
                    var password = $('input[name="senhacad"]').val();
                    var nome = $('input[name="nomecad"]').val();
                    var email = $('input[name="emailcad"]').val();
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    var ok = true; // Variável para controlar se o formulário pode ser enviado

                    // Limpa mensagens de erro anteriores
                    $('#password-error').empty();
                    $('#name-error').empty();
                    $('#email-error').empty();

                    // Check password length
                    if (password.length < 8) {
                        $('#password-error').html('<div class="alert alert-danger" style="border: 1px solid red; margin-top:13px; font-weight:bold; padding-top:3px; padding-bottom:3px;" role="alert">Senha muito pequena, mínimo de 8 caracteres!</div>');
                        ok = false; // Define ok como false se houver um erro
                    }

                    // Check name length
                    if (nome.length < 4) {
                        $('#name-error').html('<div class="alert alert-danger" style="border: 1px solid red; margin-top:13px; font-weight:bold; padding-top:3px; padding-bottom:3px;" role="alert">Nome muito pequeno, mínimo de 4 caracteres!</div>');
                        ok = false;
                    } else if (nome.length > 20) {
                        $('#name-error').html('<div class="alert alert-danger" style="border: 1px solid red; margin-top:13px; font-weight:bold; padding-top:3px; padding-bottom:3px;" role="alert">Nome muito grande, máximo de 20 caracteres!</div>');
                        ok = false;
                    }

                    // Check email
                    if (!emailRegex.test(email)) {
                        $('#email-error').html('<div class="alert alert-danger" style="border: 1px solid red; margin-top:13px; font-weight:bold; padding-top:3px; padding-bottom:3px;" role="alert">Email inválido!</div>');
                        ok = false;
                    }

                    // Se todos os campos estiverem corretos, envie o formulário
                    if (ok) {
                        $(this).off('submit').submit();
                    }
                });

// Monitora mudanças nos campos de entrada para validar continuamente o número de caracteres
                $('input[name="senhacad"]').on('input', function () {
                    var password = $(this).val();
                    if (password.length >= 8) {
                        $('#password-error').empty();
                    } else {
                        $('#password-error').html('<div class="alert alert-danger" style="border: 1px solid red; margin-top:13px; font-weight:bold; padding-top:3px; padding-bottom:3px;" role="alert">Senha muito pequena, mínimo de 8 caracteres!</div>');
                    }
                });

                $('input[name="nomecad"]').on('input', function () {
                    var nome = $(this).val();
                    if (nome.length >= 4 && nome.length <= 20) {
                        $('#name-error').empty();
                    } else {
                        if (nome.length < 4) {
                            $('#name-error').html('<div class="alert alert-danger" style="border: 1px solid red; margin-top:13px; font-weight:bold; padding-top:3px; padding-bottom:3px;" role="alert">Nome muito pequeno, mínimo de 4 caracteres!</div>');
                        } else {
                            $('#name-error').html('<div class="alert alert-danger" style="border: 1px solid red; margin-top:13px; font-weight:bold; padding-top:3px; padding-bottom:3px;" role="alert">Nome muito grande, máximo de 20 caracteres!</div>');
                        }
                    }
                });

                $('input[name="emailcad"]').on('input', function () {
                    var email = $(this).val();
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (emailRegex.test(email)) {
                        $('#email-error').empty();
                    } else {
                        $('#email-error').html('<div class="alert alert-danger" style="border: 1px solid red; margin-top:13px; font-weight:bold; padding-top:3px; padding-bottom:3px;" role="alert">Email inválido!</div>');
                    }
                });
            });
        </script>





    </body>


</html>