<?php include "includes/menu_ativos_rede.php"; ?> 

<script type="text/javascript">
    // JavaScript Document
    var base_url = '<?= base_url() ?>';



    function exibe_equipamentos(pavilhao) {
 
        $.post(base_url + "Monitoramento/monitoramento_por_pavilhao", {
            pavilhao: pavilhao
        }, function (data) {
            $('#equipamento').html(data);
        });
    }








</script>

<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">
            <?php include "includes/sub_menu_monitoramento.php"; ?> 
            <h3 class="panel-body">Consultar Equipamentos de Monitoramento</h3>
            <div class="container-fluid" style="margin-top: 30px;">
                <form class="form-horizontal" role="form" method="post" action="#" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="pavilhao" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Pavilhão</label>
                        <div class="col-xs-8 col-sm-5">
                            <select class="form-control" id="pavilhao" name="pavilhao" onchange="exibe_equipamentos(this.value);" >
                                <option value=''>Selecione...</option>
                                <?php if ($pavilhao != false): ?>
                                    <?php foreach ($pavilhao->result() as $linha) : ?>
                                        <option value="<?= $linha->pavilhao_id ?>" <?= ($linha->pavilhao_id == $this->session->flashdata('pavilhao')) ? 'selected' : '' ?>><?= $linha->pavilhao_nome ?> </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select> 
                            <span class="text-danger"><?php echo form_error('pavilhao'); ?></span>
                        </div> 
                    </div>



                    <div class="form-group" style="z-index: 1; overflow: auto;">                        
                        <div class="col-xs-12">
                            <table id='equipamento_cadastrado' class='table table-hover table-responsive' cellspacing='0' width='100%' style="z-index: 1; overflow: auto;">
                                <caption ALIGN='top' style='color: #337ab7'>Equipamentos Cadastrados </caption>
                                <thead>
                                    <tr>
                                        <th>Dispositivo</th>
                                        <th style="text-align: center;">Local</th>
                                        <th style="text-align: center;">Tipo</th>
                                        <th style="text-align: center;">Hostname</th>
                                        <th style="text-align: center;">IP</th>
                                        <th style="text-align: center;">MAC</th>
                                        <th style="text-align: center;">Editar</th>
                                    </tr>
                                </thead>
                                <tbody id='equipamento'>
                                    <tr><td colspan='7'><div class='alert alert-info' role='alert' style="text-align: center;">Selecionar pavilhão na caixa de seleção</div></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>