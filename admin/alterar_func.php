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
      function radio(id, nome, email, cargo) {
        var user = id;
        var email = email;
        var name = nome;

        var newname = name.replace(/#/g, " ");     
        
        document.getElementById("iduser").value = user;
        document.getElementById("nomeuser").value = newname;
        document.getElementById("emailuser").value = email;
        if(cargo == 1)
        {
          document.getElementById("radio2").checked = false;
          document.getElementById("radio1").checked = true;
        }
        else {
          document.getElementById("radio1").checked = false;
          document.getElementById("radio2").checked = true;
        }
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
                  <h2 class="form-cad">Atualizar Cadastro</h2>
                  <h6>Selecione o funcionário e complete o cadastro ao lado para atualizar.</h6>
                   <div>
                        <form >
                          <?php
                              try {
                                include ('../php/banco-acesso.php');
                                include ('../php/administrador/banco-admin.php');
                              } catch (Exception $e) {
                                echo "Erro: ".$i->getMessage();
                              }

                              if($_SESSION['cargo'] == 1)
                              {
                                echo "<table><tr style='text-align: center; font-weight: bolder; font-family: Arial'><td></td><td>Codigo</td><td>Nome</td><td>Cargo</td></tr>";
                            
                                $linhas = listar_tabela_func();

                                foreach ($linhas as $key => $value)
                                {
                                  echo "<tr style='text-align: center; font-family: Arial'>";
                                  $newname = str_replace(" ", "#", ucwords(strtolower($value['nome'])));
                                  
                                  echo "<td><input type='radio' name='box' onclick=radio(".$value['id'].",'".$newname."','".$value['email']."',".$value['cargo'].") id='".$value['id']."'></td>";

                                  echo "<td>$key</td>";
                                  echo "<td>".ucwords(strtolower($value['nome']))."</td>";
                                  $cargo = ($value['cargo'] == 1) ? "Administrador" : "Funcionário";
                                  echo "<td>$cargo</td>";
                                  echo "</tr>";
                                  }

                                  echo "</table>";                                  
                              }
                              else{
                                echo "<p>Você não possue permissão!!!</p>";
                              }
                            ?>  
                            </table>
                        </form>

                   </div>
                    
                </div>
                <div class="cell auto"></div>
               <div class="cell small-12 medium-5 large-5"  id="form-select">
                    <form method="post" action="../php/administrador/alterar-func-submit.php" class="form-cad">
                     <p>Código: <input type="number" name="id" id="iduser" readonly="readonly"></p>
                     <p> Nome: <input type="text" name="nome" id="nomeuser" maxlength="50"></p><br/>
                     <p>Email: <input type="email" name="email" id="emailuser" maxlength="30"></p><br/>
                     <p>Senha: <input type="password" name="senha" maxlength="15"></p><br/>
                     <fieldset><legend id="legenda">Cargo:</legend>
                       <input type="radio" name="cargo" id="radio2" value="2" checked> <label for="radio2">Funcionário</label><br/>
                       <input type="radio" name="cargo" id="radio1" value="1"> <label for="radio1">Administrador</label>
                     </fieldset>
                     <input type="submit" name="btn" class="button" id="btn-cad" value="Atualizar">
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