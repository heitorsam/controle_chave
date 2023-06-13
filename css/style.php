<?php
	//ESTILO CSS	
	//echo '</br></br> ESTILO CSS OK';
?>

<style>

/********/
/*GERAIS*/
/********/

body{
    font-family: 'sans-serif', 'arial'; 
	margin:0;
}

.div_br{
    padding-top: 14px;
}

.row{
    margin: 0;
}

.container{
    padding-top: 20px;
    padding-left: 10px !important;
    padding-right: 10px !important;
    padding-bottom: 20px;
    min-height: 91vh;
    /*max-width: 90% !important;*/
}

p,li{
    color: #444444;
    font-size: 14px;
}

.conteudo{
    background-color: #f9f9f9;

}

.centralizar{
	text-align: center;
}

/*******/
/*LOGIN*/
/*******/

.conteudo_login{

    background-image: linear-gradient(#006aac, #03a1c0);

}


.col, .col-1, .col-2, .col-3, .col-4,.col-5, .col-6, 
.col-7, .col-8,.col-9, .col-10, .col-11, .col-12 {
    
    padding: 20px;
    text-align: center;
    background-color: rgba(255,255,255,.99) !important;
}


.col-md-1, .col-md-2, .col-md-3, .col-md-4,.col-md-5, .col-md-6, 
.col-md-7, .col-md-8,.col-md-9, .col-md-10, .col-md-11, .col-md-12 {
    text-align: left;
}


.col-lg, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4,.col-lg-5, .col-lg-6, 
.col-lg-7, .col-lg-8,.col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 {
    
    padding: 20px;
    text-align: center;
    background-color: rgba(255,255,255,.99) !important;
}



.img_redimensionada {
		width: 80%;
		height: 80%;
		object-fit: contain;
}
			
/********************/
/*BARRA DE NAVEGACAO*/
/********************/

.bg-color{
    background-color: #46a5d4;

}

.navbar{
    padding: 0 !important;
}

.nav-link{
    color: #ffffff;
    font-size:15px;
}

.navbar-dark .navbar-nav .nav-link {
    padding: 16px !important;
    color: rgba(255,255,255.99) !important;
    
}

.navbar-dark:hover .navbar-nav:hover .nav-link:hover {
    color: rgba(255,255,255,.6) !important;
}

.navbar-brand {
    font-family: 'sans-serif', 'arial'; 
    padding-left: 14px;
    font-size:16x !important;

}

.navbar-brand :hover{
    font-family: 'sans-serif', 'arial'; 
    color: rgba(255,255,255,.6) !important;
}

.dropdown-item {
    color: #3d3d3d !important;  
}

/*MENU AZUL CLARO*/
.menu_azul_claro{

    background-color: #70aedc;
    /*border-left: 1px solid #ffffff;
    border-right: 1px solid #ffffff;*/
}

/*MENU PRETO*/
.menu_preto{
 
    background-color: #55594d;
     /*border-left: 1px solid #ffffff;
    border-right: 1px solid #ffffff;*/
    

}

/*MENU PERFIL*/
.menu_perfil{

    background-color: #70aedc;
}


/*AJUSTE BORDA MOBILE*/
@media (max-width: 768px) {
	.menu_azul_claro, .menu_preto, .menu_perfil { 
       border: 0; 
    }
}



.dropdown-menu-right {
    margin-bottom: 20px !important;
}


/*DIRETORIO*/
.diretorio{
    font-size: 13.5px;
    color: #33372b;
    height: 24px;
    background-color: #fffff7;
    border-top: 1px solid #ccd0c4;
    border-bottom: 1px solid #ccd0c4;
    padding-left: 16px;
}

.diretorio_link{
    font-size: 13.5px;
    color: #33372b;
    text-decoration: none;
}

.diretorio_link:hover{
    font-size: 13.5px;
    color: #33372b;
    text-decoration: none;
    opacity: 70%;
}

/********/
/*BOTOES*/
/********/

/*BOTAO HOME */

.botao_home { 
	width: 240px;
	
	padding-top: 20px;
	padding-bottom: 20px; 
    
    margin-top: 6px;
	margin-bottom: 6px; 
	
	border-style: solid;
	border-width: thin;
	border-radius: 5px;  
	border-color: #3185c1;
	
    text-align: center;
    text-decoration: none;
    display: inline-block;	
	
    color: rgba(255,255,255,.99);
    background-color: #3185c1;
	font-size: 14px;
	font-weight: bold;
	
	/*box-shadow: 1px 1px 1px 0px rgba(0,0,0,0.2);*/
	
}

.botao_home:hover {

    text-align: center;
    text-decoration: none;
    display: inline-block;	
	
    color: rgba(255,255,255,.99);
    background-color: #3185c1;
	font-size: 14px;
	font-weight: bold;
    background-color: #31b2d0; 
    border-color: #31b2d0;

    animation: efeitozoomhome 1600ms infinite; 
}

/*BOTAO HOME ADM */

.botao_home_adm { 
	width: 240px;
	
    padding-top: 20px;
	padding-bottom: 20px;  
	
    margin-top: 6px;
	margin-bottom: 6px; 

	border-style: solid;
	border-width: thin;
	border-radius: 5px;  
	border-color: #e05757;
	
    text-align: center;
    text-decoration: none;
    display: inline-block;	
	
    color: rgba(255,255,255,.99);
    background-color: #e05757;	
	font-size: 14px;
	font-weight: bold;
	
	/*box-shadow: 1px 1px 1px 0px rgba(0,0,0,0.2);*/	
}

.botao_home_adm:hover {

    text-align: center;
    text-decoration: none;
    display: inline-block;	

    color: rgba(255,255,255,.99);
	font-size: 14px;
	font-weight: bold;
    background-color: #e36767; 
    border-color: #e36767;

    animation: efeitozoomhome 1600ms infinite; 
}

/*BOTAO FORM*/


.btn-primary { 

    font-size: 0.875rem !important;
    background-color: #3185c1 !important;
    border-color: #3185c1 !important;	

}

.btn-mario { 

    color: #ffffff !important;
    font-size: 0.875rem !important;
    background-color: #3185c1 !important;
    border-color: #3185c1 !important;	

}

.btn-mario:hover { 

    font-size: 0.875rem !important;
    background-image: url('img/bloco_mario_pergunta.png');
    background-color: rgba(0,0,0,0) !important;
    border-color: rgba(0,0,0,0) !important;
    color: rgba(0,0,0,0) !important;

}

.btn-mario:active { 

font-size: 0.875rem !important;
background-image: url('img/bloco_mario_moeda.png');
background-color: rgba(0,0,0,0) !important;
border-color: rgba(0,0,0,0) !important;
color: rgba(0,0,0,0) !important;

}

.btn-secondary { 

    color: #ffffff;
    background-color: #9ea9b3 !important;
    border-color: #9ea9b3 !important;
    font-size: 0.875rem !important;

}

.btn-secondary:hover { 

    color: #ffffff;
    background-color: #869099 !important;
    border-color: #869099 !important;
    font-size: 0.875rem !important;

}



.btn-adm { 
    font-size: 0.875rem !important;
    color: #ffffff !important;
    background-color: #e05757 !important;
    border-color: #e05757 !important;		
}

.btn-adm:hover{ 
    color: #ffffff !important;
    background-color: #e36767 !important; 
    border-color: #e36767 !important;		
}

/* ARQUIVO UPLOAD */
.arquivo_upload {

	font-size: 11px;
	color: #555555;
	
}

/*BOTAO HOME */

.botao_info { 

    text-align: center;
    text-decoration: none;
    display: inline-block;		
    color: #ffa700;
	font-size: 14px;

}

.botao_info:hover {

    text-align: center;
    text-decoration: none;
    display: inline-block;		
    color: #ffc148; 
	font-size: 14px;

}

.botao_verde{
    background-color: #30c669 !important;
    border-color: #30c669 !important;
}

.botao_verde:hover{
    background-color: #3bd274 !important;
    border-color: #3bd274 !important;
}

.botao_info_amarelo { 
    color: #ffffff !important;
    font-size: 0.875rem !important;
    background-color: #ffa700 !important;
    border-color: #ffa700 !important;		
}

.botao_info_amarelo:hover{ 
    color: #ffffff !important;
    background-color: #ffc148 !important; 
    border-color: #ffc148 !important;		
}

/*************/
/*FORMULARIOS*/
/*************/

.bloco_permissoes_setor{
    
    width: 50%;
    max-height: 260px;

    overflow: auto;
    overflow-x: hidden;
    padding: 0;
}

.table thead th {
    font-size: 12px;
    color: #ffffff;
    background-color: #3185c1;
    vertical-align: bottom;
    border: none;
    border-bottom: 1px solid #dee2e6 !important;
    padding-left: 2px !important;
    padding-right: 2px !important;
    padding-top: 5px !important;
    padding-bottom: 5px !important;
}
.table td, .table th {
    font-size: 12px;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
    padding-left: 2px !important;
    padding-right: 2px !important;
    padding-top: 5px !important;
    padding-bottom: 5px !important;
}

tbody{
    vertical-align: top !important;
}

/********/
/*TABELA*/
/********/

th.rotated-text {
    font-size: 0.75rem !important;
    height: 120px;
    white-space: nowrap;
    padding: 0 !important;
}

th.rotated-text > div {
    transform:
        translate(0px, 0px)
        rotate(270deg);
    width: 30px;
}

th.rotated-text > div > span {
    padding: 10px 10px;
}

.fonte_tabela_pequeno{
    font-size: 0.75rem !important;
    text-align: center;
    border-bottom: solid 1px #999999;
}

.fundo_amarelo{
    color: #000000 !important;
    background-color: #ffeeb8 !important;
}

.fundo_azul{
    color: #000000 !important;
    background-color: #c9e2ff !important;
}

.fundo_azul_escuro{
    color: #000000 !important;
    background-color: #8bc0fe !important;
}
  
.fundo_preto{
    color: #ffffff !important;
    background-color: #444444 !important;
}

.fundo_vermelho{
    color: #ffffff !important;
    background-color: #ff6262 !important;
}

.fundo_verde{
    color: #ffffff !important;
    background-color: #34c777 !important;
}

/*******/
/*FONTS*/
/*******/

/*LINK MENU*/
h10{
    font-family: 'sans-serif', 'arial'; 
    color: rgba(255,255,255.99);
    font-size:17px;
}

/*TITULO*/
h11{
    font-family: 'sans-serif', 'arial'; 
    font-size:22px;
    color: #3d3d3d;
    border-bottom: 1px solid #dadada;
    padding-bottom: 3px;
}

/*FONTE PADRAO*/
h12{
    font-family: 'sans-serif', 'arial'; 
    font-size:15px;
    color: #3d3d3d;
}

/*INFO LOGIN*/
h13{
    font-family: 'sans-serif', 'arial'; 
    font-size:16px;
    color: #3d3d3d;
    border-bottom: 1px solid #dadada;
    padding-bottom: 3px;
}

/*TITULO LOGIN*/
h14{
    font-family: 'sans-serif', 'arial'; 
    font-size:17px;
    color: #3d3d3d;
}

/*INFORMACOES HOME*/
.link_home_pend{
    font-family: 'sans-serif', 'arial'; 
    font-size:13px;
    color: #3d3d3d;
    text-decoration: none;
}

.link_home_pend:hover{
    color: #3185c1;
    text-decoration: none;
}


/*********/
/*ESPACOS*/
/*********/

.espaco{
	display: inline-block;
	width: 14px;	
}


.espaco_pequeno{
	display: inline-block;
	width: 4px;	
}

.espaco_workflow{
	display: inline-block;
	width: 20px;	
}




/********/
/*RODAPE*/
/********/

.footer-bs {
    background-color: #3c3d41;
	padding: 40px 110px;
	color: rgba(255,255,255,1.00);
	margin-bottom: 0px;
	border-bottom-right-radius: 0px;
	border-top-left-radius: 0px;
	border-bottom-left-radius: 0px;
}
.footer-bs .footer-brand, .footer-bs .footer-nav, .footer-bs .footer-social, .footer-bs .footer-ns { 
    padding:10px 25px; 
}

.footer-bs .footer-nav, .footer-bs .footer-social, .footer-bs .footer-ns { 
    border-left:solid 1px rgba(255,255,255,0.10);  
}
.footer-bs .footer-brand h2 { 
    margin:0px 0px 10px; 
}

.footer-bs .footer-brand p { 
    font-size:12px; color:rgba(255,255,255,0.70); 
}

.footer-bs .footer-nav ul.pages { 
    list-style:none; padding:0px; 
}

.footer-bs .footer-nav ul.pages li { 
    padding:5px 0px;
}

.footer-bs .footer-nav ul.pages a { 
    color:rgba(255,255,255,1.00); font-weight:bold; text-transform:uppercase; 
}

.footer-bs .footer-nav ul.pages a:hover { 
    color:rgba(255,255,255,0.80); text-decoration:none; 
}

.footer-bs .footer-nav h4 {
	font-size: 11px;
	text-transform: uppercase;
	letter-spacing: 3px;
	margin-bottom:10px;
}

.footer-bs .footer-nav ul.list { 
    list-style:none; padding:0px; 
}

.footer-bs .footer-nav ul.list li { 
    padding:5px 0px;
}

.footer-bs .footer-nav ul.list a { 
    color:rgba(255,255,255,0.80); 
}

.footer-bs .footer-nav ul.list a:hover { 
    color:rgba(255,255,255,0.60); text-decoration:none;
}

.footer-bs .footer-social ul { 
    list-style:none; padding:0px; 
}

.footer-bs .footer-social h4 {
	font-size: 11px;
	text-transform: uppercase;
	letter-spacing: 3px;
}

.footer-bs .footer-social li { 
    padding:5px 4px;
}

.footer-bs .footer-social a { 
    color:rgba(255,255,255,1.00);
}

.footer-bs .footer-social a:hover { 
    color:rgba(255,255,255,0.80); text-decoration:none; 
}

.footer-bs .footer-ns h4 {
	font-size: 11px;
	text-transform: uppercase;
	letter-spacing: 3px;
	margin-bottom:10px;
}
.footer-bs .footer-ns p { 
    font-size:12px; color:rgba(255,255,255,0.70);
}


/*SUBIR AO TOPO*/

#subirTopo {
    text-decoration: none;
    bottom: 20px;
    right: 20px;
    color: #3185c1;
    text-align: center;
    cursor: pointer;
    font-size: 34px;
    font-weight: bold;
    text-transform: uppercase;
    position: fixed;
    border: 0;
    opacity: .4;
    }
    
    #subirTopo:hover {
    opacity:1;
    }

/*********/
/*ALERTAS*/
/*********/

.alert{
    font-size: 14px;
}


/**********/
/*POPOVERS*/
/**********/

.popover{
    border: 1px solid rgba(0,0,0,.125) !important;
}

.popover-header{
    background-color: #f9f9f9 !important;
}

/***********/
/*DASHBOARD*/
/***********/

.dash_azul_escuro{
    
    font-size: 1.063rem !important;
    color: #ffffff;
    font-weight: bold;
    text-align: center;

    padding: 0.625rem !important;
    
    background-color: #366092 !important;
}

.dash_separador_claro{

  margin-top: 0.2 !important;
  margin-bottom: 0.2 !important;

  background-color: #f9f9f9 !important; 

}

.dash_azul_claro{
    
    font-size: 0.8rem !important;
    color: #ffffff;
    font-weight: bold;
    text-align: center;

    padding: 0.625rem !important;
    
    border-left: 0.625rem solid #f9f9f9 !important;
    border-right: 0.625rem solid #f9f9f9 !important;  
    
    background-color: #538dd5 !important;
}

.dash_resultado_claro{
    
    font-size: 0.875rem !important;
    color: black;
    /*font-weight: bold;*/
    text-align: center;

    padding: 0.625rem !important;

    border-left: 0.625rem solid #f9f9f9 !important;
    border-right: 0.625rem solid #f9f9f9 !important;
    
    background-color: #ffffff !important;
}

/*ENCONTRAR OUTRA FORMA DE TRAVAR PRIMEIRA COLUNA*/

/*TRAVA PRIMEIRA COLUNA DAS TABELAS*/
th:first-child, td:first-child
{
  /*position:sticky;*/
  left:0px;

}


/*TAMANHO MODAL*/
.modal-dialog {

   min-width: 70%;
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: #3185c1 !important; 
  color: #ffffff; 
}

.modal-open {
    overflow: hidden;
}

/*CARIMBO*/
h99{
    
    font-family: Andale Mono, monospace;
    display: inline-block;
    color: black;
    font-size: 12px;
    line-height: 10px;
    text-transform: uppercase;
    text-align: center;
    transform: rotate(-5deg);
    letter-spacing: -1px;
    font-weight: bold;
}

/*TABELA PIVOT*/

.pivot_tr_titulo{

    width:100%;
    text-align: center; 
    color: white; 
    background-color: #3185c1;  
    font-size: 10px; 

}

.pivot_tr_conteudo{

    font-size: 10px;
    border-bottom: solid 1px #dee2e6;
    padding-left: 2px;
    padding-right: 2px;

}

.fnd_azul{

    background-color: #46A5D4 !important;
    color: #fff !important;
    border-radius: 3px !important;
    padding: 8px !important;
    font-size: 20px !important;
    margin-bottom: 10px !important;
}


/*WORKFLOW*/

.qtd_workflow{

    font-family: Arial, Helvetica, sans-serif;
    font-style: normal;
    font-size: 10px;
    background-color: #FF2A19;
    border-radius: 20px;
    padding-left: 4px;
    padding-right: 5px;
    padding-bottom: 3px;
    padding-top: 3px;
}

/*TOPICOS*/

.topicos{

    color: white;
    background-color: #3185c1;
    padding: 6px 12px 6px 12px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    margin-right: 3px;

}

.topicos:hover{ 

    color: white;
    background-color: #31b2d0 !important; 
    padding: 6px 12px 6px 12px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    text-decoration: none;

}

.topicos:focus{ 

    background-color: #31b2d0 !important; 

}

/*ALERT PERSONALZIDO*/

.alert_pers_amarelo{

    font-size: 13px;
    color: #ff5e00 !important;
    padding: 12px 20px 12px 18px;
    background-color: #fff3cd;
    border: solid 1px #ffeeba;
    border-radius: 5px;
    width: 100%;
    margin: 1px 80px 1px 80px;
    text-align: center;
}

/*EFEITOS*/

.btn:hover{

    animation: efeitozoom 1600ms infinite; 
}

.efeito-zoom:hover{ 
	        
    animation: efeitozoom 1600ms infinite; 
        
}

@keyframes efeitozoom {
  from {transform: scale(0.90);}
  to {transform: scale(1.1);}
}

@keyframes efeitozoomhome {
  from {transform: scale(0.95);}
  to {transform: scale(1);}
}



.textarea {

overflow-y: scroll;
width: 100%;
height: 80px;
padding: 12px 20px;
box-sizing: border-box;
border: 1px solid #ccc;
border-radius: 4px;
background-color: #ffffff;
font-size: 16px;
resize: none;
} 

.assinatura {

width: 100px;
height: 25px;
margin-left: 50px;
object-fit: cover;


}

.check_box {
  width: 1.2rem;
  height: 1.2rem;
  color: dodgerblue;
  vertical-align: middle;
  -webkit-appearance: none;
  background: none;
  border: 0;
  outline: 0;
  flex-grow: 0;
  border-radius: 50%;
  background-color: #FFFFFF;
  transition: background 300ms;
  cursor: pointer;
}

.check_box::before {
  content: "";
  color: transparent;
  display: block;
  width: inherit;
  height: inherit;
  border-radius: inherit;
  border: 0;
  background-color: transparent;
  background-size: contain;
  box-shadow: inset 0 0 0 1px #CCD3D8;
}

.check_box:checked {
  background-color: currentcolor;
}

.check_box:checked::before {
  box-shadow: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M15.88 8.29L10 14.17l-1.88-1.88a.996.996 0 1 0-1.41 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7a.996.996 0 0 0 0-1.41c-.39-.39-1.03-.39-1.42 0z' fill='%23fff'/%3E %3C/svg%3E");
}

.check_box:disabled {
  background-color: #CCD3D8;
  opacity: 0.84;
  cursor: not-allowed;
}

.check_box::-ms-check {
  content: "";
  color: transparent;
  display: block;
  width: inherit;
  height: inherit;
  border-radius: inherit;
  border: 0;
  background-color: transparent;
  background-size: contain;
  box-shadow: inset 0 0 0 1px #CCD3D8;
}

.check_box:checked::-ms-check {
  box-shadow: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M15.88 8.29L10 14.17l-1.88-1.88a.996.996 0 1 0-1.41 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7a.996.996 0 0 0 0-1.41c-.39-.39-1.03-.39-1.42 0z' fill='%23fff'/%3E %3C/svg%3E");
}

[data-tooltip] {
  position: relative;
  /*font-weight: bold;*/
}

[data-tooltip]:after {
  display: none;
  position: absolute;
  top: -30px;
  padding: 5px;
  border-radius: 3px;
  left: calc(100% + 2px);
  content: attr(data-tooltip);
  white-space: nowrap;
  background-color: #3185c1;
  border: solid 1px #46a5d4;
  color: White;
}

[data-tooltip]:hover:after {
  display: block;
}

.table thead th {
    font-size: 12px;
    color: #ffffff;
    background-color: #3185c1;
    vertical-align: bottom;
    border: none;
    border-bottom: 1px solid #dee2e6 !important;
    padding-left: 2px !important;
    padding-right: 2px !important;
    padding-top: 5px !important;
    padding-bottom: 5px !important;
}
.table td, .table th {
    font-size: 12px;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
    padding-left: 2px !important;
    padding-right: 2px !important;
    padding-top: 5px !important;
    padding-bottom: 5px !important;
}

tbody{
    vertical-align: top !important;
}

/*ANIMACOES*/

@keyframes example {
  0%   {color:rgba(70, 165, 212,0.2); font-size: 40px;}
  50%  {color:rgba(70, 165, 212,1); font-size: 41px;}
  100% {color:rgba(70, 165, 212,0.2); font-size: 40px;}
}

/* GRUPOS E PERGUNTAS */

.grupo_pergunta{

    width: 90%;
    float: left;

    font-size: 17px !important;
    color: #444444 !important;
    text-align: center;

    border: solid 1px #89b7ff;
    border-radius: 3px !important;

    padding: 8px !important;   
    margin: 0 auto;
    margin-top: 14px;

    background-color: #d2e2fb;

}

.grupo_pergunta_score{

    width: 10%;
    float: left;

    font-size: 17px !important;
    color: #444444 !important;
    text-align: center;

    border-top: solid 1px #89b7ff;
    border-right: solid 1px #89b7ff;
    border-bottom: solid 1px #89b7ff;
    border-radius: 3px !important;

    padding: 8px !important;   
    margin: 0 auto;
    margin-top: 14px;

    background-color: #d2e2fb;

}

.grupo_cadastro{

    width: 100%;
    min-height: 56px;

    font-size: 17px !important;
    color: #444444 !important;
    text-align: center;

    border: dashed 1px #9a9a9a;
    border-radius: 3px !important;

    padding: 8px !important;      
    margin: 0 auto;
    
    background-color: #f9f9f9;
}

.pergunta{

    width: 78% !important;
    float: left;

    font-size: 15px !important;
    color: #444444 !important;
    text-align: left;

    border-left: solid 1px #777777;
    border-right: solid 1px #777777;
    border-bottom: solid 1px #777777;
    border-radius: 3px !important;

    padding: 4px 4px 4px 20px;
    margin: 0 auto;

}

.pergunta_score{

    width: 10%;
    float: left;

    font-size: 15px !important;
    color: #444444 !important;
    text-align: center;

    border-right: solid 1px #777777;
    border-bottom: solid 1px #777777;
    border-radius: 3px !important;

    padding: 4px 4px 4px 4px;
    margin: 0 auto;

}

.pergunta_cadastro_button{

    width: 100%;
    min-height: 56px;

    font-size: 15px !important;
    color: #444444 !important;
    text-align: center;

    border-top: none;
    border-left: dashed 1px #9a9a9a;
    border-right: dashed 1px #9a9a9a;
    border-bottom: dashed 1px #9a9a9a;
    border-radius: 3px !important;

    padding: 8px !important;      
    margin: 0 auto;

    background-color: #f9f9f9;

}

.pergunta_cadastro{

    clear:both;
    width: 100%;
    min-height: 56px;

    font-size: 15px !important;
    color: #444444 !important;
    text-align: center;

    border-top: none;
    border-left: dashed 1px #9a9a9a;
    border-right: dashed 1px #9a9a9a;
    border-bottom: dashed 1px #9a9a9a;
    border-radius: 3px !important;

    padding: 8px !important;      
    margin: 0 auto;

    background-color: #f9f9f9;

}

.inspecao_opcao{

    cursor: pointer;

    width: 6%;
    float: left;

    font-size: 15px !important;
    color: #ffffff !important;
    text-align: center;

    border-right: solid 1px #777777;
    border-bottom: solid 1px #777777;
    border-radius: 3px !important;

    padding: 4px 4px 4px 4px;
    margin: 0 auto;

}

.inspecao_opcao:hover{

    opacity: 90%;

}

.lista_home_itens {

    width: 100%;
    background-color: #ffffff !important;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #46a5d4;
    padding: 4px;
    font-size: 13px;
    margin-bottom: 8px;
}

.check_box {
  width: 1.1rem;
  height: 1.1rem;
  color: dodgerblue;
  vertical-align: middle;
  -webkit-appearance: none;
  background: none;
  border: 0;
  outline: 0;
  flex-grow: 0;
  border-radius: 50%;
  background-color: #FFFFFF;
  transition: 300ms;
  cursor: pointer;
}

.check_box::before {
  content: "";
  color: transparent;
  display: block;
  width: inherit;
  height: inherit;
  border-radius: inherit;
  border: 0;
  background-color: transparent;
  background-size: contain;
  box-shadow: inset 0 0 0 1px #CCD3D8;
}

.check_box:checked {
  background-color: currentcolor;
}

.check_box:checked::before {
  box-shadow: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M15.88 8.29L10 14.17l-1.88-1.88a.996.996 0 1 0-1.41 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7a.996.996 0 0 0 0-1.41c-.39-.39-1.03-.39-1.42 0z' fill='%23fff'/%3E %3C/svg%3E");
}

.check_box:disabled {
  background-color: #CCD3D8;
  opacity: 0.84;
  cursor: not-allowed;
}

.check_box::-ms-check {
  content: "";
  color: transparent;
  display: block;
  width: inherit;
  height: inherit;
  border-radius: inherit;
  border: 0;
  background-color: transparent;
  background-size: contain;
  box-shadow: inset 0 0 0 1px #CCD3D8;
}

.check_box:checked::-ms-check {
  box-shadow: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M15.88 8.29L10 14.17l-1.88-1.88a.996.996 0 1 0-1.41 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7a.996.996 0 0 0 0-1.41c-.39-.39-1.03-.39-1.42 0z' fill='%23fff'/%3E %3C/svg%3E");
}


</style>