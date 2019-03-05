<?php
include '../banco-acesso.php';

/**
 * Funções de Acesso ao BD Relacionadas aos Ingredientes
 */
function cadastro_ingrediente($dados) 				
{

	try{
        $PDO = conectar();
        $sql = "INSERT INTO ingrediente (nome, quantidade, unidade) VALUES ( :nome, :quantidade, :unidade)";
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

function verifica_existe_ingrediente($nome)					
{
	$PDO = conectar();

	if($PDO)
	{
		$sql = "select * from ingrediente WHERE nome LIKE '".$nome."'";
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

function remover_ingrediente($id)
{
	try{
		$PDO = conectar();
		$sql = "DELETE FROM ingrediente WHERE id = :id";
		$exec = $PDO->prepare($sql);
		$exec->bindParam( ':id', $id );
		$exec->execute();

   }catch(PDOException $i){
       echo $i->getMessage();
   }
}

function alterar_ingrediente($dados)
{
    try{

		$PDO = conectar();
		$sql = "UPDATE ingrediente SET nome=:nome, quantidade=:quantidade, unidade=:unidade WHERE id=:id";

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

function listar_tabela_ingrediente()
{
	try{
		$PDO = conectar();
		$sql = "SELECT id, nome, quantidade, unidade FROM ingrediente ORDER BY nome";
	
		$result = $PDO->query( $sql );
		$rows = $result->fetchAll( PDO::FETCH_ASSOC );
		return $rows;

   }catch(PDOException $i){
       echo "Erro: ".$i->getMessage();
       return NULL;
   }
}

/**
 * Funções de Acesso ao BD Relacionadas aos Produtos
 */


 
?>