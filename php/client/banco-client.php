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

function imprime_client_nome($nome)
{
	try{

		$PDO = conectar();

		if($PDO)
		{
			$sql = "SELECT id, cpf, nome, email, num, bairro, rua, telefone FROM cliente WHERE nome LIKE '%".$nome."%' ORDER BY nome";
			$result = $PDO->query( $sql );
			$rows = $result->fetchAll( PDO::FETCH_ASSOC );
			return $rows;
		}
		else
		{
			echo "Erro ao conectar ao banco de dados!<br/>";
			return NULL;
		}
		

   }catch(PDOException $i){
       echo $i->getMessage();
       return NULL;
   }
}

function listar_tabela_client()
{
	try{
		$PDO = conectar();
		$sql = "SELECT id, cpf, nome, email, num, bairro, rua, telefone FROM cliente ORDER BY nome";
	
		$result = $PDO->query( $sql );
		$rows = $result->fetchAll( PDO::FETCH_ASSOC );
		return $rows;

   }catch(PDOException $i){
       echo "Erro: ".$i->getMessage();
       return NULL;
   }
}


?>