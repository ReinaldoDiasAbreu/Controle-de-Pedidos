<?php

include '../banco-acesso.php';

/*
	Funções relativas a acesso ao banco de dados pelo painel na seção do adminstrador.
*/

function verifica_acesso($email, $senha) 			# Verifica login do usuário e retorna seus dados
{
	$PDO = conectar();

	if($PDO)
	{
		$sql = "select * from admin WHERE email LIKE '".$email."' and senha LIKE '".$senha."'";
		$result = $PDO->query( $sql );
		$rows = $result->fetchAll( PDO::FETCH_ASSOC );
		if(count($rows) == 1)
			return $rows[0];
		else
			return NULL;
	}
	else
	{
		print("<p>Erro ao conectar ao banco de dados!!!</p>");
		return NULL;
	}
}

function cadastro_user($dados)						# Cadatro dos funcionários/Administradores
{
	try{
		if (!verifica_existe($dados['email'])) {
			$PDO = conectar();
			$sql = "INSERT INTO admin (email, nome, senha, cargo) VALUES (:email, :nome, :senha, :cargo)";
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

function listar_tabela_func()						# Retorna todas as linhas a tabela admin por odem de nome
{
	try{
		$PDO = conectar();
		$sql = "SELECT id, nome, cargo, email FROM admin ORDER BY nome";
	
		$result = $PDO->query( $sql );
		$rows = $result->fetchAll( PDO::FETCH_ASSOC );
		return $rows;

   }catch(PDOException $i){
       echo "Erro: ".$i->getMessage();
       return NULL;
   }

}

function remover_user($id)							# Remove usuário/admin pelo id
{
	try{
		$PDO = conectar();
		$sql = "DELETE FROM admin WHERE id = :id";
		$exec = $PDO->prepare($sql);
		$exec->bindParam( ':id', $id );
		$exec->execute();

   }catch(PDOException $i){
       echo $i->getMessage();
   }
}

function verifica_existe($email)					# Verifica se o usuário existe pelo email
{
	$PDO = conectar();

	if($PDO)
	{
		$sql = "select * from admin WHERE email LIKE '".$email."'";
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

function atualizar_cadastro_user($dados)			# Atualiza o cadastro passando os dados do user/admin
{
	try{
		
		$PDO = conectar();
		$sql = "UPDATE admin SET nome=:nome, email=:email, senha=:senha, cargo=:cargo WHERE id=:id";
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

function imprime_user_nome($nome)					# Retorna linhas dos usuários que coincidem com parte do nome passados
{
	try{

		$PDO = conectar();

		if($PDO)
		{
			$sql = "SELECT id, nome, cargo, email FROM admin WHERE nome LIKE '%".$nome."%' ORDER BY nome";
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

function criptografar($string)
{
	return md5($string);
}


?>