<?php

//////////
//ORACLE//
//////////

//TREINAMENTO

//$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST =192.168.90.231)(PORT = 1521))
//(CONNECT_DATA = (SID = trnmv)))";

//Criar a conexao ORACLE
//if(!@($conn_ora = oci_connect('dbamv','treinamento123',$dbstr1,'AL32UTF8'))){
//	echo "Conexão falhou!";	
//} else { 
	//echo "Conexão OK!";	
//}

//PRODUCAO

$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST =10.200.0.211)(PORT = 1521))
(CONNECT_DATA = (SERVICE_NAME = prdmv)))";

//Criar a conexao ORACLE
if(!@($conn_ora = oci_connect('inspecao_sesmt','dick_vigarista_2023_canguru',$dbstr1,'AL32UTF8'))){
	echo "Conexão falhou!";	
} else { 

	//echo "Conexão OK!";	

	//TEMPO MAXIMO DE CONSULTA 20 MINUTOS
	set_time_limit(1200);
	
}
