<div style="margin-top: 10px;">
    <?php if ($this->router->fetch_class() == 'Secinfor' && $this->router->fetch_method() == 'maquinas') { ?>
        <ul class="nav nav-tabs">
        <?php } else { ?>
            <ul class="nav nav-tabs">
            <?php } ?>
            <li class="<?= ($this->router->fetch_class() == 'Secinfor' && ($this->router->fetch_method() == 'falha' || $this->router->fetch_method() == 'cadastrar_falha')) ? 'active' : null; ?>">
                <a href="<?= base_url('Secinfor-Falhas') ?>">Cadastro</a></li>
            <li  class="<?= ($this->router->fetch_class() == 'Secinfor' && ($this->router->fetch_method() == 'falha_consultas' || $this->router->fetch_method() == 'falha_editar')) ? 'active' : null; ?>">
                <a href="<?= base_url('Secinfor-Falhas-Consultas') ?>">Consultas</a></li>      
        </ul>
</div>
