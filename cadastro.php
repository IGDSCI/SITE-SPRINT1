<?php
/* Verificar se o formulario foi submitado */
if(isset($_POST['submit']))
{
    include_once('conexao.php');

    $login = $_POST['login'];
    $senha = md5($_POST['senha']);
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['genero'];
    $dataNasc = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $tipoUsuario = $_POST['escolha'];
    $frase = '';

	
    if (!preg_match('/^[a-zA-Z0-9]{3,}$/', $login)) {
        $frase = $frase . 'O login deve ter no mínimo 3 caracteres alfanuméricos';
        $login_error = false;
    } else {
        $login_error = true;
    }


    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/', $senha)) {
        $frase = $frase . 'Senha inválida. Deve ter pelo menos 8 caracteres, incluindo pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial.';
        $login_error = false;
    } else {
        $login_error = true;
    }


    if (!preg_match('/^\d{3}\d{3}\d{3}\d{2}$/', $cpf)) {
        $frase = $frase . 'CPF inválido. Utilize o formato XXX.XXX.XXX-XX.';
        $login_error = false;
    } else {
        $login_error = true;
    }

    if (!preg_match('/^\(\d{2}\)\s\d{4,5}-\d{4}$/', $telefone)) {
        $frase = $frase . 'Telefone inválido. Utilize o formato (XX) XXXXX-XXXX ou (XX) XXXX-XXXX.';
        $login_error = false;
    } else {
        $login_error = true;
    }

    if (!preg_match('/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/', $cidade)) {
        $frase = $frase . 'Cidade inválida. Utilize apenas letras e espaços.';
        $login_error = false;
    } else {
        $login_error = true;
    }

    if (!preg_match('/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/', $estado)) {
        $frase = $frase . 'Estado inválido. Utilize apenas letras e espaços.';
        $login_error = false;
    } else {
        $login_error = true;
    }
    
    if($login_error){
        // Insere os dados na tabela tb_usuario
        $result1 = mysqli_query($conexao, "INSERT INTO tb_usuario(Login, Senha, Telefone, cpf, ID_TipoSexo, DataNasc, Estado, Cidade, ID_TipoUsu)
        VALUES ('$login', '$senha', '$telefone', '$cpf', '$sexo', '$dataNasc', '$estado', '$cidade', '$tipoUsuario')");
    } else{
        $result1 = false;
    }


    if($result1 and $login_error) {
        echo "Usuário cadastrado com sucesso!";
        if ($_POST['escolha'] == 2){
            header('Location: login.php');
        }
        if($_POST['escolha'] == 3){
            header('Location: login2.php');
        }
    } else {
        echo "Erro ao cadastrar usuário! ". $frase;
    }
}
?>

<html lang="pt-br">
    <head>
        <title> All Luga </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">  

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="Css/Cadastro.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Rubik&display=swap" rel="stylesheet">

    </head>

    <body>
        <div class="main-section">
            <div class="left-container">
                    
            </div>

            <div class="right-container">
                <div class="right-control fade-in-image"> 
                    <h2>FAÇA SEU CADASTRO</h2>
                    <form action="cadastro.php" method="POST">
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text" id="input-login" name="login" placeholder="Login:" required>
                        </div>
                        <div class="form-control">  
                            <div class="side-bar"></div>
                            <input type="password" class="input-text" id="input-senha" name="senha" placeholder="Senha:" required>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text" id="input-login" name="cpf" placeholder="CPF:" required>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text" id="input-login" name="telefone" placeholder="Telefone:" required>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <div class="input-text">
                                <input type="radio" id="masculino" name="genero" value="1"  required>
                                <label for="feminino">Masculino</label>
                                <input type="radio" id="feminino" name="genero" value="2"  required>
                                <label for="masculino">Feminino</label>
                                <input type="radio" id="naoInformar" name="genero" value="3" placeholder="nao" required>
                                <label for="naoInformar" >Não informar</label>
                            </div>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="date" name="data_nascimento" id="data_nascimento" class="input-text" required>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text" id="input-login" name="cidade" placeholder="Cidade:" required>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text" id="input-login" name="estado" placeholder="Estado:" required>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <select name="escolha" class="input-text" required>
                                <option value="0" >Escolha: Locador/Locatário</option>
                                <option value="2" >Locador</option>
                                <option value="3" >Locatário</option>
                            </select>
                        </div>
                    <a href="login2.php"><h3 class="register">Entrar como Locatário</h3></a>
                    <a href="login.php"><h3 class="register">Entrar como Locador</h3></a>
                    <input class="input-submit" type="submit" name="submit" id="submit" value="ENTRAR">
                    </form>
                </div>
            </div>
        </div>
    </body>