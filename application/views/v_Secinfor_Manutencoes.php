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
  <h3 class="panel-body">Manutenções</h3>
            <div class="container-fluid" style="margin-top: 30px;">
                <form class="form-horizontal" role="form" method="post" action="#" enctype="multipart/form-data">


                    <div class="form-group" style="margin-top: 10px;">
                        <label for="ip" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">IP</label>
                        <div class="col-xs-8 col-sm-5">
                            <input type="text" class="form-control" id="ip" name="ip" value="<?= $this->session->flashdata('ip'); ?>" onKeyup="MascaraCampoGeral(this, 'number');exibe_maquinas(this.value);" autofocus maxlength="13" placeholder="IP">                     
                            <span class="text-danger"><?php echo form_error('ip'); ?></span>
                        </div> 
                    </div>

                    <div class="form-group" style="z-index: 1; overflow: auto;">                        
                        <div class="col-xs-12 col-sm-12">
                            <table id='maquinas_cadastradas' class='table table-hover table-responsive' cellspacing='0' width='100%' style="z-index: 1; overflow: auto;">
                                <caption ALIGN='top' style='color: #337ab7'>Máquinas Cadastradas </caption>
                                <thead>
                                    <tr>                                 
                                        <th style="text-align: center;">Hostname</th>
                                        <th style="text-align: center;">MAC</th>                                       
                                        <th style="text-align: center;">Seção</th>                                    
                                        <th style="text-align: center;">Histórico</th>
                                        <th style="text-align: center;">Nova Manutenção</th>
                                    </tr>
                                </thead>
                                <tbody id='maquina'>
                                    <tr><td colspan='5'><div class='alert alert-info' role='alert' style="text-align: center;">Pesquisar máquina por IP</div></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 

                    
                </form>
            </div>
        </div>
    </div>
</div>