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
			$id = isset($_POST['id'])?$_POST['id']:"[Invalido]";
			$nome = isset($_POST['nome'])?$_POST['nome']:"[Invalido]";
			$email = isset($_POST['email'])?$_POST['email']:"[Invalido]";
			$senha = isset($_POST['senha'])?$_POST['senha']:"[Invalido]";
			$cargo = isset($_POST['cargo'])?$_POST['cargo']:"0";

			$nome = trim(strtolower($nome));
			$sobrenome = trim(strtolower($sobrenome));
			$senha = criptografar($senha);

			$dados = array('id' => $id, 'email' => $email, 'nome' => $nome, 'senha' => $senha, 'cargo' => $cargo);
			
			$status = atualizar_cadastro_user($dados);

			if($status)
			{
				echo "<script language=javascript>alert( 'Atualização Realizado com Sucesso!' );</script>";
				echo "<script language=javascript>window.location.replace('../../admin/alterar_func.php');</script>";
			}
			else
			{
				echo "<script language=javascript>alert( 'Erro ao realizar Atualização!' );</script>";
				echo "<script language=javascript>window.location.replace('../../admin/alterar_func.php');</script>";

			}

		}
		else
		{
			 echo "<script language=javascript>alert( 'Ação permitida somente ao administrador!' );</script>";
	         echo "<script language=javascript>window.location.replace('../../admin/alterar_func.php');</script>";
		}

	}
?>

</body>
</html>