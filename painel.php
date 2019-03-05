<?php
session_start();
if(empty($_SESSION['nome'])) {
	echo "<script language=javascript>alert( 'Acesso Bloqueado!' );</script>";
    echo "<script language=javascript>window.location.replace('index.html');</script>";
}
?>

<!doctype html>
<html lang="pt-br" >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Pizzaria</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/painel.css">
		<script type="text/javascript">
			function gopage(id)
			{
				if(id == 1){
					window.location.href = ('stock/cadastrar_ingrediente.php');
				}
				else if(id == 2){
					window.location.href = ('stock/atualizar_ingrediente.php');
				}
				else if(id == 3){
					window.location.href = ('stock/remover_ingrediente.php');
				}
			}
		</script>
  </head>
  <body class="page-painel">
    <div class="grid-container">
      
            <div class="grid-x" id="cabecalho">
              	<div class="cell small-12  medium-8 large-8" id="title">
              		<img src="img/icons/painel.png" >
              		<h1>Painel de Controle</h1>
              	</div>
              	<div class="cell small-12 medium-4 large-4">
              		<div id="usuario">
              			<?php
              			$nome = $_SESSION['nome'];
              			$cargo = $_SESSION['cargo'];
              			
              			if($cargo == 1) $cargo = "Administrador";
              			else $cargo = "Funcionário";

              			echo "<p><span id='dest'>Usuário: </span>".strtoupper($nome)."</p>";
              			echo "<p><span id='dest'>Cargo: </span>$cargo</p>";
              		?>
              		</div>
              		<a href="php/exit.php" class="button">SAIR</a>
              	</div>
            </div> 

            <div class="grid-x grid-padding-x">
                
				<div class="cell small-6  medium-6 large-6" id="conf">
					
						<fieldset>
						<legend>Pedido</legend>
						<div class="grid-x">
							<div class="cell small-12  medium-6 large-6" >
								<div class="cell small-4  medium-4 large-4" >
									<p><a href="#" class="button">Criar Pedido</a>
									<a href="#" class="button">Fazer Busca</a></p>
								</div>
								<div class="cell small-4  medium-4 large-4">
									<p><a href="#" class="button">Atualizar Pedido</a>
									<a href="#" class="button">Cancelar Pedido</a></p>
								</div>
							</div>
							<div class="hide-for-small-only" class="cell medium-6 large-6" >
								<img src="img/icons/pedido.png">
							</div>
						</div>
						</fieldset>					
				</div>

				<div class="cell auto" id="conf">
					<fieldset>
						<legend>Cliente</legend>
						<div class="grid-x">
							<div class="cell small-12  medium-6 large-6" >
								<div class="cell small-4  medium-4 large-4" >
									<p><a href="client/cadastro_client.php" class="button">Cadastrar Cliente</a>
									<a href="client/buscar_client.php" class="button">Buscar Cliente</a></p>
								</div>
								<div class="cell small-4  medium-4 large-4">
									<p><a href="client/alterar_client.php" class="button">Atualizar Cliente</a>
									<a href="client/remover_client.php" class="button">Remover Cadastro</a></p>
								</div>
							</div>
							<div class="hide-for-small-only" class="cell medium-6 large-6" >
								<img src="img/icons/cliente.png">
							</div>
						</div>
						</fieldset>
				</div>
				
			</div>

			<div class="grid-x grid-padding-x">
                
				<div class="cell small-6  medium-6 large-6" id="conf">
					<fieldset>
						<legend>Estoque</legend>
						<div class="grid-x">
							<div class="cell small-12  medium-6 large-6" >
								<div class="cell small-4  medium-4 large-4" >
									<p><a href="stock/cadastrar_produto.php" class="button">Adicionar Produto</a>
									<p><a href="#" class="button">Atualizar Produto</a>
								</div>
								<div class="cell small-4  medium-4 large-4">
									<p><a href="#" class="button">Remover Produto</a></p>
									<p><select onchange="javascript: gopage(value);">
										 		<option value="0" checked><p class="seletor">Opções Ingredientes</p></option>
                        <option value="1"><p class="seletor">Cadastrar Ingrediente</p></option>
                        <option value="2"><p class="seletor">Atualizar Ingrediente</p></option>
                        <option value="3"><p class="seletor">Remover Ingrediente</p></option>
                     </select><p>
								</div>
							</div>
							<div class="hide-for-small-only" class="cell medium-6 large-6" >
								<img src="img/icons/estoque.png">
							</div>
						</div>
						</fieldset>
				</div>
				<div class="cell auto" id="conf">
					<fieldset>
						<legend>Administração</legend>
						<div class="grid-x">
							<div class="cell small-12  medium-6 large-6" >
								<div class="cell small-4  medium-4 large-4" >
									<p><a href="admin/cadastro_func.php" class="button">Cadatrar Funcionario</a>
									<a href="admin/buscar_func.php" class="button">Buscar Funcionario</a></p>
								</div>
								<div class="cell small-4  medium-4 large-4">
									<p><a href="admin/alterar_func.php" class="button">Atualizar Cadastro</a>
									<a href="admin/remover_func.php" class="button">Remover Funcionário</a></p>
								</div>
							</div>
							<div class="hide-for-small-only" class="cell medium-6 large-6" >
								<img src="img/icons/admin.png">
							</div>
						</div>
						</fieldset>
				</div>
				
			</div>
			
    </div>


    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>