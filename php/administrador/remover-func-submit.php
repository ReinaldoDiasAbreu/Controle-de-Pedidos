<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>

<?php
	session_start();

	try {
	    include_once ('banco-admin.php');
		include_once ('../banco-acesso.php');
	  } catch (Exception $e) {
	    echo "Erro: ".$e->getMessage();
	  }
	
	if(!isset($_SESSION['nome'])) {
	    echo "<script language=javascript>alert( 'Acesso Bloqueado!' );</script>";
	    echo "<script language=javascript>window.location.replace('../../index.html');</script>";
	}
	else
	{
		
		if($_SESSION['cargo'] == 1)
		{
			$linhas = listar_tabela_func(); 				# Captura todas as linhas da tabela
			$quant = count($linhas);						# Conta total de linhas
			$c = 0;											# Var para armazenar num de admins

			foreach ($linhas as $user) {
				foreach ($user as $key => $value) {
					if($key == "cargo" && $value == 1)
					{
						$c++;								# Contagem de administradores
						$admin[] = $user;					# Salva os Administradores encontrados
					}
				}
			}			
			
			for($i=0; $i < $quant; $i++)					# Captura os id passados pelo formulario
				if($_POST[$i]) 								# e adiciona-os ao vetor
					$users[] = $_POST[$i];		

			$ver = 0;										# Variavel de verificação
			for ($i=0; $i < $quant; $i++) { 
				for ($a=0; $a < $c; $a++) { 
					if($users[$i] == $admin[0]['id'])	    # Verifica se o admin encontrado está selecionado para exclusão
					{
						$ver++;
					}
				}
			}


			if ($c == $ver)						# Caso todos os administradores forem selecionados
			{
				echo "<script language=javascript>alert( 'Ação não concluída! Deve existir ao menos um administrador no sistema.' );</script>";
	        	echo "<script language=javascript>window.location.replace('../../admin/remover_func.php');</script>";
				
			}
			else
			{
				foreach ($users as $value){
					remover_user($value);
				}

				echo "<script language=javascript>alert( 'Ação concluída!' );</script>";
			    echo "<script language=javascript>window.location.replace('../../admin/remover_func.php');</script>";
				
			}
		}
		else
		{
			 echo "<script language=javascript>alert( 'Ação permitida somente ao administrador!' );</script>";
	         echo "<script language=javascript>window.location.replace('../../admin/cadastro_func.php');</script>";
		}

	}
?>

</body>
</html>