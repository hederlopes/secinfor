
<?php if ($this->router->fetch_class() == 'Secinfor' && $this->router->fetch_method() == 'maquinas') { ?>
    <ul class="nav nav-pills">
    <?php } else { ?>
        <ul class="nav nav-pills">
        <?php } ?>
        <li class="<?= ($this->router->fetch_class() == 'Secinfor' && $this->router->fetch_method() == 'relatorios_so') ? 'active' : null; ?>">
            <a href="<?= base_url('Secinfor-Relatorio-SO') ?>">Sistemas Operacionais</a></li>
        <li  class="<?= ($this->router->fetch_class() == 'Secinfor' && $this->router->fetch_method() == 'relatorios_software') ? 'active' : null; ?>">
            <a href="<?= base_url('Secinfor-Relatorio-Software') ?>">Software Proprietário</a></li> 
        <li  class="<?= ($this->router->fetch_class() == 'Secinfor' && $this->router->fetch_method() == 'relatorios_Cod') ? 'active' : null; ?>">
            <a href="<?= base_url('Secinfor-Relatorio-Cod') ?>">DHCP</a></li>
    </ul>

