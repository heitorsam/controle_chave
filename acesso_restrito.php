<?php

	// Se o usuário não está logado, manda para página de login.
	if (!isset($_SESSION['usuarioNome'])){
		
		unset(
			$_SESSION['usuarioLogin'],
			$_SESSION['usuarioNome'],
			$_SESSION['SN_USUARIO'], 
			$_SESSION['SN_USUARIO_ADM'] 		
		);
		
		$_SESSION['msgerro'] = "Sessão expirada!";
		header("Location: index.php");
		
	};

?>