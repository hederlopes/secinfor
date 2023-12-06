 <?php include "includes/menu_manutencao.php"; ?> 

<script type="text/javascript">
    // JavaScript Document
    var base_url = '<?= base_url() ?>';

    function listar_base_conhecimento(consultar) {

        $.post(base_url + "Secinfor/listar_base_conhecimento", {
            consultar: consultar
        }, function (data) {
            $('#diagnostico').html(data);
        });
    }


</script>

<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">
            <h3 class="panel-body">Consultar Base de Conhecimento</h3>
            <div class="container-fluid" style="margin-top: 30px;">
                <form class="form-horizontal" role="form" method="post" action="#" enctype="multipart/form-data">

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="consultar" class="col-xs-4 col-sm-3 control-label">Consultar</label>
                        <div class="col-xs-8 col-sm-7">
                            <input type="text" class="form-control" id="consultar" name="consultar" value="<?= $this->session->flashdata('consultar'); ?>" onkeyup="listar_base_conhecimento(this.value);"   placeholder="Palavras-Chave">                     
                            <span class="text-danger"><?php echo form_error('consultar'); ?></span>
                        </div> 
                    </div>

                    <div class="form-group" style="z-index: 1; overflow: auto;">                        
                        <div class="col-xs-12">
                            <div class="col-xs-8 col-sm-12">
                                <div class="text text-info text-justify"> 
                                    <div id="diagnostico">
                                        <p><div class='text text-info'>Utilize a caixa de texto para consulta!</div></p>

                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
            </div> 
            </form>
        </div>
    </div>
</div>
</div>