<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>
<?php
	include "banco-acesso.php";
	include "administrador/banco-admin.php";

	$email = isset($_POST["email"])?$_POST["email"]:"[Email Invalido]";
	$senha = isset($_POST["senha"])?$_POST["senha"]:"[Senha Invalida]";
	$senha = criptografar($senha);
	$return = verifica_acesso($email,$senha);

	if($return)
	{
		if (session_status() != PHP_SESSION_ACTIVE) 
  			session_start();
		
		$_SESSION['nome'] = $return["nome"];
		$_SESSION['sobrenome'] = $return["sobrenome"];
		$_SESSION['email'] = $return["email"];
		$_SESSION['cargo'] = $return["cargo"];
		header('location:../painel.php');
	}
	else
	{
		session_unset();
		session_destroy();
		echo "<script language=javascript>alert( 'Acesso negado ao sistema!' );	</script>";
		echo "<script language=javascript>window.location.replace('../index.html');</script>";
	}

?>
</body>
</html>


