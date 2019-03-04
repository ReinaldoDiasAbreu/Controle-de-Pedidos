<?php

function conectar()									# Função para conecção ao banco de dados com PDO
{
	define( 'MYSQL_HOST', 'localhost' );
	define( 'MYSQL_USER', 'admin' );
	define( 'MYSQL_PASSWORD', 'password' );
	define( 'MYSQL_DB_NAME', 'pizzaria' );
	define('BD', 'mysql');

	try
	{
	    $PDO = new PDO( BD.':host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD );
	    $PDO -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	    return $PDO;
	}
	catch ( PDOException $e )
	{
	    echo 'Erro ao conectar com o MySQL: '. $e->getMessage();
	    return NULL;
	}

}

?>