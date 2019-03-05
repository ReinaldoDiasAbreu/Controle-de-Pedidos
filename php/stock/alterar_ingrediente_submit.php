<?php

	include 'banco-produto.php';

	session_start();

	if(empty($_SESSION['nome'])) {
	    echo "<script language=javascript>alert( 'Acesso Bloqueado!' );</script>";
	    echo "<script language=javascript>window.location.replace('../../index.html');</script>";
	}
	else
	{
            $id = isset($_POST['id'])?$_POST['id']:"-1";
			$nome = isset($_POST['nome'])?$_POST['nome']:"[Invalido]";
            $quantidade = isset($_POST['quantidade'])?$_POST['quantidade']:"[Invalido]";
            $unidade = isset($_POST['unidade'])?$_POST['unidade']:"1";

			$nome = trim(strtolower($nome));

            $dados = array('id' => $id, 'nome' => $nome, 'quantidade' => $quantidade, 'unidade' => $unidade);
        

            $status = alterar_ingrediente($dados);

            if($status)
            {
                echo "<script language=javascript>alert( 'Atualização Realizado com Sucesso!' );</script>";
                echo "<script language=javascript>window.location.replace('../../stock/atualizar_ingrediente.php');</script>";
            }

	}

?>