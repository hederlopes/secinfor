<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Datas_Sistema {

    private $CI; // Receberá a instância do Codeigniter
    private $permissaoView = 'sem-permissao'; // Recebe o nome da view correspondente à página informativa de usuário sem permissão de acesso
    private $loginView = 'acesso'; // Recebe o nome da view correspondente à tela de login

    public function __construct() {
        /*
         * Criamos uma instância do CodeIgniter na variável $CI
         */
        $this->CI = &get_instance();
    }

    function agora() {
        date_default_timezone_set("Brazil/East");
        $this->CI->load->helper('date');
        $agora = time();

        list($data, $horario, $periodo) = explode(" ", unix_to_human($agora, TRUE));
        list($hora, $minuto, $segundo) = explode(":", $horario);


        if ($periodo == "PM" && $hora != 12) {
            $hora = $hora + 12;
        }
        if ($periodo == "AM" && $hora == 12) {
            $hora = $hora - 12;
        }
        $horario = $hora . ":" . $minuto . ":" . $segundo;
        //list($ano, $mes, $dia) = explode("-", $data);  
        $exibe_data = $data . " " . $horario;


        if ($exibe_data != FALSE) {
            return $exibe_data;
        } else {
            return FALSE;
        }
    }

    function dia_semana($data) {
        //Array com os dias da semana
        $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');

        // Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
        // Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
        $diasemana_numero = date('w', strtotime($data));

        // Exibe o dia da semana com o Array
        return $diasemana[$diasemana_numero];
    }
    
    
        function mes_atual($data) {
        //Array com os dias da semana
        $mesatual = array('01'=>'Janeiro','02'=> 'Fevereiro', '03'=>'Março','04'=> 'Abril', '05'=>'Maio','06'=> 'Junho','07'=> 'Julho','08'=> 'Agosto','09'=> 'Setembro','10'=> 'Outubro','11'=> 'Novembro','12'=> 'Dezembro');

        // Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
        // Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
        $mesatual_numero = date('m', strtotime($data));

        // Exibe o dia da semana com o Array
        return $mesatual[$mesatual_numero];
    }

}
