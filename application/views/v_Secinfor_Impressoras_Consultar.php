<?php include "includes/menu_ativos_rede.php"; ?> 

<script type="text/javascript">
    // JavaScript Document
    var base_url = '<?= base_url() ?>';

    function exibe_secao(pavilhao) {

        $.post(base_url + "Secinfor/listar_secoes_select", {
            pavilhao: pavilhao
        }, function (data) {
            $('#secao').html(data);
        });
    }
    function exibe_impressoras(pavilhao) {

        $.post(base_url + "Secinfor/listar_impressoras", {
            pavilhao: pavilhao
        }, function (data) {
            $('#impressora').html(data);
        });
    }

    function exibe_impressoras_by_secao(secao) {
        var pavilhao = $("#pavilhao").val();
       
        $.post(base_url + "Secinfor/listar_impressoras", {
            pavilhao: pavilhao,
            secao: secao
        }, function (data) {
            $('#impressora').html(data);
        });
    }



  
</script>

<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; height: auto;">
            <?php include "includes/sub_menu_impressora.php"; ?> 
             <h3 class="panel-body">Consultar Impressoras</h3>
            <div class="container-fluid" style="margin-top: 30px;">
                <form class="form-horizontal" role="form" method="post" action="#" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="pavilhao" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Pavilhão</label>
                        <div class="col-xs-8 col-sm-5">
                            <select class="form-control" id="pavilhao" name="pavilhao" onchange="exibe_secao(this.value);exibe_impressoras(this.value);" >
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
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="secao" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Seção</label>
                        <div class="col-xs-8 col-sm-5">
                            <select class="form-control" id="secao" name="secao" onchange="exibe_impressoras_by_secao(this.value);">
                                <option value=''>Selecione um pavilhão...</option>
                            </select> 
                            <span class="text-danger"><?php echo form_error('secao'); ?></span>
                        </div> 
                    </div>

                    <div class="form-group" style="z-index: 1; overflow: auto;">                        
                        <div class="col-xs-12 col-sm-12">
                            <table id='software_cadastrado' class='table table-hover table-responsive' cellspacing='0' width='100%' style="z-index: 1; overflow: auto;">
                                <caption ALIGN='top' style='color: #337ab7'>Impressoras Cadastradas </caption>
                                <thead>
                                    <tr>
                                        <th>PC</th>
                                        <th style="text-align: center;">Tipo</th>
                                        <th style="text-align: center;">Modelo</th>
                                        <th style="text-align: center;"> Recarga</th>
                                        <th style="text-align: center;"> Impressão</th>
                                        <th style="text-align: center;"> PC's Conectados</th>
                                        <th style="text-align: center;">Editar</th>
                                    </tr>
                                </thead>
                                <tbody id='impressora'>
                                    <tr><td colspan='7'><div class='alert alert-info' role='alert' style="text-align: center;">Selecionar pavilhão e seção na caixa de seleção</div></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>