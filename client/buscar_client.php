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
  </head>
  <body class="page-painel">
    <div class="grid-container">
      
            <div class="grid-x" id="cabecalho">
              	<div class="cell small-12  medium-8 large-8" id="title">
              		<img src="../img/icons/painel.png" >
              		<h1>Painel de Controle</h1>
              	</div>
              	<div class="cell small-12  medium-4 large-4">
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

                <div class="cell small-12 medium-6 large-6">
                  <a href="../painel.php" class="alert button" id="btn-voltar" >VOLTAR</a>
                  <h2 class="form-cad">Buscar Clientes</h2>

    						    <form action='buscar_client.php' method='post' class="form-select">
            						<p>Buscar: <input type="text" name="busca" maxlength="50" placeholder="Digite o nome do cliente"></p>
                        <input type="submit" name="btn" class="button" value="Buscar">
                    </form>
                    
                </div>

            <div class="cell auto"></div>
          </div>

          <div class="grid-x">
            <div class="cell small-12 medium-12 large-12">
             <table>   
              <tr style='text-align: center; font-weight: bolder; font-family: Arial'>
                <td>Código</td>
                <td>CPF</td>
                <td>Nome</td>
                <td>Email</td>
                <td>Numero</td>
                <td>Rua</td>
                <td>Bairro</td>
                <td>Telefone</td>
              </tr>

              <?php
                
                try {
                  include ('../php/banco-acesso.php');
                  include ('../php/client/banco-client.php');
                } catch (Exception $e) {
                  echo "Erro: ".$e->getMessage();
                }
                
                if(isset($_POST['busca'])){
                  $result = imprime_client_nome(strtolower($_POST['busca']));
                }
                else
                  $result = listar_tabela_client();
                                
                if($result)
                {
                    foreach ($result as $key => $value) {
                      echo "<tr style='text-align: center; font-family: Arial'>";
                      foreach ($value as $chave => $valor) {
                          if($chave == 'nome' || $chave == 'bairro' || $chave == 'rua')
                          {
                            echo "<td>".ucwords(strtolower($valor))."</td>";
                          }
                          else
                          {
                            echo "<td>$valor</td>";
                          }
                          
                      }
                      echo "</tr>";
                    }
                }
                
              ?>
             </table>
          </div>
          </div>
    </div>


    <script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>
  </body>
</html>