<?php
# Substitua abaixo os dados, de acordo com o banco criado
$user = "root"; 
$password = "12wqasxz"; 
$database = "help"; 

# O hostname deve ser sempre localhost 
$hostname = "localhost"; 

# Conecta com o servidor de banco de dados 
mysqli_connect($hostname, $user, $password, $database)or die(' Erro na conexão'); 

# Seleciona o banco de dados 
//mysqli_select_db($database)or die('Erro na seleção do banco');

# Executa a query desejada 
$query = "SELECT YEAR(ht.dt) AS data, hc.name AS nome, COUNT(hc.name) AS qtd FROM hesk_tickets AS ht INNER JOIN hesk_categories AS hc ON hc.id = ht.category GROUP BY YEAR(ht.dt), hc.name"; 
$result_query = mysqli_query($query)or die('Erro na query:' . $query . ' ' . mysqli_error()); 

# Exibe os registros na tela 
while ($row = mysqli_fetch_array( $result_query )) { print $row[data] . " -- " . $row[nome] . " -- " . $row[qtde]; }
