
<!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
<script type="text/javascript" src="<?= base_url('includes/bootstrap/charts/loader.js'); ?>"></script>

<div class="row">
    <div class="col-xs-12 col-md-12">   
        <div class="panel panel-default" style="margin-top: 10px; min-height: 700px;">        
            <h3 class="panel-body">Estatísticas</h3>   
            <div class="container-fluid">
                <form class="form-horizontal" role="form" method="post" action="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-xs-6 col-md-6">
                            <div id="piechart" style="width: 450px; height: 250px;"></div>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <div id="piechart_antivirus" style="width: 450px; height: 250px;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-md-12">
                            <div id="columnchart_material" class="center-block"  style="width: 900px; height: 250px;"></div>                      
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="col-xs-6 col-md-6">
                            <div id="piechart_hd" style="width: 450px; height: 250px;"></div>                       
                        </div>  
                        <div class="col-xs-6 col-md-6">
                            <div id="piechart_ram" style="width: 450px; height: 250px;"></div> 
                        </div>  
                    </div>           
                </form>
            </div>              

        </div>
    </div>
</div>
<script type="text/javascript">

    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = google.visualization.arrayToDataTable([
    ['SO', 'quantidade']
<?php foreach ($so->result() as $linha): ?>
        , ['<?= $linha->maquina_so; ?>', <?= $linha->quantidade; ?>]
<?php endforeach; ?>
    ]);
    var options = {
    title: 'Sistemas Operacionais',
            is3D: true
           //  colors: ['#69B53F', '#E95420', '#00ADEF', '#112D52', '#FFC300']
            
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChartAntivirus);
    function drawChartAntivirus() {
    var data = google.visualization.arrayToDataTable([
    ['Antivurus', 'quantidade']
<?php foreach ($antivirus->result() as $linha): ?>
        , ['<?= $linha->antivirus; ?>', <?= $linha->quantidade; ?>]
<?php endforeach; ?>
    ]);
    var options = {
    title: 'Antivirus CT Instalado',
            is3D: true,
            colors: ['#EA0000', '#000000']

    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart_antivirus'));
    chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChartHD);
    function drawChartHD() {
    var data = google.visualization.arrayToDataTable([
    ['hd', 'quantidade']
<?php foreach ($hd->result() as $linha): ?>
        , ['<?= $linha->maquina_hd; ?>', <?= $linha->quantidade; ?>]
<?php endforeach; ?>
    ]);
    var options = {
    title: 'HD',
            is3D: true,
           colors:['#00a859', '#e1dd21', '#195493', '#F5F5F5']

    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart_hd'));
    chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChartRAM);
    function drawChartRAM() {

    var data = google.visualization.arrayToDataTable([
    ['ram', 'quantidade']
<?php foreach ($ram->result() as $linha): ?>
        , ['<?= $linha->maquina_ram; ?>', <?= $linha->quantidade; ?>]
<?php endforeach; ?>
    ]);
    var options = {
    title: 'Memória RAM',
            is3D: true,
            
            colors:  ['#2b2d24' ,'#49392e' ,'#1d3724', '#848472']

    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart_ram'));
    chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {'packages': ['bar']});
    google.charts.setOnLoadCallback(drawChartBar);
    function drawChartBar() {
    var data = google.visualization.arrayToDataTable([
    ['Software', 'Total', 'Licenciado', 'Sem Licença']
<?php foreach ($sw->result()as $linhas): ?>
        , ['<?= $linhas->software_nome ?>', <?= $linhas->total; ?>, <?= $linhas->licenca; ?>, <?= $linhas->sem_licenca; ?>]
<?php endforeach; ?>
    ]);
    var options = {

    chart: { title: 'Software',
            subtitle: 'Percentual de software proprietários utilizados',
    }

    };
    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
    }
   
</script>

<script type="text/javascript">
    google.charts.load('current', {'packages': ['bar']});
    google.charts.setOnLoadCallback(drawChartBar);
    function drawChartBar() {
    var data = google.visualization.arrayToDataTable([
    ['Software', 'Total', 'Licenciado', 'Sem Licença']

        <?php foreach ($sw->result()as $linhas): ?>
        , ['<?= $linhas->software_nome ?>', <?= $linhas->total; ?>, <?= $linhas->licenca; ?>, <?= $linhas->sem_licenca; ?>]
<?php endforeach; ?>
    
    
    ]);
    var options = {

    chart: {
    title: 'Software',
            subtitle: 'Percentual de software proprietários utilizados',
    }

    };
    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>

