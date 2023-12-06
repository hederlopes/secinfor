


<script>

    var base_url = '<?= base_url() ?>';

    function exibe_software(categoria) {

        $.post(base_url + "Secinfor/listar_software", {
            categoria: categoria
        }, function (data) {
            $('#software_cadastrado').html(data);

        });
    }



</script>
<div class="row">
    <div class="col-xs-12 col-sm-12">     
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">
            <h3 class="panel-body">Softwares Proprietários</h3>
            <div class="container-fluid">
                <form class="form-horizontal" role="form" method="post" action="<?= base_url('Secinfor-Softwares-Cadastrar') ?>" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="categoria" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Categoria</label>
                        <div class="col-xs-8 col-sm-5">
                            <select class="form-control" id="categoria" name="categoria" onchange="exibe_software(this.value);" >
                                <option value=''>Selecione...</option>
                                <option value="Editores de texto" <?= ('Editores de texto' == $this->session->flashdata('categoria')) ? 'selected' : '' ?>>Design vetorial </option>
                                <option value="Edição de imagens" <?= ('Edição de imagens' == $this->session->flashdata('categoria')) ? 'selected' : '' ?>>Edição de imagens </option>
                                <option value="Pacote escritório" <?= ('Pacote Escritório' == $this->session->flashdata('categoria')) ? 'selected' : '' ?>>Pacote escritório </option>
                                <option value="Edição de Vídeos" <?= ('Edição de Vídeos' == $this->session->flashdata('categoria')) ? 'selected' : '' ?>>Edição de Vídeos </option>
                                <option value="Leitores PDF" <?= ('Leitores PDF' == $this->session->flashdata('categoria')) ? 'selected' : '' ?>>Leitores PDF </option>
                                <option value="Sistema Operacional" <?= ('Sistema Operacional' == $this->session->flashdata('categoria')) ? 'selected' : '' ?>>Sistema Operacional</option>
                                <option value="Outros" <?= ('Outros' == $this->session->flashdata('categoria')) ? 'selected' : '' ?>>Outros </option>
                            </select> 
                            <span class="text-danger"><?php echo form_error('categoria'); ?></span>
                        </div> 
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="software" class="col-xs-4 col-sm-3 col-sm-offset-1 control-label">Software</label>
                        <div class="col-xs-8 col-sm-5">
                            <input type="text" class="form-control" id="software" value="<?= $this->session->flashdata('software') ?>" name="software" placeholder="Nome do novo software">                          
                            <span class="text-danger"><?php echo form_error('software'); ?></span>
                        </div> 
                    </div>
                    <div class="form-group" >
                        <div class="col-sm-2 col-sm-offset-7" align="right">
                            <button type="submit" class="btn btn-primary" id="enviar" onclick="">
                                Cadastrar
                            </button>
                        </div>
                    </div>
                    <div class="form-group" style="z-index: 1; overflow: auto;">                        
                        <div class="col-sm-8 col-sm-offset-2">
                            <table id='software_cadastrado' class='table table-hover table-responsive' cellspacing='0' width='100%' style="z-index: 1; overflow: auto;">
                                <caption ALIGN='top' style='color: #337ab7'>Softwares Cadastrados </caption>
                                <thead>
                                    <tr>
                                        <th>Software</th>
                                        <th style='width: 100px;text-align:center;'>Ativo/Inativo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td colspan='2'><div class='alert alert-info' role='alert'>Selecionar categoria na caixa de seleção</div></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>         
                </form>
            </div>              
        </div>
    </div>
</div>




