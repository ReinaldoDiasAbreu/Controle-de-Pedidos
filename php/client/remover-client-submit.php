<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
</head>
<body>

<?php
  session_start();

  try {
      include_once ('banco-client.php');
      include_once ('../banco-acesso.php');
    } catch (Exception $e) {
      echo "Erro: ".$e->getMessage();
    }
  
  if(!isset($_SESSION['nome'])) {
      echo "<script language=javascript>alert( 'Acesso Bloqueado!' );</script>";
      echo "<script language=javascript>window.location.replace('../../index.html');</script>";
  }
  else
  {
    
      $linhas = listar_tabela_client();     # Captura todas as linhas da tabela
      $quant = count($linhas);            # Conta total de linhas
 
      
      for($i=0; $i < $quant; $i++)          # Captura os id passados pelo formulario
        if($_POST[$i])                      # e adiciona-os ao vetor
            $users[] = $_POST[$i];   


      foreach ($users as $value){
          remover_client($value);
        }

      echo "<script language=javascript>alert( 'Remoção Concluída!' );</script>";
      echo "<script language=javascript>window.location.replace('../../client/remover_client.php');</script>";


  }
?>

</body>
</html>