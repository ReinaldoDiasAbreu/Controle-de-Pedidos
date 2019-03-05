<?php
session_start();
 
//Verifico se o usuário está logado no sistema
if (!isset($_SESSION["nome"]) && !isset($_SESSION["cargo"])) {
    header("Location: ../index.html");
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
    
    <script type="text/javascript">
      function radio(id, nome, qtd, und) {
              
        var newname = nome.replace(/#/g, " ");
        
        document.getElementById("idingr").value = id;
        document.getElementById("nomeingr").value = newname;
        document.getElementById("quantingr").value = qtd;
        document.getElementById("unidingr").value = und;

      }
    </script>
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
                  <h2 class="form-cad">Atualizar Ingrediente</h2>
                  <h6>Selecione o ingrediente e complete o cadastro ao lado para atualizar.</h6>
                   <div>
                        <form >
                          <?php
                              try {
                                include ('../php/banco-acesso.php');
                                include ('../php/stock/banco-produto.php');
                              } catch (Exception $e) {
                                echo "Erro: ".$e->getMessage();
                              }

                                echo "<table><tr style='text-align: center; font-weight: bolder; font-family: Arial'><td></td><td>ID</td><td>Nome</td><td>Quantidade</td><td>Unid.</td></tr>";
                            
                                $linhas = listar_tabela_ingrediente();

                                foreach ($linhas as $key => $value)
                                {
                                  echo "<tr style='text-align: center; font-family: Arial'>";
                                  $newname = str_replace(" ", "#", ucwords(strtolower($value['nome'])));
                                  
                                echo "<td><input type='radio' name='box' onclick=radio(".$value['id'].",'".$newname."','".$value['quantidade']."','".$value['unidade']."') id='".$value['id']."'></td>";

                                  echo "<td>".$value['id']."</td>";
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
                              
                            ?>  
                            </table>
                        </form>

                   </div>
                    
                </div>
                <div class="cell auto"></div>
               <div class="cell small-12 medium-5 large-5"  id="form-select">
                     <form method="post" action="../php/stock/alterar_ingrediente_submit.php" class="form-cad">
                     <p> Código: <input type="number" name="id" id="idingr" readonly="readonly"></p>
                     <p> Nome: <input type="text" name="nome" maxlength="50" id="nomeingr"></p>
                     <p> Quantidade: <input type="number" name="quantidade" id="quantingr"> </p>
                     <label for="unidade"> Medida: </label>
                     <select name="unidade" id="unidingr">
                        <option value="1">Unidades</option>
                        <option value="2">Kilos</option>
                        <option value="3">Gramas</option>
                        <option value="4">Litros</option>
                        <option value="5">Mililitros</option>
                     </select>

                     <input type="submit" name="btn" class="button" id="btn-cad" value="Alterar">

                    </form>
               </div>
            
            </div>

    </div>


    <script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>
  </body>
</html>