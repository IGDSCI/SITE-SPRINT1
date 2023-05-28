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

    $result1 = mysqli_query($conexao, "INSERT INTO tb_usuario(Login, Senha, Telefone, cpf, ID_TipoSexo, DataNasc, Estado, Cidade, ID_TipoUsu)
    VALUES ('$login', '$senha', '$telefone', '$cpf', '$sexo', '$dataNasc', '$estado', '$cidade', '$tipoUsuario')");

    if($result1) {
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
        <link rel="stylesheet" type="text/css" href="Css/style.css">
        
    </head>
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Krona+One&family=Montserrat&family=Roboto+Condensed:wght@300&display=swap');

  * {
      padding: 0px;
      margin: 0px;
    }

    :root {
      --cor-primaria: #0A2647;
      --cor-secundaria: #144272;
      --cor-terciaria: #205295;
      --cor-quaternaria: #2C74B3; 
      --cor-quintenaria: #d7d7d7;
    }

    body {
      background-image: linear-gradient(to right, #fff, #dfdfdf); 
      font-family: 'Montserrat', sans-serif;
    }

    .main-section {
      display: flex;
      justify-content: flex-start; /* Alterado para "flex-start" */
      align-items: center;
      height: 100vh;
      background-color: var(--cor-quintenaria);
    }

    .left-container,
    .right-container {
      width: 50%;
      padding: 0 20px; /* Adicionado padding horizontal para espaçamento */
    }

    .form-control {
      position: relative;
      margin-bottom: 20px;
    }

    .input-text {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }

    .side-bar {
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
      width: 3px;
      height: 60%;
      background-color: #ccc;
    }

    .span-required {
      color: red;
    }

    .input-submit {
      padding: 10px 20px;
      background-color: var(--cor-quaternaria);
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    .input-submit:hover {
      background-color: var(--cor-primaria);
    }

    .span-required {
      color: var(--cor-primaria);
    }
    .botoes-locador {
        background-color: #144272;
        margin-right: 10px;
    }

    .botoes-locatario {
        background-color: #2C74B3;
        margin-right: 10px;
    }

    @media (max-width: 768px) {
      /* Estilos para telas menores */
      .main-section {
        flex-direction: column; /* Alterado para "column" */
        justify-content: center;
        align-items: center;
        height: auto;
      }

      .left-container,
      .right-container {
        width: 100%;
        padding: 0;
      
    }
    .side-bar {
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
      width: 3px;
      height: 60%;
      background-color: #ccc;
    }
  </style

    </style>

    <body>
    <header class = "cabecalho">
        <a  href="principal.php"> <img id="logo" src="Images/LOGOALLLUGA.png"></a>
        <div class="botoes__container">
            <a href="cadastro.php" class="botoes">Cadastro</a>
            <a href="login.php" class="botoes">Entrar como locador</a>
            <a href="login2.php" class="botoes">Entrar como locatário</a>
        </div>
    </header>
        <div class="main-section">
            <div class="left-container">
                    
            </div>

            <div class="right-container">
                <div class="right-control fade-in-image"> 
                    <h2>FAÇA SEU CADASTRO</h2>
                    <form id="form" action="cadastro.php" method="POST">
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text required" id="input-login" name="login" placeholder="Login:" oninput="loginValidate()" required>
                        </div>
                        <span class = 'span-required'>Login</span>
                        <div class="form-control">  
                            <div class="side-bar"></div>
                            <input type="password" class="input-text required" id="input-senha" name="senha" placeholder="Senha:" oninput="senhaValidate()" required>
                        </div>
                        <span class = 'span-required'>Senha</span>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text required" id="input-cpf" name="cpf" placeholder="CPF:" oninput="cpfValidate()"   required>
                        </div>
                        <span class = 'span-required'>CPF</span>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text required" id="input-telefone" name="telefone" placeholder="Telefone:" oninput="telefoneValidate()"  required>
                        </div>
                        <span class = 'span-required'>Telefone</span>
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
                        <span id="erro-data"></span>
                        <div id="erro-telefone"></div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text required" id="input-cidade" name="cidade" placeholder="Cidade:" oninput="cidadeValidate()" required>
                        </div>
                        <span class = 'span-required'>Cidade</span>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text required" id="input-login" name="estado" placeholder="Estado:" oninput="estadoValidate()" required>
                        </div>
                        <span class = 'span-required'>Estado</span>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <select name="escolha" class="input-text" onclick="validateEscolha(this)" required>
                                <option value="0" >Escolha: Locador/Locatário</option>
                                <option value="2" >Locador</option>
                                <option value="3" >Locatário</option>
                            </select>
                        </div>
                        <div id="erro-escolha"></div>
                    <a href="login2.php"><h3 class="register">Entrar como Locatário</h3></a>
                    <a href="login.php"><h3 class="register">Entrar como Locador</h3></a>
                    <input class="input-submit" type="submit" name="submit" id="submit" value="ENTRAR">
                    </form>
                </div>
            </div>
        </div>
        <script>
            const inputDataNascimento = document.getElementById('data_nascimento');
            const errorText = document.getElementById("erro-data");
            inputDataNascimento.addEventListener('change', function() {   
                if (!validarDataNascimento(this.value)) {
                    errorText.innerHTML = "Sua data de nascimento está em formato errado ou você é menor de 18 anos";
                    this.value = '';
                } else{
                    errorText.innerHTML = "";
                }
            });
    
            function validateEscolha(select) {
                if (select.value === "0") {
                    select.setCustomValidity("Escolha uma opção válida.");
                } else {
                    select.setCustomValidity("");
                }
            }

            function validarDataNascimento(data) {
                // Obtém a data atual
                const dataAtual = new Date();
                
                // Obtém a data de nascimento do input e converte para um objeto Date
                const dataNascimento = new Date(data);

                // Verifica se a data de nascimento é maior que a data atual
                if (dataNascimento > dataAtual) {
                    return false;
                }

                // Calcula a idade a partir da data de nascimento
                const diffAnos = dataAtual.getFullYear() - dataNascimento.getFullYear();
                const diffMeses = dataAtual.getMonth() - dataNascimento.getMonth();
                const diffDias = dataAtual.getDate() - dataNascimento.getDate();

                // Verifica se a pessoa tem pelo menos 18 anos
                if (diffAnos < 18 || (diffAnos === 18 && diffMeses < 0) || (diffAnos === 18 && diffMeses === 0 && diffDias < 0)) {
                    return false;
                }

                // A data de nascimento é válida
                return true;
            }


            const form = document.getElementById('form');
            const campos = document.querySelectorAll('.required');
            const spans = document.querySelectorAll('.span-required');
            const regexLogin = /^\w{3,}$/; 
            const regexSenha = /^.{8,}$/;
            const regexCPF = /^\d{11}$/;
            const regexTelefone = /^\d{10,11}$/;

            form.querySelectorAll('input, select, textarea').forEach((element) => {
                element.addEventListener('change', (event) => {
                    
                if (campos[0].value.length < 3){
                    setError(0);
                    document.getElementById("submit").disabled = true;
                    return;
                } else {
                        removeError(0);
                        document.getElementById("submit").disabled = false;
                    }

                if (campos[1].value.length < 8){
                    setError(1);
                    document.getElementById("submit").disabled = true;
                    return;
                } else {
                    document.getElementById("submit").disabled = false;
                    removeError(1);
                }

                if (!regexCPF.test(campos[2].value)){
                    setError(2);
                    document.getElementById("submit").disabled = true;
                    return;
                } else {
                    document.getElementById("submit").disabled = false;
                    removeError(2);
                }
                
                if (!regexTelefone.test(campos[3].value)){
                    setError(3);
                    document.getElementById("submit").disabled = true;
                    return;
                } else {
                    document.getElementById("submit").disabled = false;
                    removeError(3);
                }

                if (campos[4].value.match(/^[A-Za-z]+$/)){
                    removeError(4);
                    document.getElementById("submit").disabled = false;
                } else {
                    document.getElementById("submit").disabled = true;
                    setError(4);
                    return;
                }

                if (campos[5].value.match(/^[A-Za-z]+$/)){
                    removeError(5);
                    document.getElementById("submit").disabled = false;
                } else {
                    document.getElementById("submit").disabled = true;
                    setError(5);
                    return;
                }

                return true;
                    
                });
            });
            


            function loginValidate(){
                if (campos[0].value.length < 3){
                    setError(0)
                    return
                } else {
                    removeError(0)
                }
            }

            function setError(index){
                campos[index].style.border = '2px solid #e63636'
                spans[index].style.display = 'block';
            }

            function removeError(index){
                campos[index].style.border = ''
                spans[index].style.display = 'none';
            }

            function senhaValidate(){
                if (campos[1].value.length < 8){
                    setError(1)
                } else {
                    removeError(1)
                }
            }

            function cpfValidate(){
                if (!regexCPF.test(campos[2].value)){
                    setError(2);
                } else {
                    removeError(2);
                }
            }

            function telefoneValidate(){
                if (!regexTelefone.test(campos[3].value)){
                    setError(3);
                } else {
                    removeError(3);
                }
            }

            function cidadeValidate(){
                if (campos[4].value.match(/^[A-Za-z]+$/)){
                    removeError(4);
                } else {
                    setError(4);
                }
            }

            function estadoValidate(){
                if (campos[5].value.match(/^[A-Za-z]+$/)){
                    removeError(5);
                } else {
                    setError(5);
                }
            }
        </script>
    </body>
</html>