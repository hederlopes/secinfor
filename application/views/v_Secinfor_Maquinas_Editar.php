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


//adiciona mascara ao MAc lan
    $(document).ready(function () {
        var campo = $("#maclan");
        campo.on("keypress", function () {
            var valor = $("#maclan").val();


            if (valor.length === 2) {
                campo.val(valor + ":");
            }
            if (valor.length === 5) {
                campo.val(valor + ":");
            }
            if (valor.length === 8) {
                campo.val(valor + ":");
            }
            if (valor.length === 11) {
                campo.val(valor + ":");
            }
            if (valor.length === 14) {
                campo.val(valor + ":");
            }



        });
    });
    //adiciona mascara ao MAc lwan
    $(document).ready(function () {
        var campo = $("#macwan");
        campo.on("keypress", function () {
            var valor = $("#macwan").val();

            if (valor.length === 2) {
                campo.val(valor + ":");
            }
            if (valor.length === 5) {
                campo.val(valor + ":");
            }
            if (valor.length === 8) {
                campo.val(valor + ":");
            }
            if (valor.length === 11) {
                campo.val(valor + ":");
            }
            if (valor.length === 14) {
                campo.val(valor + ":");
            }



        });
    });


    function valida_maclan(mac) {

        $.post(base_url + "Secinfor/valida_mac", {
            mac: mac
        }, function (data) {
            $('#ver_maclan').html(data);
        });
    }
    function valida_macwan(mac) {

        $.post(base_url + "Secinfor/valida_mac", {
            mac: mac
        }, function (data) {
            $('#ver_macwan').html(data);
        });
    }


    //adiciona mascara ao ip
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
        <div class="panel panel-default" style="margin-top: 10px;  min-height: 700px;">
            <?php include "includes/sub_menu_maquina.php"; ?> 
            <h3 class="panel-body">Editar Dados de Máquinas</h3>
            <div class="container-fluid" style="margin-top: 30px;">
                <form class="form-horizontal" role="form" method="post" action="<?= base_url('Secinfor-Maquinas-Altera-Dados') ?>" enctype="multipart/form-data">
                    <?php if ($maquina == false): ?>

                    <?php else: ?>
                        <?php foreach ($maquina->result() as $linha): ?>
                            <div class="form-group" style="margin-top: 10px;">
                                <div class="col-xs-4 col-sm-3 col-sm-offset-8">
                                    <?php $str = $linha->maquina_so ?>


                                    <?php if (strpos($str, 'Ubuntu') !== FALSE): ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/ubuntu.png') ?>' width=100 height=100> 
                                        <?php elseif (strpos($str, 'Mint 17') !== FALSE): ?>                               
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/mint17.png') ?>'width=100 height=100 >
                                        <?php elseif (strpos($str, 'Mint 18') !== FALSE): ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/mint18.jpeg') ?>'width=100 height=100 > 
                                        <?php elseif (strpos($str, 'Mint 19') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/mint19.png') ?>'width=100 height=100 > 
                                        <?php elseif (strpos($str, 'Mint 20') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/mint20.png') ?>'width=100 height=100 > 
                                        <?php elseif (strpos($str, 'Windows 7') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/win7.png') ?>'width=100 height=100 >
                                        <?php elseif (strpos($str, 'Windows 8') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/win8.png') ?>'width=100 height=100 > 
                                        <?php elseif (strpos($str, 'Windows Server') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/winsrv.png') ?>'width=110 height=100 > 
                                        <?php elseif (strpos($str, 'Windows 10') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/win10.png') ?>'width=100 height=100 > 
                                        <?php elseif (strpos($str, 'Windows 11') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/win11.png') ?>'width=100 height=100 > 
                                        <?php elseif (strpos($str, 'Mint 21') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/mint21.png') ?>'width=100 height=100 > 
                                        <?php elseif (strpos($str, 'Cent OS') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/centos.png') ?>'width=100 height=100 > 
                                        <?php elseif (strpos($str, 'Proxmox') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/proxmox.png') ?>'width=100 height=100 > 
                                        <?php elseif (strpos($str, 'Mac OS') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/macos.png') ?>'width=100 height=100 > 
                                        <?php elseif (strpos($str, 'IOS') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/ios.png') ?>'width=100 height=100 > 
                                        <?php elseif (strpos($str, 'Android') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/android.png') ?>'width=100 height=100 > 
                                        <?php elseif (strpos($str, 'IpadOS') !== FALSE) : ?>
                                        <td ALIGN='center'><img src='<?= base_url('img/so-image/ipados.png') ?>'width=100 height=100 > 


                                        <?php endif; ?>

                                </div>
                            </div>




                            <div class="form-group" style="margin-top: 10px;">
                                <label for="pavilhao" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Pavilhão</label>
                                <div class="col-xs-8 col-sm-5">
                                    <select class="form-control" id="secao" name="secao">
                                        <option value=''>Selecione...</option>
                                        <?php if ($pavilhao != false): ?>
                                            <?php foreach ($pavilhao->result() as $row) : ?>
                                                <option value="<?= $row->secao_id ?>" <?= ($row->secao_id == $linha->secao_id) ? 'selected' : '' ?>><?= $row->pavilhao_nome . " / " . $row->secao_nome ?> </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select> 

                                    <span class="text-danger"><?php echo form_error('pavilhao'); ?></span>
                                </div> 
                            </div>


                            <input type="hidden" class="form-control" id="maquina_id" value="<?= $linha->maquina_id; ?>" name="maquina_id">                          
                            <div class="form-group" style="margin-top: 10px;">
                                <label for="marca_modelo" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Marca/Modelo</label>
                                <div class="col-xs-8 col-sm-5">
                                    <input type="text" class="form-control" id="marca_modelo" value="<?= $linha->maquina_modelo; ?>" name="marca_modelo">                          
                                    <span class="text-danger"><?php echo form_error('marca_modelo'); ?></span>
                                </div> 
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <label for="tipo" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Tipo</label>
                                <div class="col-xs-8 col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="tipo" id="tipo_Desktop" value="Desktop" <?= ("Desktop" == $linha->maquina_tipo) ? 'checked' : '' ?>> Desktop
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="tipo" id="tipo_Notebook" value="Notebook" <?= ("Notebook" == $linha->maquina_tipo) ? 'checked' : '' ?>> Notebook
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="tipo" id="tipo_Tablet" value="Tablet" <?= ("Tablet" == $linha->maquina_tipo) ? 'checked' : '' ?>> Tablet
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="tipo" id="tipo_Servidor" value="Servidor" <?= ("Servidor" == $linha->maquina_tipo) ? 'checked' : '' ?>> Servidor
                                    </label>
                                    <span class="text-danger"><?php echo form_error('tipo'); ?></span>
                                </div> 
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <label for="so" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Sistema Operacional</label>
                                <div class="col-xs-8 col-sm-5">
                                    <select class="form-control" id="so" name="so">
                                        <option value=''>Selecione...</option>                                     
                                        <?php if ($so != FALSE): ?>
                                            <?php foreach ($so->result() as $row): ?>
                                                <option value='<?= $row->software_nome ?>' <?= ($row->software_nome == $linha->maquina_so) ? 'selected' : '' ?>><?= $row->software_nome ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select> 
                                    <span class="text-danger"><?php echo form_error('so'); ?></span>
                                </div> 
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <label for="licenca" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Possui Licença?</label>
                                <div class="col-xs-8 col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="licenca" id="licenca_gnu_free" value="Free GNU" <?= ("Free GNU" == $linha->maquina_licenca) ? 'checked' : '' ?>> Free GNU
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="licenca" id="licenca_semlicenca" value="Sem Licença" <?= ("Sem Licença" == $linha->maquina_licenca) ? 'checked' : '' ?>> Sem Licença
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="licenca" id="licenca_licenciado" value="Licenciado" <?= ("Licenciado" == $linha->maquina_licenca) ? 'checked' : '' ?>> Licenciado
                                    </label>
                                    <span class="text-danger"><?php echo form_error('licenca'); ?></span>
                                </div> 
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <label for="hostname" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Hostname</label>
                                <div class="col-xs-8 col-sm-5">
                                    <input type="text" class="form-control" id="hostname" name="hostname" value="<?= $linha->maquina_hostname; ?>">                     
                                    <span class="text-danger"><?php echo form_error('hostname'); ?></span>
                                </div> 
                            </div>




                            <div class="form-group" style="margin-top: 10px;">
                                <label for="maclan" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Mac LAN</label>
                                <div class="col-xs-8 col-sm-5">
                                    <input type="text" class="form-control" id="maclan" name="maclan" value="<?= $linha->maquina_maclan; ?>" onkeyup="valida_maclan(this.value);" maxlength="17">                     
                                    <span class="text-danger" id="ver_maclan"></span>
                                    <span class="text-danger"><?php echo form_error('maclan'); ?></span>
                                </div> 
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <label for="macwan" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Mac WAN</label>
                                <div class="col-xs-8 col-sm-5">
                                    <input type="text" class="form-control" id="macwan" name="macwan" value="<?= $linha->maquina_macwan; ?>" onkeyup="valida_macwan(this.value);" maxlength="17" >                     
                                    <span class="text-danger" id="ver_macwan"></span>
                                    <span class="text-danger"><?php echo form_error('macwan'); ?></span>
                                </div> 
                            </div>


                            <div class="form-group" style="margin-top: 10px;">
                                <label for="ip" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">IP</label>
                                <div class="col-xs-8 col-sm-5">
                                    <input type="text" class="form-control" id="ip" name="ip" value="<?= $linha->maquina_ip; ?>" onKeyup="MascaraCampoGeral(this, 'number');" maxlength="13">                     
                                    <span class="text-danger"><?php echo form_error('ip'); ?></span>
                                </div> 
                            </div>

                            <div class="form-group" style="margin-top: 10px;">
                                <label for="processador" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Processador</label>
                                <div class="col-xs-8 col-sm-5">
                                    <select class="form-control" id="processador" name="processador">
                                        <option value=''>Selecione...</option>
                                        <?php if ($processador != false): ?>
                                            <?php foreach ($processador->result() as $row) : ?>
                                                <option value="<?= $row->processador_id ?>" <?= ($row->processador_id == $linha->maquina_processador_id) ? 'selected' : '' ?>><?= $row->processador_modelo ?> </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select> 
                                    <span class="text-danger"><?php echo form_error('processador'); ?></span>
                                </div> 
                            </div>


                            <div class="form-group" style="margin-top: 10px;">
                                <label for="hd" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Capacidade HD</label>
                                <div class="col-xs-8 col-sm-5">
                                    <select class="form-control" id="hd" name="hd">
                                        <option value=''>Selecione...</option>
                                        <option value='64 Gb' <?= ('64 Gb' == $linha->maquina_hd) ? 'selected' : '' ?>>64 Gb</option>
                                        <option value='80 Gb' <?= ('80 Gb' == $linha->maquina_hd) ? 'selected' : '' ?>>80 Gb</option>
                                        <option value='160 Gb' <?= ('160 Gb' == $linha->maquina_hd) ? 'selected' : '' ?>>160 Gb</option>
                                        <option value='250 Gb' <?= ('250 Gb' == $linha->maquina_hd) ? 'selected' : '' ?>>250 Gb</option>
                                        <option value='320 Gb' <?= ('320 Gb' == $linha->maquina_hd) ? 'selected' : '' ?>>320 Gb</option>
                                        <option value='400 Gb' <?= ('400 Gb' == $linha->maquina_hd) ? 'selected' : '' ?>>400 Gb</option>
                                        <option value='500 Gb' <?= ('500 Gb' == $linha->maquina_hd) ? 'selected' : '' ?>>500 Gb</option>
                                        <option value='1 Tb' <?= ('1 Tb' == $linha->maquina_hd) ? 'selected' : '' ?>>1 Tb</option>
                                        <option value='2 Tb' <?= ('2 Tb' == $linha->maquina_hd) ? 'selected' : '' ?>>2 Tb</option>
                                        <option value='4 Tb' <?= ('4 Tb' == $linha->maquina_hd) ? 'selected' : '' ?>>4 Tb</option>
                                        <option value='8 Tb' <?= ('8 Tb' == $linha->maquina_hd) ? 'selected' : '' ?>>8 Tb</option>
                                        <option value='12 Tb' <?= ('12 Tb' == $linha->maquina_hd) ? 'selected' : '' ?>>12 Tb</option>
                                        <option value='14 Tb' <?= ('14 Tb' == $linha->maquina_hd) ? 'selected' : '' ?>>14 Tb</option>
                                        <option value='20 Tb' <?= ('20 Tb' == $linha->maquina_hd) ? 'selected' : '' ?>>20 Tb</option>

                                    </select> 
                                    <span class="text-danger"><?php echo form_error('hd'); ?></span>
                                </div> 
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <label for="ram" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Memória RAM</label>
                                <div class="col-xs-8 col-sm-5">
                                    <select class="form-control" id="ram" name="ram">
                                        <option value=''>Selecione...</option>
                                        <option value='2 Gb' <?= ('2 Gb' == $linha->maquina_ram) ? 'selected' : '' ?>>2 Gb</option>
                                        <option value='4 Gb' <?= ('4 Gb' == $linha->maquina_ram) ? 'selected' : '' ?>>4 Gb</option>
                                        <option value='6 Gb' <?= ('6 Gb' == $linha->maquina_ram) ? 'selected' : '' ?>>6 Gb</option>
                                        <option value='8 Gb' <?= ('8 Gb' == $linha->maquina_ram) ? 'selected' : '' ?>>8 Gb</option>
                                        <option value='16 Gb' <?= ('16 Gb' == $linha->maquina_ram) ? 'selected' : '' ?>>16 Gb</option>
                                        <option value='24 Gb' <?= ('24 Gb' == $linha->maquina_ram) ? 'selected' : '' ?>>24 Gb</option>
                                        <option value='32 Gb' <?= ('32 Gb' == $linha->maquina_ram) ? 'selected' : '' ?>>32 Gb</option>
                                        <option value='64 Gb' <?= ('64 Gb' == $linha->maquina_ram) ? 'selected' : '' ?>>64 Gb</option>
                                        <option value='72 Gb' <?= ('72 Gb' == $linha->maquina_ram) ? 'selected' : '' ?>>72 Gb</option>
                                    </select> 
                                    <span class="text-danger"><?php echo form_error('ram'); ?></span>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="antivirus" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Antivírus CT?</label>
                                <div class="col-xs-8 col-sm-5">
                                    <label class="radio-inline">
                                        <input type="radio" name="antivirus" id="licenca_sim" value="1" <?= ('1' == $linha->maquina_antivirus) ? 'checked' : '' ?>>Sim </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="antivirus" id="licenca_nao" value="0" <?= ('0' == $linha->maquina_antivirus) ? 'checked' : '' ?>> Não </label>
                                    <span class="text-danger"><?php echo form_error('antivirus'); ?></span>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <label for="licenca" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Observações</label>
                                <div class="col-xs-8 col-sm-5">
                                    <textarea class="form-control" id="observacoes" name="observacoes" placeholder="Informações Adicionais"><?= $linha->maquina_observacoes; ?></textarea>
                                    <span class="text-danger"><?php echo form_error('observacoes'); ?></span>
                                </div>
                            </div>


                            <div class="form-group" style="z-index: 1; overflow: auto;">                        
                                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                                    <table id='software_cadastrado' class='table table-hover table-responsive' cellspacing='0' width='100%' style="z-index: 1; overflow: auto;">
                                        <caption ALIGN='top' style='color: #337ab7'>Softwares proprietários instalados na máquina </caption>
                                        <thead>
                                            <tr>
                                                <th>Software</th>
                                                <th style='width: 150px;text-align:center;'>Incluir/Excluir</th>
                                                <th style='width: 150px;text-align:center;'>Possui licença?</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($software == false): ?>
                                                <tr><td colspan='3'><div class='alert alert-info' role='alert'>Nenhum software cadastrado</div></td></tr>
                                            <?php else: ?>

                                                <?php foreach ($software->result() as $row): ?>
                                                    <tr>
                                                        <td><?= $row->software_nome ?></td>
                                                        <?php
                                                        $this->load->model('M_Secinfor');
                                                        $sw = $this->M_Secinfor->m_software_by_maquina($linha->maquina_id, $row->software_id);
                                                        ?>
                                                        <td style='text-align:center;vertical-align: middle !important;'><input type='checkbox' name='software_id[]' value='<?= $row->software_id ?>' <?= ($sw == 1) ? 'checked' : '' ?>></td>                                 
                                                        <?php
                                                        $this->load->model('M_Secinfor');
                                                        $lic = $this->M_Secinfor->m_licenca_by_maquina($linha->maquina_id, $row->software_id);
                                                        ?>
                                                        <td style='text-align:center;vertical-align: middle !important;'><input type='checkbox' name='licenca_sw[]' id=""  value='<?= $row->software_id ?>' <?= (1 == $lic ) ? 'checked' : '' ?>></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>  

                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="form-group" >
                        <div class="col-sm-2 col-sm-offset-8" align="right">
                            <button type="submit" class="btn btn-primary" id="enviar" onclick="">
                                Salvar
                            </button>
                        </div>
                    </div>   
                </form>
            </div>
        </div>
    </div>
</div>