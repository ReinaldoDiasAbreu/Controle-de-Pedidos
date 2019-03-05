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
                <div class="cell small-12 medium-12 large-12">
                  <a href="../painel.php" class="alert button" id="btn-voltar" >VOLTAR</a>
                  <h2 class="form-cad">Remover Ingredientes</h2>
					   <div>
						    <form action='../php/stock/remover-ingrediente-submit.php' method='post' class="form-select">
        						<?php
          							try {
                                        include ('../php/banco-acesso.php');
                                        include ('../php/stock/banco-produto.php');
                                    } catch (Exception $e) {
                                        echo "Erro: ".$e->getMessage();
                                    }
          							if($_SESSION['cargo'] == 1)
          							{
          								echo "<table><tr style='text-align: center; font-weight: bolder; font-family: Arial'><td></td><td>Codigo</td><td>Nome</td><td>Quantidade</td><td>Unid.</td></tr>";
          						
          								$linhas = listar_tabela_ingrediente();

          								foreach ($linhas as $key => $value)
          								{
          									echo "<tr style='text-align: center; font-family: Arial'>";
          									echo "<td><input type='checkbox' name=".$key." value=".$value['id']."></td>";
          									echo "<td>$key</td>";
          									echo "<td>".ucwords(strtolower($value['nome']))."</td>";
          									echo "<td>".$value['quantidade']."</td>";
                                              switch($value['unidade'])
                                              {
                                                  case 1:
                                                  echo "<td>Unidades</td>";
                                                  break;
                                                  case 2:
                                                  echo "<td>Quilos</td>";
                                                  break;
                                                  case 3:
                                                  echo "<td>Gramas</td>";
                                                  break;
                                                  case 4:
                                                  echo "<td>Litros</td>";
                                                  break;
                                                  case 5:
                                                  echo "<td>Mililitros</td>";
                                                  break;
            
                                              }
          								 	echo "</tr>";
             								}

             								echo "</table>";

             								echo "<input type='submit' class='button' value='Remover'>";
             								
          							}
          							else{
          								echo "<p>Você não possue permissão de administrador!!!</p>";
          							}
                    	?>	
							       </table>
                </form>
					   </div>
                  	
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