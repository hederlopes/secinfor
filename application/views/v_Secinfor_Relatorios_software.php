
    <?php include "includes/menu_relatorio.php"; ?> 

<script>

    var base_url = '<?= base_url() ?>';

    function exibe_software(software) {

        $.post(base_url + "Secinfor/listar_maquinas_by_software", {
            software: software
        }, function (data) {
            $('#maquinas_cadastradas').html(data);

        });
    }


</script>
<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">
        
            <h3 class="panel-body">Relatórios de Máquinas por Software Proprietário</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" method="post" action="<?= base_url('#') ?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="software" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Software Proprietário</label>
                        <div class="col-xs-8 col-sm-5">
                            <select class="form-control" id="software" name="software" onchange="exibe_software(this.value);" >
                                <option value="">Selecione um Software...</option>
                                <?php foreach ($software->result() as $linha) : ?>
                                    <option value='<?= $linha->software_nome ?>'><?= $linha->software_nome ?></option>
                                <?php endforeach; ?>
                                <option value="todos">Exibir todos</option>
                            </select> 
                            <span class="text-danger"><?php echo form_error('software'); ?></span>
                        </div> 
                    </div>

                    <div class="form-group" style="z-index: 1; overflow: auto;">                        
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <table id='maquinas_cadastradas' class='table table-hover table-responsive' cellspacing='0' width='100%' style="z-index: 1; overflow: auto;">
                                <caption ALIGN='top' style='color: #337ab7'>Máquinas Cadastradas </caption>
                                <thead>
                                    <tr>
                                        <th>Hostname</th>
                                        <th align="center">IP</th>
                                         <th>Licença</th>
                                        <th align="center">Local</th>
                                        <!--<th style='width: 100px;text-align:center;'>Ativo/Inativo</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td colspan='4'><div class='alert alert-info' role='alert'>Selecionar Software na caixa de seleção</div></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>         
                </form>
            </div>              
        </div>
    </div>
</div>




