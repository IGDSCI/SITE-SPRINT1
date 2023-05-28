<?php
    session_start();

	include_once('conexao.php');


	if(!empty($_GET['search']))
	{
		$data = $_GET['search'];

		$sql2 = "SELECT * FROM tb_produto
		INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
		WHERE Nome LIKE '%$data%' OR Descricao LIKE '%$data%'OR TipoCategoria LIKE '%$data%'";
	}
	else
	{
		$sql2 = "SELECT tb_produto.*, tb_categoria.TipoCategoria
		FROM tb_produto
		INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
		ORDER BY tb_produto.ID_Produto DESC";
	}

	$result2 = $conexao->query($sql2);
	
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial - All Luga</title>
    <link rel="stylesheet" type="text/css" href="Css/style.css">
    <link href="https://googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
    <header class = "cabecalho">
        <a  href="principal.php"> <img id="logo" src="Images/LOGOALLLUGA.png"></a>
        <div class="pesquisa__itens">
                <input type="search" placeholder="Pesquisar..." id="pesquisar">
                <button id="botao__busca" onclick="searchData()"><img id="lupa" src="images/lupa.png"></button>
        </div>
        <div class="botoes__container">
            <a href="cadastro.php" class="botoes">Cadastro</a>
            <a href="login.php" class="botoes">Entrar como locador</a>
            <a href="login2.php" class="botoes">Entrar como locatário</a>
        </div>
    </header>
    <ul class="categorias">
        <li>
            <a class = "nome-categoria" href="#"><img class="icone" src="Images/icone.png">Comida</a>
        </li>
        <li>
            <a class = "nome-categoria" href="#"><img class="icone" src="Images/icone2.png">Roupa</a>
        </li>
        <li>

            <a class = "nome-categoria" href="#"><img class="icone" src="Images/icone3.png">Esporte</a>
        </li>
    </ul>

	<div class="botoes-simples">
        <a href="outra_pagina1.php" class="botao">Página 1</a>
        <a href="outra_pagina2.php" class="botao">Página 2</a>
        <a href="outra_pagina3.php" class="botao">Página 3</a>
    </div>
		<?php
			// ... código anterior ...
			// Verifica se a consulta retornou resultados
			if ($result2 && $result2->num_rows > 0) {
				echo '<div class="div-container" style="max-width: 1000px;">'; // Abre a div de container antes do loop e define a largura máxima
				$count = 0; // Inicia o contador de elementos
				// Loop sobre cada linha de resultados
				while ($linha = $result2->fetch_assoc()) {
					// Exibe os dados na tabela HTML
					echo "<div class='item' id='card-content' style='width: 19%; display: inline-block; margin-right: 1%; margin-bottom: 20px;'>";
					echo "<td><img class='imagemproduto'  width=50px src=".$linha['Foto']."></td>";
					echo "<td> <h1 class='nome-produto'>  ".$linha['Nome']."</h1></td>";			
					echo "<td> <h1 class='preco-produto'> R$   ".$linha['Preco']."</h1></td>";
					echo "<button class='botao-comprar'>Alugar</button>";
					echo "</div>";
				}
				echo '</div>';
			} else {
				echo "Nenhum registro encontrado.";
			}
		?>

        

</body>

<script>
	var search = document.getElementById('pesquisar');

	search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

</script>

</html>
