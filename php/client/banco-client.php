<?php

include '../banco-acesso.php';

function cadastro_cliente($dados) 				# Cadastro do cliente
{

	try{
			if (!verifica_existe_cpf($dados['cpf'])) 
			{
				$PDO = conectar();
				$sql = "INSERT INTO cliente (cpf, nome, email, num, bairro, rua, telefone) VALUES ( :cpf, :nome, :email, :numero, :bairro, :rua, :telefone)";
				$exec = $PDO->prepare($sql)->execute($dados);

				if($exec)
					return true;
				else
					return false;
			}
			else
			{
				return false;
			}

	   }catch(PDOException $i){
	       echo $i->getMessage();
	       return false;
	   }
}

function verifica_existe_cpf($cpf)					# Verifica se o usuário existe pelo cpf
{
	$PDO = conectar();

	if($PDO)
	{
		$sql = "select * from cliente WHERE cpf LIKE '".$cpf."'";
		$result = $PDO->query( $sql );
		$rows = $result->fetchAll( PDO::FETCH_ASSOC );
		if(count($rows) == 0)
			return false;
		else
			return true;
	}
	else
	{
		return false;
	}
}



?>