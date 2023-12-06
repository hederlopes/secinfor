<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register_log {

    private $CI; // Receberá a instância do Codeigniter
    private $permissaoView = 'sem-permissao'; // Recebe o nome da view correspondente à página informativa de usuário sem permissão de acesso
    private $loginView = 'acesso'; // Recebe o nome da view correspondente à tela de login

    public function __construct() {
        /*
         * Criamos uma instância do CodeIgniter na variável $CI
         */
        $this->CI = &get_instance();
    }

    function CreateLog($operation) {
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


        $dados = [
            "log_datetime" => $exibe_data,
            "log_user" => $this->CI->session->userdata('militar_rcc_id'),
           "log_ip" => $this->CI->input->ip_address(),        
            "log_opetation" => $operation
        ];

        if ($this->CI->db->insert('log', $dados)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
