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
    function exibe_maquinas(pavilhao) {

        $.post(base_url + "Secinfor/listar_maquinas", {
            pavilhao: pavilhao
        }, function (data) {
            $('#maquina').html(data);
        });
    }

    function exibe_maquinas_by_secao(secao) {
        var pavilhao = $("#pavilhao").val();

        $.post(base_url + "Secinfor/listar_maquinas", {
            pavilhao: pavilhao,
            secao: secao
        }, function (data) {
            $('#maquina').html(data);
        });
    }

    function exibe_maquinas_by_name(pesquisar) {

        $.post(base_url + "Secinfor/listar_maquinas_by_name", {
            pesquisar: pesquisar

        }, function (data) {
            $('#maquina').html(data);
        });
    }


    function exibe_maquinas_modal(maquina_id) {
        
        $.post(base_url + "Secinfor/maquinas_modal", {
            maquina_id: maquina_id

                }, function (data) {
                    $('#ver').html(data);
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

    if (data == false) {
        $('#enviar').removeAttr('disabled');
        $('#ver_cpf').html(data);
    } else {
        $('#ver_cpf').html(data);
        $('#enviar').attr('disabled', 'disabled');
    }
</script>



<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="panel panel-default" id="ver">
                <div class="panel-heading">
                    <h3 class="panel-title"> <img src='wi'width=30 height=30 >  carregando...</h3>
                </div>
                <div class="panel-body">
                    <pre>
                        
                    </pre>
           
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px;  min-height: 700px;">
            <?php include "includes/sub_menu_maquina.php"; ?> 
            <h3 class="panel-body">Consultar Máquinas</h3>
            <div class="container-fluid" style="margin-top: 30px;">
                <form class="form-horizontal" role="form" method="post" action="#" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="pavilhao" class="col-xs-4 col-sm-2  control-label">Pavilhão</label>
                        <div class="col-xs-8 col-sm-4">
                            <select class="form-control" id="pavilhao" name="pavilhao" onchange="exibe_secao(this.value);exibe_maquinas(this.value);" >
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
                        <label for="secao" class="col-xs-4 col-sm-2 control-label">Seção</label>
                        <div class="col-xs-8 col-sm-4">
                            <select class="form-control" id="secao" name="secao" onchange="exibe_maquinas_by_secao(this.value);">
                                <option value=''>Selecione um pavilhão...</option>
                            </select> 
                            <span class="text-danger"><?php echo form_error('secao'); ?></span>
                        </div> 
                        <label for="pavilhao" class="col-xs-4 col-sm-1 control-label">Buscar</label>
                        <div class="col-xs-8 col-sm-4">
                            <input type="text" class="form-control" id="pesquisar" name="pesquisar" onkeydown="exibe_maquinas_by_name(this.value);">

                            <span class="text-danger"><?php echo form_error('pavilhao'); ?></span>
                        </div> 
                    </div>


                    <div class="form-group" style="z-index: 1; overflow: auto;">                        
                        <div class="col-xs-12">
                            <table id='software_cadastrado' class='table table-hover table-responsive' cellspacing='0' width='100%' style="z-index: 1; overflow: auto;">
                                <caption ALIGN='top' style='color: #337ab7'>Máquinas Cadastradas </caption>
                                <thead>
                                    <tr>
                                        <th>PC</th>
                                        <th style="text-align: center;">Tipo</th>
                                        <th style="text-align: center;">HD</th>
                                        <th style="text-align: center;"> RAM</th>
                                        <th style="text-align: center;"> SO</th>
                                        <th style="text-align: center;"> Antivírus CT</th>
                                        <th style="text-align: center;">Consulta</th>
                                        <th style="text-align: center;">Editar</th>
                                    </tr>
                                </thead>
                                <tbody id='maquina'>
                                    <tr><td colspan='8'><div class='alert alert-info' role='alert' style="text-align: center;">Selecionar pavilhão e seção na caixa de seleção</div></td></tr>
                                    <tr>
                                        <td id="tempo">

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>