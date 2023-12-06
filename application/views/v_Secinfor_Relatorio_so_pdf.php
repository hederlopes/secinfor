
<style>

    page {
        background: white;
        display: block;
        margin: 30px auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
    }
    page[size="A4"] {
        width: 21cm;
        height: 29.7cm;
    }
    page[size="A4"][layout="portrait"] {
        width: 29.7cm;
        height: 21cm;
    }
    @media print {
        body,
        page {
            margin: 0;
            box-shadow: 0;
        }
    }
    .header {
        padding-top: 10px;
        text-align: center;
        border: 2px solid #fff;
    }

    @media print{
        .btn-group{display:none;}
        .nav{display:none;}
        .page-header{display:none;}

    }
    .th{
        padding-bottom: 5px;
        padding-top: 5px;
        color: #337ab7;
    }
    .td{

        display: block;
        width: 45%;
        height: 25px;
        padding: 10px 10px;
        font-size: 14px;
        margin-right: 2px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }
    h3{
        color: #337ab7;
    }
</style>
<page size="A4">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel">
                <div class="container-fluid" style=" margin: 10px;"> 

                    <div class="header">
                        <img src="<?= base_url('img/logo.png') ?>" alt="..."> 

                        <br><h3>Seção de Informática do 3º RCC</h3>                        

                        <br><b style="font:bold;">Lista de Máquinas </b>
                        <br>Data:&nbsp;  - Início:&nbsp;
                    </div> 
                    <br>

                    
                    </table>
                </div>
            </div>
        </div>
    </div>
</page>

<!--https://mpdf.github.io/paging/page-size-orientation.html-->


