<div style="margin-top: 10px;">
    <?php if ($this->router->fetch_class() == 'Secinfor' && $this->router->fetch_method() == 'impressoras') { ?>
        <ul class="nav nav-tabs">
        <?php } else { ?>
            <ul class="nav nav-tabs">
            <?php } ?>
                            <li  class="<?= ($this->router->fetch_class() == 'Secinfor' && ($this->router->fetch_method() == 'impressoras_consultas'
                     || $this->router->fetch_method() == 'alterar_dados_impressora'
                       || $this->router->fetch_method() == 'listar_impressoras'
                     || $this->router->fetch_method() == 'impressoras_editar')) ? 'active' : null; ?>">
                <a href="<?= base_url('Secinfor-Impressoras-Consultas') ?>">Consultas</a></li>
            <li class="<?= ($this->router->fetch_class() == 'Secinfor' && ($this->router->fetch_method() == 'impressoras' 
                    || $this->router->fetch_method() == 'cadastrar_impressoras'
                    || $this->router->fetch_method() == 'impressora_form_validation')) ? 'active' : null; ?>">
                <a href="<?= base_url('Secinfor-Impressoras') ?>">Cadastro</a></li>
      
        </ul>
</div>
