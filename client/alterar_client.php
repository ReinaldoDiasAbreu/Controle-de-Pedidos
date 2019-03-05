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
    <script src="../js/mascara.js"></script>
    <script type="text/javascript">
      function radio(id, nome, cpf, email, telefone, num, rua, bairro) {

        var user = id;
        var name = nome;
        var cpf = cpf;
        var email = email;
        var tel = telefone;
        var num = num;
        var rua = rua;
        var bairro = bairro;        

        var newname = name.replace(/#/g, " ");
        var newbairro = bairro.replace(/#/g, " ");
        var newrua = rua.replace(/#/g, " ");   
        
        document.getElementById("iduser").value = user;
        document.getElementById("nomeuser").value = newname;
        document.getElementById("cpfuser").value = cpf;
        document.getElementById("emailuser").value = email;
        document.getElementById("teluser").value = telefone;
        document.getElementById("numuser").value = num;
        document.getElementById("ruauser").value = newrua;
        document.getElementById("bairrouser").value = newbairro;

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
                  <h6>Selecione o cliente e complete o cadastro ao lado para atualizar.</h6>
                   <div>
                        <form >
                          <?php
                              try {
                                include ('../php/banco-acesso.php');
                                include ('../php/client/banco-client.php');
                              } catch (Exception $e) {
                                echo "Erro: ".$e->getMessage();
                              }

                                echo "<table><tr style='text-align: center; font-weight: bolder; font-family: Arial'><td></td><td>ID</td><td>Nome</td><td>CPF</td></tr>";
                            
                                $linhas = listar_tabela_client();

                                foreach ($linhas as $key => $value)
                                {
                                  echo "<tr style='text-align: center; font-family: Arial'>";
                                  $newname = str_replace(" ", "#", ucwords(strtolower($value['nome'])));
                                  $newrua = str_replace(" ", "#", ucwords(strtolower($value['rua'])));
                                  $newbairro = str_replace(" ", "#", ucwords(strtolower($value['bairro'])));
                                  
                                echo "<td><input type='radio' name='box' onclick=radio(".$value['id'].",'".$newname."','".$value['cpf']."','".$value['email']."','".$value['telefone']."','".$value['num']."','".$newrua."','".$newbairro."') id='".$value['id']."'></td>";

                                  echo "<td>$key</td>";
                                  echo "<td>".ucwords(strtolower($value['nome']))."</td>";
                                  echo "<td>".$value['cpf']."</td>";
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
                     <form method="post" action="../php/client/alterar_client_submit.php" class="form-cad">
                     <p> Código: <input type="number" name="id" id="iduser" readonly="readonly"></p>
                     <p> Nome: <input type="text" name="nome" maxlength="50" id="nomeuser"></p>
                     <p>CPF: <input type="text" name="cpf" maxlength="14" id="cpfuser" onkeydown="javascript: fMasc( this, mCPF );"> </p>
                     <p>Email: <input type="email" name="email" maxlength="40" id="emailuser"></p>
                     <p>Telefone: <input type="text" name="telefone" maxlength="15" id="teluser" onkeydown="javascript: fMasc( this, mTel );" > </p>
                     <fieldset><legend id="legenda">Endereço:</legend>
                      <p> Nº: <input type="number" name="numero" min="0" max="999999" id="numuser" class="input-tam"></p>
                      <p> Rua: <input type="text" name="rua" maxlength="20" id="ruauser" class="input-tam"></p>
                      <p> Bairro: <input type="text" name="bairro" maxlength="20" id="bairrouser" class="input-tam"></p><br/>
                     </fieldset>

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