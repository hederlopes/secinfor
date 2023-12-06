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
    function exibe_maquinas(secao) {

        $.post(base_url + "Secinfor/listar_maquinas_select", {
            secao: secao
        }, function (data) {
            $('#pc_ip').html(data);
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


//adiciona mascara ao MAc
    $(document).ready(function () {
        var campo = $("#mac");
        campo.on("keypress", function () {
            var valor = $("#mac").val();


            if (valor.length === 2) {
                campo.val(valor + "-");
            }
            if (valor.length === 5) {
                campo.val(valor + "-");
            }
            if (valor.length === 8) {
                campo.val(valor + "-");
            }
            if (valor.length === 11) {
                campo.val(valor + "-");
            }
            if (valor.length === 14) {
                campo.val(valor + "-");
            }



        });
    });


    function valida_mac(mac) {

        $.post(base_url + "Secinfor/valida_mac", {
            mac: mac
        }, function (data) {
            $('#ver_mac').html(data);
        });
    }

    //adiciona mascara ao MAc
    $(document).ready(function () {
        var campo = $("#ip");
        campo.on("keypress", function () {
            var valor = $("#ip").val();

            if (valor.length === 2) {
                campo.val(valor + ".");
            }
            if (valor.length === 5) {
                campo.val(valor + ".");
            }
            if (valor.length === 9) {
                campo.val(valor + ".");
            }

        });
    });
    function habilita(software_id) {
        alert(software_id);
    }
    if (data == false) {
        $('#enviar').removeAttr('disabled');
        $('#ver_cpf').html(data);
    } else {
        $('#ver_cpf').html(data);
        $('#enviar').attr('disabled', 'disabled');
    }
</script>

<div class="row">
    <div class="col-xs-12 col-md-12">     
        <div class="panel panel-default" style="margin-top: 10px; height: auto;">
            <?php include "includes/sub_menu_impressora.php"; ?> 
             <h3 class="panel-body">Editar Dados de Impressoras</h3>
            <div class="container-fluid" style="margin-top: 30px;">
                <form class="form-horizontal" role="form" method="post" action="<?= base_url('Secinfor-Impressoras-Altera-Dados')?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="pavilhao" class="col-xs-2 col-xs-offset-2 control-label">Pavilhão</label>
                        <div class="col-xs-5">
                            <select class="form-control" id="pavilhao" name="pavilhao" onchange="exibe_secao(this.value);" >
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
                    <div class="form-group">
                        <label for="secao" class="col-xs-2 col-xs-offset-2 control-label">Seção</label>
                        <div class="col-xs-5">
                            <select class="form-control" id="secao" name="secao" onchange="exibe_maquinas(this.value);">
                                <option value=''>Selecione um pavilhão...</option>
                            </select> 
                            <span class="text-danger"><?php echo form_error('secao'); ?></span>
                        </div> 
                    </div>
                    <?php if ($impressora == false): ?>


                    <?php else: ?>
                        <?php foreach ($impressora->result() as $linha): ?>
                           <div class="form-group">
                        <label for="tipo" class="col-xs-2 col-xs-offset-2 control-label">Tipo Hardware</label>
                        <div class="col-xs-5">
                            <label class="radio-inline">
                                <input type="radio" name="tipo" id="tipo" value="Impressora" <?= ("Impressora" == $linha->impressora_tipo) ? 'checked' : '' ?>> Impressora
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="tipo" id="tipo" value="Scanner" <?= ("Scanner" == $linha->impressora_tipo) ? 'checked' : '' ?>> Scanner
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="tipo" id="tipo" value="Multifuncional" <?= ("Multifuncional" == $linha->impressora_tipo) ? 'checked' : '' ?>> Multifuncional
                            </label>
                            <span class="text-danger"><?php echo form_error('tipo'); ?></span>
                        </div> 
                    </div>
                    
                            <input type="hidden" class="form-control" id="impressora_id" value="<?= $linha->impressora_id ?>" name="impressora_id">
                            <div class="form-group">
                                <label for="marca_modelo" class="col-xs-2 col-xs-offset-2 control-label">Marca/Modelo</label>
                                <div class="col-xs-5">
                                    <input type="text" class="form-control" id="marca_modelo" value="<?= $linha->impressora_modelo ?>" name="marca_modelo" placeholder="Marca/Modelo da impressora                                                                                           " >                          
                                    <span class="text-danger"><?php echo form_error('marca_modelo'); ?></span>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label for="tipo_recarga" class="col-xs-2 col-xs-offset-2 control-label">Recarga</label>
                                <div class="col-xs-5">
                                    <select class="form-control" id="tipo_recarga" name="tipo_recarga">
                                        <option value=''>Selecione...</option>
                                        <option value='Toner' <?= ("Toner" == $linha->impressora_tipo_recarga) ? 'selected' : '' ?>>Toner</option>
                                        <option value='Cartucho' <?= ("Cartucho" == $linha->impressora_tipo_recarga) ? 'selected' : '' ?>>Cartucho</option>
                                        <option value='Tanque Bulk' <?= ("Tanque Bulk" == $linha->impressora_tipo_recarga) ? 'selected' : '' ?>>Tanque Bulk</option>
                                        <option value='Matricial' <?= ("Matricial" == $linha->impressora_tipo_recarga) ? 'selected' : '' ?>>Matricial</option>
                                    </select> 
                                    <span class="text-danger"><?php echo form_error('tipo_recarga'); ?></span>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label for="modelo_recarga" class="col-xs-2 col-xs-offset-2 control-label">Modelo Recarga</label>
                                <div class="col-xs-5">
                                    <input type="text" class="form-control" id="hostname" name="modelo_recarga" value="<?= $linha->impressora_modelo_recarga ?>"   placeholder="Modelo da Recarga">                     
                                    <span class="text-danger"><?php echo form_error('modelo_recarga'); ?></span>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="impressao" class="col-xs-2 col-xs-offset-2 control-label">Tipo Impressão</label>
                                <div class="col-xs-5">
                                    <label class="radio-inline">
                                        <input type="radio" name="impressao" id="impressao" value="Color" <?= ("Color" == $linha->impressora_impressao) ? 'checked' : '' ?>> Color
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="impressao" id="impressao" value="Monocromática" <?= ("Monocromática" == $linha->impressora_impressao) ? 'checked' : '' ?>> Monocromática
                                    </label>
                                    <span class="text-danger"><?php echo form_error('impressao'); ?></span>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label for="pc_ip" class="col-xs-2 col-xs-offset-2 control-label">IP PC</label>
                                <div class="col-xs-5">
                                    <select class="form-control" id="pc_ip" name="pc_ip">
                                        <option value=''>Selecione uma seção...</option>
                                    </select> 
                                    <span class="text-danger"><?php echo form_error('pc_ip'); ?></span>
                                </div> 
                            </div>


                            <div class="form-group">
                                <label for="pcs_conectados" class="col-xs-2 col-xs-offset-2 control-label">PC's Conectados</label>
                                <div class="col-xs-5">
                                    <input type="number" class="form-control" id="pcs_conectados" name="pcs_conectados" value="<?= $linha->impressora_pcs_conectados; ?>" min='0' placeholder=" Qtd de PC´s que imprimem nessa impressora">                     
                                    <span class="text-danger"><?php echo form_error('pcs_conectados'); ?></span>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="observacoes" class="col-xs-2 col-xs-offset-2 control-label">Observações</label>
                                <div class="col-xs-5">
                                    <textarea class="form-control" id="observacoes" name="observacoes" placeholder="Informações Adicionais"><?= $linha->impressora_observacoes; ?></textarea>
                                    <span class="text-danger"><?php echo form_error('observacoes'); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="form-group" >
                        <div class="col-xs-2 col-xs-offset-7" align="right">
                            <button type="submit" class="btn btn-primary" id="enviar" onclick="">
                                Alterar
                            </button>
                        </div>
                    </div>   
                </form>
            </div>
        </div>
    </div>
</div>