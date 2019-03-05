<?php

	include 'banco-produto.php';

	session_start();

	if(empty($_SESSION['nome'])) {
	    echo "<script language=javascript>alert( 'Acesso Bloqueado!' );</script>";
	    echo "<script language=javascript>window.location.replace('../../index.html');</script>";
	}
	else
	{
			$nome = isset($_POST['nome'])?$_POST['nome']:"[Invalido]";
            $quantidade = isset($_POST['quantidade'])?$_POST['quantidade']:"[Invalido]";
            $unidade = isset($_POST['unidade'])?$_POST['unidade']:"1";

			$nome = trim(strtolower($nome));

            $dados = array('nome' => $nome, 'quantidade' => $quantidade, 'unidade' => $unidade);
        
			if(!verifica_existe_ingrediente($nome))
			{
				$status = cadastro_ingrediente($dados);

				if($status)
				{
					echo "<script language=javascript>alert( 'Cadastro Realizado com Sucesso!' );</script>";
					echo "<script language=javascript>window.location.replace('../../stock/cadastrar_ingrediente.php');</script>";
				}

			}
			else
			{
				echo "<script language=javascript>alert( 'Erro ao realizar cadastro! Nome já Cadastrado!!!' );</script>";
					echo "<script language=javascript>window.location.replace('../../stock/cadastrar_ingrediente.php');</script>";
			}

	}

?>