<div style="margin-top: 10px;">
    <?php if ($this->router->fetch_class() == 'Secinfor' && $this->router->fetch_method() == 'maquinas') { ?>
        <ul class="nav nav-tabs">
        <?php } else { ?>
            <ul class="nav nav-tabs">
            <?php } ?>
            <li  class="<?= ($this->router->fetch_class() == 'Secinfor' && (
                    $this->router->fetch_method() == 'maquinas_consultas' 
                    || $this->router->fetch_method() == 'maquinas_editar')) ? 'active' : null; ?>">
                <a href="<?= base_url('Secinfor-Maquinas-Consultas') ?>">Consultas</a></li>
            
            <li class="<?= ($this->router->fetch_class() == 'Secinfor' && (
                    $this->router->fetch_method() == 'maquinas' 
                    || $this->router->fetch_method() == 'maquina_form_validation' 
                    || $this->router->fetch_method() == 'cadastrar_maquinas')) ? 'active' : null; ?>">
                <a href="<?= base_url('Secinfor-Maquinas') ?>">Cadastro</a></li>
            
            
                <li  class="<?= ($this->router->fetch_class() == 'Secinfor' && (
                   $this->router->fetch_method() == 'processadores' 
                || $this->router->fetch_method() == 'cadastrar_processador' 
                || $this->router->fetch_method() == 'processadores_editar')) ? 'active' : null; ?>">
            <a href="<?= base_url('Secinfor-Processadores') ?>">Processadores</a>
        </li>

        </ul>
</div>
