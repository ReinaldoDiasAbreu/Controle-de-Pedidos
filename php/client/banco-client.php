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

function atualizar_cadastro_client($dados)
{
	try{

		$PDO = conectar();
		$sql = "UPDATE cliente SET cpf=:cpf, nome=:nome, email=:email, num=:numero, bairro=:bairro, rua=:rua, telefone=:telefone WHERE id=:id";

		$exec = $PDO->prepare($sql)->execute($dados);

		if($exec)
			return true;
		else
			return false;
	
   }catch(PDOException $i){
       echo $i->getMessage();
       return false;
   }
}

function remover_client($id)
{
	try{
		$PDO = conectar();
		$sql = "DELETE FROM cliente WHERE id = :id";
		$exec = $PDO->prepare($sql);
		$exec->bindParam( ':id', $id );
		$exec->execute();

   }catch(PDOException $i){
       echo $i->getMessage();
   }
}

function validacao_cpf($cpf)
{
	$cont = 0;
	for ($b=0; $b < 11 ; $b++) { 
		if($cpf[$b] == $cpf[$b+1])
			$cont++;
	}
	if($cont != 10)
	{
		$aux = 0;
		for ($i=10, $a=0; $i <= 2, $a<=8; $i--, $a++) { 
			$aux += $cpf[$a] * $i;
		}
		$aux = ($aux * 10) % 11;

		if($aux == $cpf[9])
		{
			$aux = 0;
			for ($i=11, $a=0; $i <= 2, $a<=9; $i--, $a++) { 
				$aux += $cpf[$a] * $i;
			}
			$aux = ($aux * 10) % 11;
			
			if($aux == $cpf[10])
			{
				return true;
			}	
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
	
	

}

?>