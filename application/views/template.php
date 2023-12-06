<?php 
	// Inclui o cabeçalho do template até a TAG <body>. //
	include "includes/header.php";
	
	// Carrega o conteúdo das páginas dinâmicamente. //
	$this->load->view($nome_view);
	
	// Inclui o rodapé a partir dos códigos JS.	
	include "includes/footer.php";

 ?>