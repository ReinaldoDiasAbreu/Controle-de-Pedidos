<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>
<?php
	include "banco-admin.php";

	session_start();
	if(empty($_SESSION['nome'])) {
	    echo "<script language=javascript>alert( 'Acesso Bloqueado!' );</script>";
	    echo "<script language=javascript>window.location.replace('../../index.html');</script>";
	}
	else
	{
		if($_SESSION['cargo'] == 1)
		{
			$nome = isset($_POST['nome'])?$_POST['nome']:"[Invalido]";
			$email = isset($_POST['email'])?$_POST['email']:"[Invalido]";
			$senha = isset($_POST['senha'])?$_POST['senha']:"[Invalido]";
			$cargo = isset($_POST['cargo'])?$_POST['cargo']:"0";

			$nome = trim(strtolower($nome));
			$senha = criptografar($senha);

			$dados = array('email' => $email, 'nome' => $nome,'senha' => $senha, 'cargo' => $cargo);
			
			$status = cadastro_user($dados);

			if($status)
			{
				echo "<script language=javascript>alert( 'Cadastro Realizado com Sucesso!' );</script>";
				echo "<script language=javascript>window.location.replace('../../admin/cadastro_func.php');</script>";
			}
			else
			{
				echo "<script language=javascript>alert( 'Erro ao realizar cadastro! Verifique se já está cadastrado!' );</script>";
				echo "<script language=javascript>window.location.replace('../../admin/cadastro_func.php');</script>";

			}

		}
		else
		{
			 echo "<script language=javascript>alert( 'Ação permitida somente ao administrador!' );</script>";
	         echo "<script language=javascript>window.location.replace('../../admin/cadastro_func.php');</script>";
		}

	}
?>

</body>
</html>