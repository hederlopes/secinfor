<?php include "includes/menu_manutencao.php"; ?> 

<script type="text/javascript">
    // JavaScript Document
    var base_url = '<?= base_url() ?>';


    function exibe_falhas(falha) {
        $.post(base_url + "Secinfor/listar_falha", {
            falha: falha
        }, function (data) {
            $('#falhas_cadastradas').html(data);
        });
    }
    
    

</script>

<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">
            <?php include "includes/sub_menu_falha.php"; ?> 
             <h3 class="panel-body">Consultar Falhas</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" method="post" action="#" enctype="multipart/form-data">

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="falha" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Consultar Falhas</label>
                        <div class="col-xs-8 col-sm-5">
                            <input type="text" class="form-control" id="falha" name="falha" value="<?= $this->session->flashdata('falha'); ?>" onKeyup="exibe_falhas(this.value);" placeholder="Consultar Falhas">                     
                            <span class="text-danger"><?php echo form_error('falha'); ?></span>
                        </div> 
                    </div>

                    <div class="form-group" style="z-index: 1; overflow: auto;">                        
                        <div class="col-sm-8 col-sm-offset-2">
                            <table id='falhas_cadastradas' class='table table-hover table-responsive' cellspacing='0' width='100%' style="z-index: 1; overflow: auto;">
                                <caption ALIGN='top' style='color: #337ab7'>Falhas Cadastradas </caption>
                                <thead>
                                    <tr>
                                        <th>Falha</th>
                                        <th style='width: 100px;text-align:center;'>Editar</th>
                                    </tr>
                                </thead>
                                <tbody id="falhas_cadastradas">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>