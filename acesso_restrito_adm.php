<?php

//Se o usuário não for admin
if($_SESSION['SN_USUARIO_ADM'] == 'N'){

	unset(
			$_SESSION['usuarioLogin'],
			$_SESSION['usuarioNome'],
			$_SESSION['SN_USUARIO'], 
			$_SESSION['SN_USUARIO_ADM']
	);

	$_SESSION['msgerro'] = "Usuário sem permissão de administrador!";
	header("Location: index.php");
}

?>