<?php
session_start();
if(empty($_SESSION['nome'])) {
  echo "<script language=javascript>alert( 'Acesso Bloqueado!' );</script>";
    echo "<script language=javascript>window.location.replace('../index.html');</script>";
}
?>
<!doctype html>
<html lang="pt-br" >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Pizzaria</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/painel.css">
    <link rel="stylesheet" href="../css/form.css">
    <script src="../js/mascara.js"></script>
  </head>
  <body class="page-painel">
    <div class="grid-container">
      
            <div class="grid-x" id="cabecalho">
              	<div class="cell small-12  medium-8 large-8" id="title">
              		<img src="../img/icons/painel.png" >
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
              		<a href="../php/exit.php" class="button">SAIR</a>
              	</div>
            </div> 

             <div class="grid-x">
                <div class="cell auto"></div>
                <div class="cell small-12 medium-7 large-7">
                  <a href="../painel.php" class="alert button" id="btn-voltar" >VOLTAR</a>
                  <h2 class="form-cad">Cadastro de Cliente</h2>
                    <form method="post" action="../php/client/cadastro_client_submit.php" class="form-cad">
                     <p> Nome: <input type="text" name="nome" maxlength="50"></p>
                     <p>CPF: <input type="text" name="cpf" maxlength="14" onkeydown="javascript: fMasc( this, mCPF );"> </p>
                     <p>Email: <input type="email" name="email" maxlength="40"></p>
                     <p>Telefone: <input type="text" name="telefone" maxlength="15" onkeydown="javascript: fMasc( this, mTel );"> </p>
                     <fieldset><legend id="legenda">Endereço:</legend>
                      <p> Nº: <input type="number" name="numero" min="0" max="999999" class="input-tam"></p>
                      <p> Rua: <input type="text" name="rua" maxlength="20" class="input-tam"></p>
                      <p> Bairro: <input type="text" name="bairro" maxlength="20" class="input-tam"></p><br/>
                     </fieldset>

                     <input type="submit" name="btn" class="button" id="btn-cad" value="Cadastrar">

                    </form>
                </div>
                <div class="cell auto"></div>
             </div>

    </div>


    <script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>
  </body>
</html>