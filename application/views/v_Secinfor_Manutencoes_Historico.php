
<?php include "includes/menu_manutencao.php"; ?> 
<script type="text/javascript">
    // JavaScript Document
    var base_url = '<?= base_url() ?>';


    function exibe_maquinas(ip) {
        $.post(base_url + "Secinfor/listar_maquina_by_ip", {
            ip: ip
        }, function (data) {
            $('#maquina').html(data);
        });
    }

    function MascaraCampoGeral(dom, tipo) {
        switch (tipo) {
            case 'number':
                var regex = /[A-za-z]/g;
                break;

            case 'text':
                var regex = /\d/g;
                break;
        }
        dom.value = dom.value.replace(regex, "");
    }

    function setaDadosModal(valor) {
        $('#campo').html(valor);
    }

</script>



<div id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-body">
                    <form id="modalExemplo" method="post" action="">
                        <div class="text text-info text-justify">                    
                            <div class="form-group">
                                <div class="col-sm-12">                          
                                    <div class="alert alert-info" role="alert" id="campo"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">
            <h3 class="panel-body">Histórico  de Manutenções</h3>
            <div class="container-fluid" style="margin-top: 30px;">
                <form class="form-horizontal" role="form" method="post" action="<?= base_url('Secinfor-Manutencoes-Cadastrar') ?>" enctype="multipart/form-data">
                    <div class="text text-info text-justify">
                        <?php if ($maquina != FALSE): ?> 
                            <?php foreach ($maquina->result() as $linha): ?> 
                                <div class="form-group">
                                    <div class="col-sm-4" >
                                        <label>Tipo:</label> <?= $linha->maquina_tipo ?> 
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Modelo:</label> <?= $linha->maquina_modelo ?> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4" >
                                        <label>Hostname:</label> <?= $linha->maquina_hostname ?> 
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>MAC: </label> <?= $linha->maquina_maclan ?> 
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>IP:</label> <?= $linha->maquina_ip ?> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" >
                                        <label>Sistema Operacional: </label> <?= $linha->maquina_so ?> <?= $linha->maquina_licenca ?>  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" >
                                        <label>Processador:</label> <?= $linha->processador_modelo ?>   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4" >
                                        <label>RAM:</label> <?= $linha->maquina_ram ?>    
                                    </div>
                                    <div class="col-sm-4" >
                                        <label>Capacidade HD: </label> <?= $linha->maquina_hd ?> <br>
                                    </div>
                                    <div class="col-sm-4" >
                                        <label>Antivírus CT:</label> <?= ($linha->maquina_antivirus == 1) ? "Instalado" : "<spam style='color: red;'><b>Não Instalado</b></spam>" ?>     
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>  
                    <?php endif; ?> 

                    <?php if ($historico != FALSE): ?> 
                        <?php foreach ($historico->result() as $linha): ?> 
                            <hr>
                            <div class="alert alert-info text-justify" role="alert">
                                <div class="form-group">
                                    <div class="col-sm-4" >
                                        <?php
                                        list($ano, $mes, $dia) = explode("-", $linha->manutencao_data);
                                        $data = $dia . "/" . $mes . "/" . $ano;
                                        ?>
                                        <label>Data:</label> <?= $data ?> 
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Lacre:</label> <?= $linha->manutencao_lacre ?> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4" >
                                        <label>Falha: </label> <?= $linha->falha_descricao ?>  
                                    </div>
                                    <div class="col-sm-4" >
                                        <label>Causa da falha:</label> <?= $linha->base_conhecimento_causa ?> 
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6" >
                                        <label>Troca de Componetes: </label> <?= $linha->manutencao_componentes ?>  
                                    </div>
                                    <div class="col-sm-6">
                                        <a data-toggle="modal" data-target="#modal" class="btn btn-primary" onclick="setaDadosModal('<strong>Solução: </strong><?= $linha->base_conhecimento_solucao ?>')">
                                            <span class="btn-label"><i class="fa fa-check"></i></span>Solução Aplicada
                                        </a>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>  
                    <?php endif; ?> 

                    <div class="form-group" >
                        <div class="col-xs-12 col-sm-2 col-sm-offset-10" align="right">
                            <a class="btn btn-primary" href="<?= base_url('Secinfor-Manutencoes') ?>">
                                Fechar
                            </a>
                        </div>
                    </div>   
            
                </form>
            </div>
        </div>
    </div>
</div>