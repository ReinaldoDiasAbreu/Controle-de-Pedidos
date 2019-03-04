<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>
<?php
	include "banco-client.php";

	session_start();
	if(empty($_SESSION['nome'])) {
	    echo "<script language=javascript>alert( 'Acesso Bloqueado!' );</script>";
	    echo "<script language=javascript>window.location.replace('../../index.html');</script>";
	}
	else
	{
			$id = isset($_POST['id'])?$_POST['id']:"-1";
			$nome = isset($_POST['nome'])?$_POST['nome']:"[Invalido]";
			$cpf = isset($_POST['cpf'])?$_POST['cpf']:"0";
			$email = isset($_POST['email'])?$_POST['email']:"[Invalido]";
			$telefone = isset($_POST['telefone'])?$_POST['telefone']:"[Invalido]";
			$numero = isset($_POST['numero'])?$_POST['numero']:"0";
			$rua = isset($_POST['rua'])?$_POST['rua']:"[Invalido]";
			$bairro = isset($_POST['bairro'])?$_POST['bairro']:"[Invalido]";

			$nome = trim(strtolower($nome));
			$rua = trim(strtolower($rua));
			$bairro = trim(strtolower($bairro));

			$dados = array('id' => $id, 'cpf' => $cpf, 'nome' => $nome, 'email' => $email, 'numero' => $numero, 'bairro' => $bairro, 'rua' => $rua, 'telefone' => $telefone);

			$cpfvar = str_replace(".","", $cpf);
			$cpfvar = str_replace("-","", $cpfvar);

			if(validacao_cpf($cpfvar))
			{

				$status = atualizar_cadastro_client($dados);
				
				if($status)
				{
					echo "<script language=javascript>alert( 'Atualização Realizado com Sucesso!' );</script>";
					echo "<script language=javascript>window.location.replace('../../client/alterar_client.php');</script>";
				}
				else
				{
					echo "<script language=javascript>alert( 'Erro ao realizar Atualização!' );</script>";
					echo "<script language=javascript>window.location.replace('../../client/alterar_client.php');</script>";

				}
			}
			else
			{
				echo "<script language=javascript>alert( 'Erro ao realizar Atualização! CPF inválido!!!' );</script>";
					echo "<script language=javascript>window.location.replace('../../client/alterar_client.php');</script>";
			}

	}
?>

</body>
</html>