 
<?php include "includes/menu_relatorio.php"; ?> 

<script>

    var base_url = '<?= base_url() ?>';

    function exibe_software(so) {

        $.post(base_url + "Secinfor/listar_maquinas_by_so", {
            so: so
        }, function (data) {
            $('#maquinas_cadastradas').html(data);

        });
    }  

</script>
<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">

            <h3 class="panel-body">Relatórios de Máquinas por SO</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" method="post" action="<?= base_url('#') ?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="so" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Sistema Operacional</label>
                        <div class="col-xs-8 col-sm-5">
                            <select class="form-control" id="so" name="so" onchange="exibe_software(this.value);" >
                                <option value="">Selecione um SO...</option>
                                <?php foreach ($so->result() as $linha) : ?>
                                    <option value='<?= $linha->maquina_so ?>'><?= $linha->maquina_so ?></option>
                                <?php endforeach; ?>
                                <option value="todos">Exibir todos</option>
                            </select> 
                            <span class="text-danger"><?php echo form_error('so'); ?></span>
                        </div> 
                    </div>

                    <div class="form-group" style="z-index: 1; overflow: auto;">                        
                        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                            <table id='maquinas_cadastradas' class='table table-hover table-responsive' cellspacing='0' width='100%' style="z-index: 1; overflow: auto;">
                                <caption ALIGN='top' style='color: #337ab7'>Máquinas Cadastradas </caption>
                                <thead>
                                    <tr>
                                        <th>Hostname</th>
                                        <th>IP</th>
                                        <th>local</th>
                                        <!--<th style='width: 100px;text-align:center;'>Ativo/Inativo</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td colspan='3'><div class='alert alert-info' role='alert'>Selecionar Sistema Operacional na caixa de seleção</div></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                    <div class="form-group" style="margin-top: 10px;">
                        <div class='col-xs-12 col-sm-10 col-sm-offset-1' align='right'>
                            <a class='btn btn-primary' href='<?= base_url('Secinfor-Imprimir') ?>' role='button'> Imprimir</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>              
    </div>
</div>





