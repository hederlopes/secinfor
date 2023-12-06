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


    //adiciona mascara ao MAc lwan
    $(document).ready(function () {
        var campo = $("#mac");
        campo.on("keypress", function () {
            var valor = $("#mac").val();


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


    function valida_ip(ip) {
//alert(ip);   
        // $('#ver_ip').html(ip);
        $.post(base_url + "Monitoramento/valida_ip", {
            ip: ip
        }, function (data) {
            // $('#ver_ip').html(data);
            if (data == 0) {
                document.getElementById("enviar").disabled = true;
                $('#ver_ip').html("<span class='text-danger' id='ver_ip'>IP Indisponível</span>");
            } else {
                document.getElementById("enviar").disabled = false;
                $('#ver_ip').html("<span class='text-success' id='ver_ip'>IP Disponível</span>");
            }
        });
    }

    

        function valida_mac(mac) {

            $.post(base_url + "Monitoramento/valida_mac", {
                mac: mac
            }, function (data) {
                $('#ver_mac').html(data);


            });
        }

        //adiciona mascara ao IP
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


</script>

<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">
           <?php include "includes/sub_menu_antena.php"; ?> 
            <h3 class="panel-body">Cadastro de Antenas</h3>
            <div class="container-fluid" style="margin-top: 30px;">
                <form class="form-horizontal" role="form" method="post" action="<?= base_url('Antena-Cadastrar') ?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="pavilhao" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Pavilhão</label>
                        <div class="col-xs-8 col-sm-5">
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
                    <div class="form-group" style="margin-top: 10px;">
                           <label for="local" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Local</label>
                        <div class="col-xs-8 col-sm-5">
                            <input type="text" class="form-control" id="local" name="local" value="<?= $this->session->flashdata('local'); ?>"   placeholder="Local">                     
                            <span class="text-danger"><?php echo form_error('local'); ?></span>
                        </div> 
                    </div>

              

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="equipamento" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Marca/Modelo</label>
                        <div class="col-xs-8 col-sm-5">
                            <select class="form-control" id="equipamento" name="equipamento">
                                <option value=''>Selecionar Equipamento...</option>
                                <?php if ($modelo != FALSE): ?>
                                    <?php foreach ($modelo->result() as $row): ?>
                                        <option value='<?= $row->equipamento_id ?>' <?= ($row->equipamento_id == $this->session->flashdata('equipamento')) ? 'selected' : '' ?> ><?= $row->equipamento_marca . "/" . $row->equipamento_modelo ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select> 
                            <span class="text-danger"><?php echo form_error('equipamento'); ?></span>
                        </div> 
                    </div>


                    <div class="form-group" style="margin-top: 10px;">
                        <label for="hostname" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Hostname</label>
                        <div class="col-xs-8 col-sm-5">
                            <input type="text" class="form-control" id="hostname" name="hostname" value="<?= $this->session->flashdata('hostname'); ?>"   placeholder="HOSTNAME">                     
                            <span class="text-danger"><?php echo form_error('hostname'); ?></span>
                        </div> 
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="mac" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">MAC</label>
                        <div class="col-xs-8 col-sm-5">
                            <input type="text" class="form-control" id="mac" name="mac" value="<?= $this->session->flashdata('mac'); ?>" onkeyup="valida_mac(this.value);" maxlength="17" placeholder="MAC ">                     
                            <span class="text-danger" id="ver_mac"></span>

                            <span class="text-danger"><?php echo form_error('mac'); ?></span>
                        </div> 
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="ip" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">IP</label>
                        <div class="col-xs-8 col-sm-5">
                            <input type="text" class="form-control" id="ip" name="ip" value="<?= $this->session->flashdata('ip'); ?>" onblur="valida_ip(this.value);" onkeyup="MascaraCampoGeral(this, 'number');" maxlength="13" placeholder="IP">                     
                            <span class="text-danger" id="ver_ip"></span>
                            <span class="text-danger"><?php echo form_error('ip'); ?></span>
                        </div> 
                    </div>




                    <div class="form-group" style="margin-top: 10px;">
                        <label for="obs" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Observações</label>
                        <div class="col-xs-8 col-sm-5">
                            <textarea class="form-control" id="obs" name="obs" placeholder="Informações Adicionais"><?= $this->session->flashdata('obs'); ?></textarea>
                            <span class="text-danger"><?php echo form_error('obs'); ?></span>
                        </div>
                    </div>




                    <div class="form-group" >
                        <div class="col-xs-12 col-sm-2 col-sm-offset-7" align="right">
                            <button type="submit" class="btn btn-primary" id="enviar" onclick="">
                                Cadastrar
                            </button>
                        </div>
                    </div>   
                </form>
            </div>
        </div>
    </div>
</div>