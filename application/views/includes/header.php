<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
        <title>Secinfor::3º RCC</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Bootstrap -->       
        <link href="<?= base_url('includes/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?= base_url('includes/bootstrap/css/ie10-viewport-bug-workaround.css'); ?>" rel="stylesheet">
        <link href="<?= base_url('includes/bootstrap/css/dashboard.css'); ?>" rel="stylesheet">
        <link href="<?= base_url('includes/bootstrap/datepicker/css/datepicker.css'); ?>" rel="stylesheet">
        <script src="<?= base_url('includes/bootstrap/js/jquery-3.1.1.js') ?>"></script>
        <script src="<?= base_url('includes/bootstrap/js/ie-emulation-modes-warning.js'); ?>" ></script>


        <!--data Table-->
        <link href="<?= base_url('includes/bootstrap/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>


      <link rel="shortcut icon" href="<?= base_url('img/logo.png') ?>" type="image/x-icon" />


        <!-- HTML5 shim e  Respond.js para suporte no IE8 de elementos HTML5 e media queries -->
        <!-- ALERTA: Respond.js não funciona se você visualizar uma página file:// -->
        <!--        [if lt IE 9]
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                [endif]-->
    </head>
    <body>
        <!-- Menu topbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>

                    </button>
                    <?php
                    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                    date_default_timezone_set('America/Sao_Paulo');
                    echo strftime('%A, %d de %B de %Y', strtotime('today'));
                    $this->load->library('Datas_Sistema');
                    $data = $this->datas_sistema->agora();
                    $semana = $this->datas_sistema->dia_semana($data);
                    ?>

                    <a class="navbar-brand" href="<?= base_url('Pagina_Inicial') ?>">Secinfor 3º RCC - <?php echo $semana . ", " . strftime('%d de %B de %Y', strtotime('today')); ?></a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown visible-xs">                         
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu Lateral<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('Secinfor-Estatisticas') ?>">Início</a></li>
                                <li><a href="<?= base_url('Secinfor-Maquinas-Consultas') ?>">Ativos de Rede</a></li>
                                <li><a href="<?= base_url('Secinfor-Relatorios') ?>">Relatórios</a></li>
                                <li><a href="<?= base_url('Secinfor-Secoes') ?>">Seções</a></li>
                                <li><a href="<?= base_url('Secinfor-Softwares') ?>">Software</a></li>
                                <li><a href="<?= base_url('Secinfor-Manutencoes') ?>">Manutenções</a></li>
                            </ul>
                        </li>  
                        <?php $status = $this->session->userdata('status'); ?>
                        <li class="dropdown">                         
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Status: <?= $status; ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('Logout') ?>">Sair</a></li>                              
                            </ul>
                        </li>    

                        <li><a href="#">Manual do Sistema</a></li>
                    </ul>
                </div>
            </div>
        </nav><!-- /Menu topbar -->

        <!-- Manu lateral esquerdo -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-3 col-xs-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="<?= ($this->router->fetch_class() == 'Secinfor' && $this->router->fetch_method() == 'estatisticas') ? 'active' : null; ?>">
                            <a href="<?= base_url('Secinfor-Estatisticas'); ?>">Início<span class="sr-only">(current)</span></a>
                        </li> 
                        <li  class="<?=
                        ($this->router->fetch_class() == 'Secinfor' && (
                        $this->router->fetch_method() == 'maquinas'
                        || $this->router->fetch_method() == 'maquinas_consultas'
                        || $this->router->fetch_method() == 'maquinas_editar'
                        || $this->router->fetch_method() == 'alterar_dados_maquina'
                        || $this->router->fetch_method() == 'cadastrar_maquinas'
                        || $this->router->fetch_method() == 'processadores'
                        || $this->router->fetch_method() == 'cadastrar_processador'
                        || $this->router->fetch_method() == 'processadores_editar'))
                        ||
                                    
                        ($this->router->fetch_class() == 'Secinfor' && (
                        $this->router->fetch_method() == 'impressoras'
                        || $this->router->fetch_method() == 'impressoras_consultas'
                        || $this->router->fetch_method() == 'impressoras_editar'
                        || $this->router->fetch_method() == 'alterar_dados_impressora'
                        || $this->router->fetch_method() == 'cadastrar_impressoras'))

                        ||


                        ($this->router->fetch_class() == 'Monitoramento' && (
                        $this->router->fetch_method() == 'monitoramento'
                        || $this->router->fetch_method() == 'monitoramento_consultas'
                        || $this->router->fetch_method() == 'monitoramento_modelos'
                        || $this->router->fetch_method() == 'cadastrar_marca'
                        || $this->router->fetch_method() == 'editar_modelos'
                        || $this->router->fetch_method() == 'alterar_dados_modelo'
                        || $this->router->fetch_method() == 'cadastrar_monitoramento'
                        || $this->router->fetch_method() == 'editar_monitoramento'
                        ))

                        ||

                        ($this->router->fetch_class() == 'Antena' && (
                        $this->router->fetch_method() == 'antena'
                        || $this->router->fetch_method() == 'antena_consultas'
                        || $this->router->fetch_method() == 'antena_modelos'
                        || $this->router->fetch_method() == 'cadastrar_marca'
                        || $this->router->fetch_method() == 'editar_modelos'
                        || $this->router->fetch_method() == 'alterar_dados_modelo'
                        || $this->router->fetch_method() == 'cadastrar_antena'
                        || $this->router->fetch_method() == 'editar_antena'
                        )) ? 'active' : null; ?>">
                            <a href="<?= base_url('Secinfor-Maquinas-Consultas') ?>">Ativos de Rede<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="<?= ($this->router->fetch_class() == 'Secinfor' && ($this->router->fetch_method() == 'secoes' || $this->router->fetch_method() == 'secoes_editar')) ? 'active' : null; ?>">
                            <a href="<?= base_url('Secinfor-Secoes') ?>">Seções<span class="sr-only">(current)</span></a>
                        </li>
                        <li  class="<?= ($this->router->fetch_class() == 'Secinfor' && ($this->router->fetch_method() == 'softwares' || $this->router->fetch_method() == 'softwares_editar')) ? 'active' : null; ?>">
                            <a href="<?= base_url('Secinfor-Softwares') ?>">Softwares<span class="sr-only">(current)</span></a>
                        </li>
                        <li  class="<?=
                        ($this->router->fetch_class() == 'Secinfor' && (
                        $this->router->fetch_method() == 'manutencoes' || $this->router->fetch_method() == 'manutencoes_novo' || $this->router->fetch_method() == 'cadastrar_manutencoes' || $this->router->fetch_method() == 'manutencoes_historico' || $this->router->fetch_method() == 'falha' || $this->router->fetch_method() == 'cadastrar_falha' || $this->router->fetch_method() == 'falha_consultas' || $this->router->fetch_method() == 'falha_editar' || $this->router->fetch_method() == 'alterar_dados_falha' || $this->router->fetch_method() == 'base_conhecimento' || $this->router->fetch_method() == 'base_conhecimento_editar' || $this->router->fetch_method() == 'base_conhecimento_consultas' || $this->router->fetch_method() == 'base_conhecimento_visualizar' || $this->router->fetch_method() == 'base_conhecimento_visualizar')) ? 'active' : null;
                        ?>">
                            <a href="<?= base_url('Secinfor-Manutencoes') ?>">Manutenções<span class="sr-only">(current)</span></a>
                        </li>
                        <li  class="<?= ($this->router->fetch_class() == 'Secinfor' && ($this->router->fetch_method() == 'relatorios_software' || $this->router->fetch_method() == 'relatorios_so')) ? 'active' : null; ?>">
                            <a href="<?= base_url('Secinfor-Relatorios') ?>">Relatórios<span class="sr-only">(current)</span></a></li>

                    </ul>
                </div>
                <!-- Início DIV conteúdo dinâmico -->
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">