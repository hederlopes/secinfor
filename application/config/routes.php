<?php

defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Acesso/logar';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['Login'] = "Acesso/logar";
//$route['Alterar-Senha'] = "Acesso/alterar_senha";
//$route['Altera-Senha'] = "Acesso/altera_senha";
$route['Logout'] = "Acesso/logout";
$route['Secinfor-Imprimir'] = "Secinfor/relatorios_so_Imprimir_pdf";

//Informática
$route['Secinfor-Maquinas'] = "Secinfor/maquinas";
$route['Secinfor-Maquinas-Cadastrar'] = "Secinfor/cadastrar_maquinas";
$route['Secinfor-Maquinas-Consultas'] = "Secinfor/maquinas_consultas";
$route['Secinfor-Maquinas-Editar/(:num)'] = "Secinfor/maquinas_editar/$1";
$route['Secinfor-Maquinas-Altera-Dados'] = "Secinfor/alterar_dados_maquina";

$route['Secinfor-Secoes'] = "Secinfor/secoes";
$route['Secinfor-Secoes-Cadastrar'] = "Secinfor/cadastrar_secao";
$route['Secinfor-Secoes-Editar/(:num)'] = "Secinfor/secoes_editar/$1";
$route['Secinfor-Secoes-Alterar'] = "Secinfor/secao_alterar";

$route['Secinfor-Softwares'] = "Secinfor/softwares";
$route['Secinfor-Softwares-Cadastrar'] = "Secinfor/cadastrar_software";
$route['Secinfor-Softwares-Editar/(:num)'] = "Secinfor/softwares_editar/$1";
$route['Secinfor-Softwares-Alterar'] = "Secinfor/software_alterar";

$route['Secinfor-Softwares-Proprietario'] = "Secinfor/softwares_proprietario";

$route['Secinfor-Impressoras'] = "Secinfor/impressoras";
$route['Secinfor-Impressoras-Cadastrar'] = "Secinfor/cadastrar_impressoras";
$route['Secinfor-Impressoras-Consultas'] = "Secinfor/impressoras_consultas";
$route['Secinfor-Impressoras-Editar/(:num)'] = "Secinfor/impressoras_editar/$1";
$route['Secinfor-Impressoras-Altera-Dados'] = "Secinfor/alterar_dados_impressora";

$route['Secinfor-Estatisticas'] = "Secinfor/estatisticas";
$route['Secinfor-Tickets'] = "Secinfor/tickets";

$route['Secinfor-Relatorios'] = "Secinfor/relatorios_so";
$route['Secinfor-Relatorio-SO'] = "Secinfor/relatorios_so";
$route['Secinfor-Relatorio-SO-Imprimir'] = "Secinfor/relatorios_so_Imprimir_pdf";
$route['Secinfor-Relatorio-Software'] = "Secinfor/relatorios_software";
$route['Secinfor-Relatorio-Cod'] = "Secinfor/relatorios_Cod";


$route['Secinfor-Manutencoes'] = "Secinfor/manutencoes";
$route['Secinfor-Manutencoes-Novo/(:num)'] = "Secinfor/manutencoes_novo/$1";
$route['Secinfor-Manutencoes-Cadastrar'] = "Secinfor/cadastrar_manutencoes";
$route['Secinfor-Manutencoes-Historico/(:num)'] = "Secinfor/manutencoes_historico/$1";

$route['Secinfor-Falhas'] = "Secinfor/falha";
$route['Secinfor-Falhas-Cadastrar'] = "Secinfor/cadastrar_falha";
$route['Secinfor-Falhas-Consultas'] = "Secinfor/falha_consultas";
$route['Secinfor-Falhas-Editar/(:num)'] = "Secinfor/falha_editar/$1";
$route['Secinfor-Falhas-Altera-Dados'] = "Secinfor/alterar_dados_falha";

$route['Secinfor-Processadores'] = "Secinfor/processadores";
$route['Secinfor-Processadores-Cadastrar'] = "Secinfor/cadastrar_processador";
$route['Secinfor-Processadores-Editar/(:num)'] = "Secinfor/processadores_editar/$1";
$route['Secinfor-Processadores-Altera-Dados'] = "Secinfor/alterar_dados_processador";

$route['Secinfor-Base-Conhecimento'] = "Secinfor/base_conhecimento";
$route['Secinfor-Base-Conhecimento-Cadastrar'] = "Secinfor/cadastrar_base_conhecimento";
$route['Secinfor-Base-Conhecimento-Consultas'] = "Secinfor/base_conhecimento_consultas";
$route['Secinfor-Base-Conhecimento-Visualizar/(:num)'] = "Secinfor/base_conhecimento_visualizar/$1";
$route['Secinfor-Base-Conhecimento-Editar/(:num)'] = "Secinfor/base_conhecimento_editar/$1";
$route['Secinfor-Base-Conhecimento-Altera-Dados'] = "Secinfor/alterar_dados_base_conhecimento";



$route['Monitoramento'] = "Monitoramento/monitoramento";
$route['Monitoramento-Consultas'] = "Monitoramento/monitoramento_consultas";
$route['Monitoramento-Cadastrar'] = "Monitoramento/cadastrar_monitoramento";
$route['Monitoramento-Editar/(:num)'] = "Monitoramento/editar_monitoramento/$1";
$route['Monitoramento-Alterar'] = "Monitoramento/alterar_monitoramento";
$route['Monitoramento-Modelos'] = "Monitoramento/monitoramento_modelos";
$route['Monitoramento-Cadastrar-Marcas'] = "Monitoramento/cadastrar_marca";
$route['Monitoramento-Editar-Marcas/(:num)'] = "Monitoramento/editar_modelos/$1";
$route['Monitoramento-Alterar-Marcas'] = "Monitoramento/alterar_dados_modelo";



$route['Antena'] = "Antena/antena";
$route['Antena-Consultas'] = "Antena/antena_consultas";
$route['Antena-Cadastrar'] = "Antena/cadastrar_antena";
$route['Antena-Editar/(:num)'] = "Antena/editar_antena/$1";
$route['Antena-Alterar'] = "Antena/alterar_antena";
$route['Antena-Modelos'] = "Antena/antena_modelos";
$route['Antena-Cadastrar-Marcas'] = "Antena/cadastrar_marca";
$route['Antena-Editar-Marcas/(:num)'] = "Antena/editar_modelos/$1";
$route['Antena-Alterar-Marcas'] = "Antena/alterar_dados_modelo";
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */














