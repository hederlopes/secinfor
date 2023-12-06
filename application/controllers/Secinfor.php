<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Secinfor extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function maquinas() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Maquinas';
            $this->load->model('M_Secinfor');
            $dados['pavilhao'] = $this->M_Secinfor->m_carregar_pavilhoes();
            $dados['software'] = $this->M_Secinfor->m_listar_software_proprietario();
            $dados['so'] = $this->M_Secinfor->m_carregar_so();
            $dados['processador'] = $this->M_Secinfor->m_processadores_cadastrados();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function listar_secoes_select() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_listar_secoes();

        $option = "<option value=''>Selecione uma seção...</option>";
        if ($consulta == false) {
            echo $option .= "<option value=''>Nenhuma seção cadastrada</option>";
        } else {
            foreach ($consulta->result() as $linha) {
                $option .= "<option value='$linha->secao_id;'>" . $linha->secao_nome . "</option>";
            }
            echo $option;
        }
    }

    function valida_mac() {
        $mac_address = $this->input->post('mac');
        if (preg_match('#^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$#', $mac_address) > 0) {
            echo "Mac Válido";
        } else {
            echo "Mac Inválido";
        }
    }

    function cadastrar_maquinas() {
        $this->maquina_form_validation();

        if ($this->form_validation->run()) {
            $secao = $this->input->post('secao');
            $hostname = $this->input->post('hostname');
            $tipo = $this->input->post('tipo');
            $maclan = $this->input->post('maclan');
            $macwan = $this->input->post('macwan');
            $ip = $this->input->post('ip');
            $processador = $this->input->post('processador');
            $hd = $this->input->post('hd');
            $ram = $this->input->post('ram');
            $marca_modelo = $this->input->post('marca_modelo');
            $so = $this->input->post('so');
            $licenca = $this->input->post('licenca');
            $antivirus = $this->input->post('antivirus');
            $observacoes = $this->input->post('observacoes');
            $software_id = $this->input->post('software_id');
            $licenca_sw = $this->input->post('licenca_sw');
            $dados = ["maquina_secao_id" => $secao,
                "maquina_hostname" => $hostname,
                "maquina_tipo" => $tipo,
                "maquina_maclan" => $maclan,
                "maquina_macwan" => $macwan,
                "maquina_ip" => $ip,
                "maquina_processador_id" => $processador,
                "maquina_hd" => $hd,
                "maquina_ram" => $ram,
                "maquina_modelo" => $marca_modelo,
                "maquina_so" => $so,
                "maquina_licenca" => $licenca,
                "maquina_antivirus" => $antivirus,
                "maquina_observacoes" => $observacoes,
            ];

            $this->load->model('M_Secinfor');
            $id = $this->M_Secinfor->m_cadastrar_maquinas($dados);
            if ($software_id != "") {
                foreach ($software_id as $indice => $sw) {
                    $dados = ["maq_sw_maquina_id" => $id,
                        "maq_sw_software_id" => $sw,
                        "maq_sw_licenca" => 0];
                    $this->db->insert('maq_sw', $dados);
                }
            }
            if ($licenca_sw != "") {
                foreach ($licenca_sw as $indice => $lic_sw) {
                    $dados = ["maq_sw_licenca" => 1];
                    $this->db->where('maq_sw_maquina_id', $id);
                    $this->db->where('maq_sw_software_id', $lic_sw);
                    $this->db->update('maq_sw', $dados);
                }
            }
            if ($id) {
                $this->session->unset_userdata('secao');
                $this->session->unset_userdata('hostname');
                $this->session->unset_userdata('tipo');
                $this->session->unset_userdata('maclan');
                $this->session->unset_userdata('macwan');
                $this->session->unset_userdata('ip');
                $this->session->unset_userdata('processador');
                $this->session->unset_userdata('hd');
                $this->session->unset_userdata('ram');
                $this->session->unset_userdata('marca_modelo');
                $this->session->unset_userdata('so');
                $this->session->unset_userdata('licenca');
                $this->session->unset_userdata('antivirus');
                $this->session->unset_userdata('observacoes');
                $this->maquinas();
            }
        } else {
            $this->session->set_flashdata('secao', $this->input->post('secao'));
            $this->session->set_flashdata('hostname', $this->input->post('hostname'));
            $this->session->set_flashdata('tipo', $this->input->post('tipo'));
            $this->session->set_flashdata('maclan', $this->input->post('maclan'));
            $this->session->set_flashdata('macwan', $this->input->post('macwan'));
            $this->session->set_flashdata('ip', $this->input->post('ip'));
            $this->session->set_flashdata('processador', $this->input->post('processador'));
            $this->session->set_flashdata('hd', $this->input->post('hd'));
            $this->session->set_flashdata('ram', $this->input->post('ram'));
            $this->session->set_flashdata('marca_modelo', $this->input->post('marca_modelo'));
            $this->session->set_flashdata('so', $this->input->post('so'));
            $this->session->set_flashdata('licenca', $this->input->post('licenca'));
            $this->session->set_flashdata('antivirus', $this->input->post('antivirus'));
            $this->session->set_flashdata('observacoes', $this->input->post('observacoes'));
            $this->maquinas();
        }
    }

    function maquina_form_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('secao', 'Seção', 'required');
        $this->form_validation->set_rules('hostname', 'Hostname', 'required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required');
//        $this->form_validation->set_rules('maclan', 'MAC LAN', 'required');
        $this->form_validation->set_rules('ip', 'IP', 'required');
        $this->form_validation->set_rules('processador', 'Processador', 'required');
        $this->form_validation->set_rules('hd', 'Capacidade HD', 'required');
        $this->form_validation->set_rules('ram', 'Memória RAM', 'required');
        $this->form_validation->set_rules('marca_modelo', 'Marca/Modelo', 'required');
        $this->form_validation->set_rules('so', 'Sistema Operacional', 'required');
        $this->form_validation->set_rules('licenca', 'licença', 'required');
        $this->form_validation->set_rules('antivirus', 'Antivírus', 'required');
    }

    function maquinas_consultas() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Maquinas_Consultar';
            $this->load->model('M_Secinfor');
            $dados['pavilhao'] = $this->M_Secinfor->m_pavilhoes();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function listar_maquinas() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_listar_maquinas_consultas();
        $table = "";
        if ($consulta == false) {
            echo $table .= "<td colspan='8'>Nenhuma máquina cadastrada</td>";
        } else {
            foreach ($consulta->result() as $linha) {
                $table .= "<tr>";
                $table .= "<td>" . $linha->maquina_hostname . "/" . $linha->maquina_ip . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->maquina_tipo . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->maquina_hd . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->maquina_ram . "</td>";
//                $table .= "<td ALIGN='center'>" . $linha->maquina_mac . "</td>";

                $str = $linha->maquina_so;

                if (strpos($str, 'Ubuntu') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/ubuntu.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Mint 17') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/mint17.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Mint 18') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/mint18.jpeg') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Mint 19') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/mint19.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Mint 20') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/mint20.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Windows 7') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/win7.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Windows 8') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/win8.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Windows Server') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/winsrv.png') . "'width=35 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Windows 10') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/win10.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Debian') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/deb.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Windows 11') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/win11.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Mint 21') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/mint21.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Cent OS') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/centos.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Proxmox') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/proxmox.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Mac OS') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/macos.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'IOS') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/ios.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Android') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/android.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'IpadOS') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/ipados.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                }


                $antivirus = (1 == $linha->maquina_antivirus) ? "<img src='" . base_url('img/so-image/kes.png') . "'width=30 height=30 >" : "Não Instalado";
                $table .= "<td ALIGN='center'>" . $antivirus . "</td>";
                $table .= "<td ALIGN='center'><button type='button' class='btn btn-link' data-toggle='modal' onclick='exibe_maquinas_modal(" . $linha->maquina_id . ")' data-target='.bs-example-modal-lg'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></button>" .
                        "<input type='hidden' id='maquina_id' value='$linha->maquina_id' name='maquina_id'></td>";
                $table .= "<td ALIGN='center'><a class='btn btn-link' href='" . base_url("Secinfor-Maquinas-Editar") . "/" . $linha->maquina_id . "' role='button'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                $table .= "</tr>";
            }
            echo $table;
        }
    }

    function listar_maquinas_by_name() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_listar_maquinas_by_name();
        $table = "";
        if ($consulta == false) {
            echo $table .= "<td colspan='8'>Nenhuma máquina cadastrada</td>";
        } else {
            foreach ($consulta->result() as $linha) {
                $table .= "<tr>";
                $table .= "<td>" . $linha->maquina_hostname . "/" . $linha->maquina_ip . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->maquina_tipo . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->maquina_hd . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->maquina_ram . "</td>";
//                $table .= "<td ALIGN='center'>" . $linha->maquina_mac . "</td>";

                $str = $linha->maquina_so;

                if (strpos($str, 'Ubuntu') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/ubuntu.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Mint 17') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/mint17.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Mint 18') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/mint18.jpeg') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Mint 19') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/mint19.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Mint 20') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/mint20.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Windows 7') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/win7.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Windows 8') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/win8.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Windows Server') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/winsrv.png') . "'width=35 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Windows 10') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/win10.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Debian') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/deb.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Windows 11') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/win11.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Mint 21') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/mint21.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Cent OS') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/centos.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Proxmox') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/proxmox.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Mac OS') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/macos.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'IOS') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/ios.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'Android') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/android.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                } elseif (strpos($str, 'IpadOS') !== FALSE) {
                    $table .= "<td ALIGN='center'><img src='" . base_url('img/so-image/ipados.png') . "'width=30 height=30 > " . $linha->maquina_so . " " . $linha->maquina_licenca . "</td>";
                }





                $antivirus = (1 == $linha->maquina_antivirus) ? "<img src='" . base_url('img/so-image/kes.png') . "'width=30 height=30 >" : "Não Instalado";
                $table .= "<td ALIGN='center'>" . $antivirus . "</td>";
                $table .= "<td ALIGN='center'><button type='button' class='btn btn-link' data-toggle='modal' onclick='exibe_maquinas_modal(" . $linha->maquina_id . ")' data-target='.bs-example-modal-lg'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></button>" .
                        "<input type='hidden' id='maquina_id' value='$linha->maquina_id' name='maquina_id'></td>";
                $table .= "<td ALIGN='center'><a class='btn btn-link' href='" . base_url("Secinfor-Maquinas-Editar") . "/" . $linha->maquina_id . "' role='button'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                $table .= "</tr>";
            }
            echo $table;
        }
    }

    function maquinas_modal() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_exibe_maquinas_modal();

        $maquina = "";
        if ($consulta == false) {
            echo $maquina .= "";
        } else {
            foreach ($consulta->result() as $linha) {

                $maquina .= "<div class='panel-heading'>";



                $str = $linha->maquina_so;

                if (strpos($str, 'Ubuntu') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/ubuntu.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Mint 17') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/mint17.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Mint 18') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/mint18.jpeg') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Mint 19') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/mint19.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Mint 20') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/mint20.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Windows 7') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/win7.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Windows 8') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/win8.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Windows Server') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/winsrv.png') . "'width=35 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Windows 10') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/win10.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Debian') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/deb.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Windows 11') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/win11.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Mint 21') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/mint21.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Cent OS') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/centos.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Proxmox') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/proxmox.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Mac OS') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/macos.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'IOS') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/ios.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'Android') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/proxmox.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                } elseif (strpos($str, 'IpadOS') !== FALSE) {
                    $maquina .= "<h3 class='panel-title'><img src='" . base_url('img/so-image/ipados.png') . "'width=30 height=30 > " . $linha->maquina_hostname . "</h3>";
                }




                $maquina .= "</div>";
                $maquina .= "<div class='panel-body'>";
                $maquina .= "<pre>";

                $maquina .= "                        Local: " . $linha->pavilhao_nome . " | Seção: " . $linha->secao_nome . "<br>";
                $maquina .= "                        Ethernet IP: " . $linha->maquina_ip . " | MAC Adress: " . $linha->maquina_maclan . "<br>";
                $maquina .= "                        Tipo: " . $linha->maquina_tipo . " | Hostname: " . $linha->maquina_hostname . "<br>";
                $maquina .= "                        Procecador: " . $linha->processador_modelo . "<br>";
                $maquina .= "                        Sistema Operacional: " . $linha->maquina_so . "<br>";
                $maquina .= "                        Memória RAM: " . $linha->maquina_ram . "  |  HD: " . $linha->maquina_hd . "<br>";
                $antivirus = (1 == $linha->maquina_antivirus) ? "Instalado" : "Não Instalado";
                $maquina .= "                        Antivírus: " . $antivirus;

                $maquina .= "</pre>";

                $maquina .= "</div>";
                $maquina .= "<div class='modal-footer'>";
                $maquina .= "<button type='button' class='btn btn-primary' data-dismiss='modal'>Fechar</button>";
                $maquina .= "</div>";
            }
            echo $maquina;
        }
    }

    function editar_marca() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $this->load->model('M_Monitoramento');
            $dados['nome_view'] = 'v_Secinfor_Monitoramento_Modelo_Editar';
            if ($this->uri->segment(2) == FALSE) {
                $equipamento_id = $this->session->flashdata('equipamento_id');
            } else {
                $equipamento_id = $this->uri->segment(2);
            }
            $dados['maquina'] = $this->M_Secinfor->m_carregar_modelos($equipamento_id);

            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function maquinas_editar() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $this->load->model('M_Secinfor');
            $dados['nome_view'] = 'v_Secinfor_Maquinas_Editar';
            if ($this->uri->segment(2) == FALSE) {
                $maquina_id = $this->session->flashdata('maquina_id');
            } else {
                $maquina_id = $this->uri->segment(2);
            }
            $dados['maquina'] = $this->M_Secinfor->m_carregar_maquina($maquina_id);
            $dados['software'] = $this->M_Secinfor->m_listar_software_proprietario();
            $dados['so'] = $this->M_Secinfor->m_carregar_so();
            $dados['pavilhao'] = $this->M_Secinfor->m_carregar_pavilhoes();
            $dados['secao'] = $this->M_Secinfor->m_secoes();
            $dados['processador'] = $this->M_Secinfor->m_processadores_cadastrados();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    Function alterar_dados_maquina() {
        $this->maquina_form_validation();

        if ($this->form_validation->run()) {
            $maquina_id = $this->input->post('maquina_id');
            $secao = $this->input->post('secao');
            $hostname = $this->input->post('hostname');
            $tipo = $this->input->post('tipo');
            $maclan = $this->input->post('maclan');
            $macwan = $this->input->post('macwan');
            $ip = $this->input->post('ip');
            $processador = $this->input->post('processador');
            $hd = $this->input->post('hd');
            $ram = $this->input->post('ram');
            $marca_modelo = $this->input->post('marca_modelo');
            $so = $this->input->post('so');
            $licenca = $this->input->post('licenca');
            $antivirus = $this->input->post('antivirus');
            $observacoes = $this->input->post('observacoes');
            $software_id = $this->input->post('software_id');
            $licenca_sw = $this->input->post('licenca_sw');

            $dados = ["maquina_secao_id" => $secao,
                "maquina_hostname" => $hostname,
                "maquina_tipo" => $tipo,
                "maquina_maclan" => $maclan,
                "maquina_macwan" => $macwan,
                "maquina_ip" => $ip,
                "maquina_processador_id" => $processador,
                "maquina_hd" => $hd,
                "maquina_ram" => $ram,
                "maquina_modelo" => $marca_modelo,
                "maquina_so" => $so,
                "maquina_licenca" => $licenca,
                "maquina_antivirus" => $antivirus,
                "maquina_observacoes" => $observacoes,
            ];

            $this->load->model('M_Secinfor');
            $this->M_Secinfor->m_alterar_dados_maquina($dados, $maquina_id);
            $this->db->where('maq_sw_maquina_id', $maquina_id);
            $this->db->delete('maq_sw');

            if ($software_id != "") {
                foreach ($software_id as $indice => $sw) {
                    $dados = [
                        "maq_sw_maquina_id" => $maquina_id,
                        "maq_sw_software_id" => $sw,
                        "maq_sw_licenca" => 0
                    ];
                    $this->db->insert('maq_sw', $dados);
                }
            }
            if ($licenca_sw != "") {
                foreach ($licenca_sw as $indice => $lic_sw) {
                    $dados = [
                        "maq_sw_licenca" => 1
                    ];
                    $this->db->where('maq_sw_maquina_id', $maquina_id);
                    $this->db->where('maq_sw_software_id', $lic_sw);
                    $this->db->update('maq_sw', $dados);
                }
            }
            if ($maquina_id) {
                $this->session->unset_userdata('secao');
                $this->session->unset_userdata('hostname');
                $this->session->unset_userdata('tipo');
                $this->session->unset_userdata('maclan');
                $this->session->unset_userdata('macwan');
                $this->session->unset_userdata('ip');
                $this->session->unset_userdata('processador');
                $this->session->unset_userdata('hd');
                $this->session->unset_userdata('ram');
                $this->session->unset_userdata('marca_modelo');
                $this->session->unset_userdata('so');
                $this->session->unset_userdata('licenca');
                $this->session->unset_userdata('antivirus');
                $this->session->unset_userdata('observacoes');
                $this->maquinas_consultas();
            }
        } else {
            $this->session->set_flashdata('secao', $this->input->post('secao'));
            $this->session->set_flashdata('hostname', $this->input->post('hostname'));
            $this->session->set_flashdata('tipo', $this->input->post('tipo'));
            $this->session->set_flashdata('maclan', $this->input->post('maclan'));
            $this->session->set_flashdata('macwan', $this->input->post('macwan'));
            $this->session->set_flashdata('ip', $this->input->post('ip'));
            $this->session->set_flashdata('processador', $this->input->post('processador'));
            $this->session->set_flashdata('hd', $this->input->post('hd'));
            $this->session->set_flashdata('ram', $this->input->post('ram'));
            $this->session->set_flashdata('marca_modelo', $this->input->post('marca_modelo'));
            $this->session->set_flashdata('so', $this->input->post('so'));
            $this->session->set_flashdata('licenca', $this->input->post('licenca'));
            $this->session->set_flashdata('antivirus', $this->input->post('antivirus'));
            $this->session->set_flashdata('observacoes', $this->input->post('observacoes'));
            $this->session->set_flashdata('maquina_id', $this->input->post('maquina_id'));
            $this->maquinas_editar();
        }
    }

    public function secoes() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Secoes';
            $this->load->model('M_Secinfor');
            $dados['pavilhao'] = $this->M_Secinfor->m_pavilhoes();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function cadastrar_secao() {
        $this->secao_form_validation();
        if ($this->form_validation->run()) {

            $pavilhao = $this->input->post('pavilhao');
            $secao = $this->input->post('secao');
            $dados = ["secao_nome" => $secao, "secao_pavilhao_id" => $pavilhao];
            $this->load->model('M_Secinfor');
            if ($this->M_Secinfor->m_cadastrar_secao($dados)) {
                $this->session->unset_userdata('secao');
                $this->session->unset_userdata('pavilhao');
                $this->secoes();
            }
        } else {
            $this->session->set_flashdata('secao', $this->input->post('secao'));
            $this->session->set_flashdata('pavilhao', $this->input->post('pavilhao'));
            $this->secoes();
        }
    }

    function secao_form_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('secao', 'Seção', 'required');
        $this->form_validation->set_rules('pavilhao', 'Pavilhão', 'required');
    }

    function listar_secoes() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_listar_secoes();
        $table = "<caption ALIGN='top' style='color: #337ab7'>Seções Cadastradas </caption>";
        $table .= "<thead>";
        $table .= "<tr>";
        $table .= "<th>Seção</th>";
        $table .= "<th style='width: 100px;text-align:center;'>Status</th>";
        $table .= "</tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        if ($consulta == false) {
            echo $table .= "<tr><td colspan='2'><div class='alert alert-info' role='alert'>Nenhuma seção encontrada!</div></td></tr>";
        } else {
            foreach ($consulta->result() as $linha) {
                $table .= "<tr>";
                $table .= "<td>$linha->secao_nome</td>";
                $table .= "<td ALIGN='center'><a class='btn btn-link' href='" . base_url("Secinfor-Secoes-Editar") . "/" . $linha->secao_id . "' role='button'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                $table .= "</tr>";
            }
            $table .= "</tbody>";
            echo $table;
        }
    }

    function secoes_editar() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Secoes_Editar';
            if ($this->uri->segment(2) == FALSE) {
                $secao_id = $this->session->flashdata('secao_id');
            } else {
                $secao_id = $this->uri->segment(2);
            }
            $this->load->model('M_Secinfor');
            $dados['secao_id'] = $secao_id;
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function secao_alterar() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('secao', 'Seção', 'required');
        if ($this->form_validation->run()) {
            $secao_id = $this->input->post('secao_id');
            $dados = ["secao_nome" => $this->input->post('secao')];
            $this->db->where('secao_id', $secao_id);
            $this->db->update('secao', $dados);
            $this->secoes();
        } else {
            $this->session->set_flashdata('secao_id', $this->input->post('secao_id'));
            $this->secoes_editar();
        }
    }

    public function softwares() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Softwares';
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function cadastrar_software() {
        $this->software_form_validation();
        if ($this->form_validation->run()) {

            $software = $this->input->post('software');
            $categoria = $this->input->post('categoria');
            $dados = ["software_nome" => $software, "software_categoria" => $categoria];
            $this->load->model('M_Secinfor');
            if ($this->M_Secinfor->m_cadastrar_software($dados)) {
                $this->session->unset_userdata('categoria');
                $this->session->unset_userdata('software');
                $this->softwares();
            }
        } else {
            $this->session->set_flashdata('categoria', $this->input->post('categoria'));
            $this->session->set_flashdata('software', $this->input->post('software'));
            $this->softwares();
        }
    }

    function software_form_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('categoria', 'Categoria', 'required');
        $this->form_validation->set_rules('software', 'Software', 'required');
    }

    function listar_software() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_listar_software();
        $table = "<caption ALIGN='top' style='color: #337ab7'>Seções Cadastradas </caption>";
        $table .= "<thead>";
        $table .= "<tr>";
        $table .= "<th>Software</th>";
        $table .= "<th style='width: 100px;text-align:center;'>Status</th>";
        $table .= "</tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        if ($consulta == false) {
            echo $table .= "<tr><td colspan='2'><div class='alert alert-info' role='alert'>Nenhum Software encontrado!</div></td></tr>";
        } else {

            foreach ($consulta->result() as $linha) {
                $table .= "<tr>";
                $table .= "<td>$linha->software_nome</td>";
                $table .= "<td ALIGN='center'><a class='btn btn-link' href='" . base_url("Secinfor-Softwares-Editar") . "/" . $linha->software_id . "' role='button'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                $table .= "</tr>";
            }
            $table .= "</tbody>";
            echo $table;
        }
    }

    function softwares_editar() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Softwares_Editar';
            if ($this->uri->segment(2) == FALSE) {
                $software_id = $this->session->flashdata('software_id');
            } else {
                $software_id = $this->uri->segment(2);
            }
            $this->load->model('M_Secinfor');
            $dados['software_id'] = $software_id;
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function software_alterar() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('software', 'Software', 'required');
        if ($this->form_validation->run()) {
            $software_id = $this->input->post('software_id');
            $dados = ["software_nome" => $this->input->post('software')];
            $this->db->where('software_id', $software_id);
            $this->db->update('software', $dados);

            $this->softwares();
        } else {
            $this->session->set_flashdata('software_id', $this->input->post('software_id'));
            $this->softwares_editar();
        }
    }

    public function processadores() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Processadores';
            $this->load->model('M_Secinfor');
            $dados['processador'] = $this->M_Secinfor->m_processadores_cadastrados();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function cadastrar_processador() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('processador', 'Processador', 'required');

        if ($this->form_validation->run()) {
            $processador = $this->input->post('processador');
            $processador_lower = strtolower($processador);
            $dados = ["processador_modelo" => $processador_lower];
            $this->load->model('M_Secinfor');
            $id = $this->M_Secinfor->m_cadastrar_processador($dados);

            if ($id) {
                $this->session->unset_userdata('tipo');
                $this->processadores();
            }
        } else {
            $this->session->set_flashdata('processador', $this->input->post('processador'));

            $this->processadores();
        }
    }

    function processadores_editar() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Processadores_Editar';
            if ($this->uri->segment(2) == FALSE) {
                $processador_id = $this->session->flashdata('processador_id');
            } else {
                $processador_id = $this->uri->segment(2);
            }
            $this->load->model('M_Secinfor');
            $dados['processador'] = $this->M_Secinfor->m_processadores_by_id($processador_id);
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function alterar_dados_processador() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('processador', 'Processador', 'required');

        if ($this->form_validation->run()) {
            $processador_id = $this->input->post('processador_id');
            $processador = $this->input->post('processador');
            $dados = ["processador_modelo" => $processador];
            $this->load->model('M_Secinfor');

            if ($this->M_Secinfor->m_alterar_dados_processador($dados, $processador_id)) {
                $this->session->unset_userdata('processador_id');
                $this->session->unset_userdata('processador_modelo');
                $this->processadores();
            }
        } else {
            $this->session->set_flashdata('processador_id', $this->input->post('processador_id'));
            $this->session->set_flashdata('processador_modelo', $this->input->post('processador_modelo'));
            $this->processadores_editar();
        }
    }

    function impressoras() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Impressoras';
            $this->load->model('M_Secinfor');
            $dados['pavilhao'] = $this->M_Secinfor->m_carregar_pavilhoes();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function listar_maquinas_select() {
        $this->load->model('M_Secinfor');

        $consulta = $this->M_Secinfor->m_listar_maquinas();
        $option = "<option value=''>Selecione uma máquina...</option>";
        if ($consulta == false) {
            echo $option .= "<option value=''>Nenhuma maquina cadastrada</option>";
        } else {
            foreach ($consulta->result() as $linha) {
                $option .= "<option value='$linha->maquina_id'>" . $linha->maquina_hostname . "/" . $linha->maquina_ip . "</option>";
            }
            echo $option;
        }
    }

    function cadastrar_impressoras() {
        $this->impressora_form_validation();

        if ($this->form_validation->run()) {
            $tipo = $this->input->post('tipo');
            $marca_modelo = $this->input->post('marca_modelo');
            $tipo_recarga = $this->input->post('tipo_recarga');
            $modelo_recarga = $this->input->post('modelo_recarga');
            $impressao = $this->input->post('impressao');
            $pc_ip = $this->input->post('pc_ip');
            $pcs_conectados = $this->input->post('pcs_conectados');
            $observacoes = $this->input->post('observacoes');

            $dados = ["impressora_tipo" => $tipo,
                "impressora_modelo" => $marca_modelo,
                "impressora_tipo_recarga" => $tipo_recarga,
                "impressora_modelo_recarga" => $modelo_recarga,
                "impressora_impressao" => $impressao,
                "impressora_ip_pc" => $pc_ip,
                "impressora_pcs_conectados" => $pcs_conectados,
                "impressora_observacoes" => $observacoes
            ];

            $this->load->model('M_Secinfor');
            $id = $this->M_Secinfor->m_cadastrar_impressora($dados);

            if ($id) {
                $this->session->unset_userdata('tipo');
                $this->session->unset_userdata('marca_modelo');
                $this->session->unset_userdata('tipo_recarga');
                $this->session->unset_userdata('modelo_recarga');
                $this->session->unset_userdata('impressao');
                $this->session->unset_userdata('pc_ip');
                $this->session->unset_userdata('pcs_conectados');
                $this->session->unset_userdata('observacoes');

                $this->impressoras();
            }
        } else {
            $this->session->set_flashdata('tipo', $this->input->post('tipo'));
            $this->session->set_flashdata('marca_modelo', $this->input->post('marca_modelo'));
            $this->session->set_flashdata('tipo_recarga', $this->input->post('tipo_recarga'));
            $this->session->set_flashdata('modelo_recarga', $this->input->post('modelo_recarga'));
            $this->session->set_flashdata('impressao', $this->input->post('impressao'));
            $this->session->set_flashdata('pc_ip', $this->input->post('pc_ip'));
            $this->session->set_flashdata('pcs_conectados', $this->input->post('pcs_conectados'));
            $this->session->set_flashdata('observacoes', $this->input->post('observacoes'));
            $this->impressoras();
        }
    }

    function impressora_form_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required');
        $this->form_validation->set_rules('marca_modelo', 'Marca/Modelo', 'required');
        $this->form_validation->set_rules('tipo_recarga', 'Recarga', 'required');
        $this->form_validation->set_rules('modelo_recarga', 'Modelo Recarga', 'required');
        $this->form_validation->set_rules('impressao', 'Impressão', 'required');
        $this->form_validation->set_rules('pc_ip', 'IP PC', 'required');
        $this->form_validation->set_rules('pcs_conectados', "Qtd Pc's Conectados", 'required');
    }

    function impressoras_consultas() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Impressoras_Consultar';
            $this->load->model('M_Secinfor');
            $dados['pavilhao'] = $this->M_Secinfor->m_carregar_pavilhoes();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function listar_impressoras() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_listar_impressoras();
        $table = "";
        if ($consulta == false) {
            echo $table .= "<td colspan='7'>Nenhuma impressora cadastrada</td>";
        } else {

            foreach ($consulta->result() as $linha) {
                $table .= "<tr>";
                $table .= "<td>" . $linha->maquina_hostname . "/" . $linha->maquina_ip . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->impressora_tipo . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->impressora_modelo . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->impressora_tipo_recarga . "-" . $linha->impressora_modelo_recarga . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->impressora_impressao . "</td>";
                $table .= "<td ALIGN='center'>" . $linha->impressora_pcs_conectados . "</td>";
                $table .= "<td ALIGN='center'><a class='btn btn-link' href='" . base_url("Secinfor-Impressoras-Editar") . "/" . $linha->impressora_id . "' role='button'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                $table .= "</tr>";
            }
            echo $table;
        }
    }

    function impressoras_editar() {
        if ($this->session->userdata('status') == "On-line") {
            // Page            
            $dados['nome_view'] = 'v_Secinfor_Impressoras_Editar';
            if ($this->uri->segment(2) == FALSE) {
                $impressora_id = $this->session->flashdata('impressora_id');
            } else {
                $impressora_id = $this->uri->segment(2);
            }
            $this->load->model('M_Secinfor');
            $dados['pavilhao'] = $this->M_Secinfor->m_carregar_pavilhoes();
            $dados['impressora'] = $this->M_Secinfor->m_carregar_impressora($impressora_id);
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function alterar_dados_impressora() {
        $this->impressora_form_validation();
        if ($this->form_validation->run()) {
            $impressora_id = $this->input->post('impressora_id');
            $tipo = $this->input->post('tipo');
            $marca_modelo = $this->input->post('marca_modelo');
            $tipo_recarga = $this->input->post('tipo_recarga');
            $modelo_recarga = $this->input->post('modelo_recarga');
            $impressao = $this->input->post('impressao');
            $pc_ip = $this->input->post('pc_ip');
            $pcs_conectados = $this->input->post('pcs_conectados');
            $observacoes = $this->input->post('observacoes');

            $dados = ["impressora_tipo" => $tipo,
                "impressora_modelo" => $marca_modelo,
                "impressora_tipo_recarga" => $tipo_recarga,
                "impressora_modelo_recarga" => $modelo_recarga,
                "impressora_impressao" => $impressao,
                "impressora_ip_pc" => $pc_ip,
                "impressora_pcs_conectados" => $pcs_conectados,
                "impressora_observacoes" => $observacoes
            ];

            $this->load->model('M_Secinfor');

            if ($this->M_Secinfor->m_alterar_dados_impressora($dados, $impressora_id)) {
                $this->session->unset_userdata('tipo');
                $this->session->unset_userdata('marca_modelo');
                $this->session->unset_userdata('tipo_recarga');
                $this->session->unset_userdata('modelo_recarga');
                $this->session->unset_userdata('impressao');
                $this->session->unset_userdata('pc_ip');
                $this->session->unset_userdata('pcs_conectados');
                $this->session->unset_userdata('observacoes');
                $this->impressoras_consultas();
            }
        } else {
            $this->session->set_flashdata('tipo', $this->input->post('tipo'));
            $this->session->set_flashdata('marca_modelo', $this->input->post('marca_modelo'));
            $this->session->set_flashdata('tipo_recarga', $this->input->post('tipo_recarga'));
            $this->session->set_flashdata('modelo_recarga', $this->input->post('modelo_recarga'));
            $this->session->set_flashdata('impressao', $this->input->post('impressao'));
            $this->session->set_flashdata('pc_ip', $this->input->post('pc_ip'));
            $this->session->set_flashdata('pcs_conectados', $this->input->post('pcs_conectados'));
            $this->session->set_flashdata('observacoes', $this->input->post('observacoes'));
            $this->session->set_flashdata('impressora_id', $this->input->post('impressora_id'));
            $this->impressoras_editar();
        }
    }

    function estatisticas() {
        if ($this->session->userdata('status') == "On-line") {
            $dados['nome_view'] = 'v_Secinfor_Estatisticas';
            $this->load->model('M_Secinfor');
            $dados['so'] = $this->M_Secinfor->m_estatistica_so();
            $dados['sw'] = $this->M_Secinfor->m_estatistica_sw();
            $dados['antivirus'] = $this->M_Secinfor->m_estatistica_antivirus();
            $dados['hd'] = $this->M_Secinfor->m_estatistica_hd();
            $dados['ram'] = $this->M_Secinfor->m_estatistica_ram();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    public function relatorios_so() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Relatorios_so';
            $this->load->model('M_Secinfor');
            $dados['so'] = $this->M_Secinfor->m_relatorios_listar_so_cadastrados();

            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    //Imprimir Index
    public function relatorios_so_Imprimir_pdf() {
//          $so_uri = $this->uri->segment(2);
//
//        if (is_null($so_uri)) {
//            redirect(base_url(''));
//        }
        $dados['nome_view'] = 'v_Secinfor_Relatorio_so_pdf';
        $this->load->model('M_Secinfor');
        // $dados['maquinas'] = $this->M_Secinfor->m_listar_maquinas_by_so($so_uri);
        $this->load->view('template', $dados);
// Instancia a classe mPDF
        $mpdf = new mPDF('utf-8', 'A4-L');
// Ao invés de imprimir a view 'welcome_message' na tela, passa o código HTML dela para a variável $html
        $html = $this->load->view('template', $dados, TRUE);
// Define um Cabeçalho para o arquivo PDF
//$mpdf->SetHeader('::SisOM::'.$Modulo = "Relações Públicas");
// Define um rodapé para o arquivo PDF, nesse caso inserindo o número da página através da pseudo-variável PAGENO
        $mpdf->SetFooter('::SisOM::' . $Modulo = "Seção de informática-Relatórios Secinfor  " . '{PAGENO}');
// Insere o conteúdo da variável $html no arquivo PDF
        $mpdf->writeHTML($html);
// Cria uma nova página no arquivo
//$mpdf->AddPage();
// Insere o conteúdo na nova página do arquivo PDF
//$mpdf->WriteHTML('<p><b>Cadastro de Pessoas - PDF</b></p>');
// Gera o arquivo PDF
        $mpdf->Output();
    }

    function listar_maquinas_by_so() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_listar_maquinas_by_so();
        $table = "<caption ALIGN='top' style='color: #337ab7'>Máquinas Cadastradas</caption>";
        $table .= "<thead>";
        $table .= "<tr>";
        $table .= "<th>Hostname</th>";
        $table .= "<th>IP</th>";
        $table .= "<th>local</th >";
        //$table .= "<th style='width: 100px;text-align:center;'>Status</th>";
        $table .= "</tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        if ($consulta == false) {
            echo $table .= "<tr><td colspan='3'><div class='alert alert-info' role='alert'>Nenhuma máquina encontrada!</div></td></tr>";
        } else {

            foreach ($consulta->result() as $linha) {
                $table .= "<tr>";
                $table .= "<td>$linha->maquina_hostname</td>";
                $table .= "<td>$linha->maquina_ip</td>";
                $table .= "<td>$linha->secao_nome / $linha->pavilhao_nome</td>";
//                $table .= "<td ALIGN='center'><a class='btn btn-link' href='" . base_url("Secinfor-Softwares-Editar") . "/" . $linha->software_id . "' role='button'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                $table .= "</tr>";
            }
            $table .= "</tbody>";
            echo $table;
        }
    }

    public function relatorios_software() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Relatorios_software';
            $this->load->model('M_Secinfor');
            $dados['software'] = $this->M_Secinfor->m_relatorios_listar_software();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    public function relatorios_Cod() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Relatorios_Cod';
            $this->load->model('M_Secinfor');
            $this->M_Secinfor->m_carregar_sequencia();
            $dados['codigo'] = $this->M_Secinfor->m_listar_maquinas();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function listar_maquinas_by_software() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_listar_maquinas_by_software();
        $table = "<caption ALIGN='top' style='color: #337ab7'>Máquinas Cadastradas</caption>";
        $table .= "<thead>";
        $table .= "<tr>";
        $table .= "<th>Hostname</th>";
        $table .= "<th style='text-align :center'>IP</th>";
        $table .= "<th>Licença</th>";
        $table .= "<th style='text-align :center'>local</th >";
        $table .= "</tr>";
        $table .= "</thead>";
        $table .= "<tbody>";
        if ($consulta == false) {
            echo $table .= "<tr><td colspan='4'><div class='alert alert-info' role='alert'>Nenhuma máquina encontrada!</div></td></tr>";
        } else {
            foreach ($consulta->result() as $linha) {
                $table .= "<tr>";
                $table .= "<td>$linha->maquina_hostname</td>";
                $table .= "<td>$linha->maquina_ip</td>";
                ($linha->maq_sw_licenca == 1) ? $licenca = "Licenciado" : $licenca = "Não Possui";
                $table .= "<td>$licenca</td>";
                $table .= "<td>$linha->secao_nome / $linha->pavilhao_nome</td>";
//                $table .= "<td ALIGN='center'><a class='btn btn-link' href='" . base_url("Secinfor-Softwares-Editar") . "/" . $linha->software_id . "' role='button'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                $table .= "</tr>";
            }
            $table .= "</tbody>";
            echo $table;
        }
    }

    public function manutencoes() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Manutencoes';
            $this->load->model('M_Secinfor');
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function listar_maquina_by_ip() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_listar_maquina_by_ip();

        $table = "";
        if ($consulta == false) {
            $table .= "<tr><td colspan='5'><div class='alert alert-info' role='alert'>Nenhuma máquina encontrada!</div></td></tr>";
        } else {
            foreach ($consulta->result() as $linha) {
                $table .= "<tr>";
                $table .= "<td>$linha->maquina_hostname</td>";
                $table .= "<td>$linha->maquina_maclan</td>";
                $table .= "<td>$linha->secao_nome</td>";
                $table .= "<td ALIGN='center'><a class='btn btn-link' href='" . base_url("Secinfor-Manutencoes-Historico") . "/" . $linha->maquina_id . "' role='button'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></a></td>";
                $table .= "<td ALIGN='center'><a class='btn btn-link' href='" . base_url("Secinfor-Manutencoes-Novo") . "/" . $linha->maquina_id . "' role='button'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                $table .= "</tr>";
            }
        }
        echo $table;
    }

    function manutencoes_novo() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $this->load->model('M_Secinfor');
            $dados['nome_view'] = 'v_Secinfor_Manutencoes_Novo';
            if ($this->uri->segment(2) == FALSE) {
                $maquina_id = $this->session->flashdata('maquina_id');
            } else {
                $maquina_id = $this->uri->segment(2);
            }
            $dados['maquina'] = $this->M_Secinfor->m_carregar_maquina($maquina_id);
            $dados['falha'] = $this->M_Secinfor->m_listar_falha();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function carrega_causas() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_carrega_causas();
        $option = "";
        $option .= "<option value=''>Selecione...</option>";
        if ($consulta != FALSE) {
            foreach ($consulta->result() as $linha) {
                $option .= "<option value='$linha->base_conhecimento_id' >$linha->base_conhecimento_causa </option>";
            }
            echo $option;
        }
    }

    function cadastrar_manutencoes() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('data', 'Data Manutenção', 'required');
        $this->form_validation->set_rules('lacre', 'Número do lacre ', 'required');
        $this->form_validation->set_rules('falha', 'Falha', 'required');
        $this->form_validation->set_rules('causa', 'Causa', 'required');
        $this->form_validation->set_rules('componetes', 'Troca de Componentes', 'required');

        if ($this->form_validation->run()) {
            $maquina_id = $this->input->post('maquina_id');
            $data = $this->input->post('data');
            $lacre = $this->input->post('lacre');
            $falha = $this->input->post('falha');
            $causa = $this->input->post('causa');
            $componetes = $this->input->post('componetes');
            $observacoes = $this->input->post('observacoes');

            $dados = [
                "manutencao_maquina_id" => $maquina_id,
                "manutencao_data" => $data,
                "manutencao_lacre" => $lacre,
                "manutencao_falha_id" => $falha,
                "manutencao_base_conhecimento_id" => $causa,
                "manutencao_componentes" => $componetes,
                "manutencao_observacoes" => $observacoes,
            ];
            $this->load->model('M_Secinfor');
            $id = $this->M_Secinfor->m_cadastrar_manutencao($dados);
            if ($id) {
                $this->session->unset_userdata('maquina_id');
                $this->session->unset_userdata('data');
                $this->session->unset_userdata('lacre');
                $this->session->unset_userdata('falha');
                $this->session->unset_userdata('causa');
                $this->session->unset_userdata('componentes');
                $this->session->unset_userdata('observacoes');
                $this->manutencoes();
            }
        } else {
            $this->session->set_flashdata('maquina_id', $this->input->post('maquina_id'));
            $this->session->set_flashdata('data', $this->input->post('data'));
            $this->session->set_flashdata('lacre', $this->input->post('lacre'));
            $this->session->set_flashdata('falha', $this->input->post('falha'));
            $this->session->set_flashdata('causa', $this->input->post('causa'));
            $this->session->set_flashdata('componentes', $this->input->post('componentes'));
            $this->session->set_flashdata('observacoes', $this->input->post('observacoes'));
            $this->manutencoes_novo();
        }
    }

    function manutencoes_historico() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $this->load->model('M_Secinfor');
            $dados['nome_view'] = 'v_Secinfor_Manutencoes_Historico';
            if ($this->uri->segment(2) == FALSE) {
                $maquina_id = $this->session->flashdata('maquina_id');
            } else {
                $maquina_id = $this->uri->segment(2);
            }
            $dados['maquina'] = $this->M_Secinfor->m_carregar_maquina($maquina_id);
            $dados['historico'] = $this->M_Secinfor->m_carregar_historico_by_maquina($maquina_id);
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    public function falha() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Falhas';
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function cadastrar_falha() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('falha', 'Falha', 'required');

        if ($this->form_validation->run()) {
            $falha = $this->input->post('falha');
            $dados = [
                "falha_descricao" => $falha
            ];
            $this->load->model('M_Secinfor');
            $id = $this->M_Secinfor->m_cadastrar_falha($dados);
            if ($id) {
                $this->session->unset_userdata('falha');
                $this->falha();
            }
        } else {
            $this->session->set_flashdata('falha', $this->input->post('falha'));
            $this->falha();
        }
    }

    public function falha_consultas() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Falhas_Consultar';
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function listar_falha() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_listar_falha();
        $row = "";
        if ($consulta == FALSE) {
            echo $row .= "<tr><td colspan='2'><div class='text text-warning' role='alert'>Nenhuma resultado para esta consulta!</div></td></tr>";
        } else {

            foreach ($consulta->result() as $linha) {
                $row .= "<tr>";
                $row .= "<td>$linha->falha_descricao</td>";
                $row .= "<td ALIGN='center'><a class='btn btn-link' href='" . base_url("Secinfor-Falhas-Editar") . "/" . $linha->falha_id . "' role='button'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>";
                $row .= "</tr>";
            }
            echo $row;
        }
    }

    function falha_editar() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $this->load->model('M_Secinfor');
            $dados['nome_view'] = 'v_Secinfor_Falhas_Editar';
            if ($this->uri->segment(2) == FALSE) {
                $falha_id = $this->session->flashdata('falha_id');
            } else {
                $falha_id = $this->uri->segment(2);
            }
            $dados['falha'] = $this->M_Secinfor->m_listar_falha_by_id($falha_id);
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function alterar_dados_falha() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('falha', 'Falha', 'required');

        if ($this->form_validation->run()) {
            $falha_id = $this->input->post('falha_id');
            $falha = $this->input->post('falha');
            $dados = ["falha_descricao" => $falha
            ];

            $this->load->model('M_Secinfor');
            $id = $this->M_Secinfor->m_alterar_dados_falha($dados, $falha_id);
            if ($id) {
                $this->session->unset_userdata('falha_id');
                $this->session->unset_userdata('falha');
                redirect(base_url('Secinfor-Falhas-Consultas'));
            }
        } else {
            $this->session->set_flashdata('falha', $this->input->post('falha'));
            $this->session->set_flashdata('falha_id', $this->input->post('falha_id'));
            $this->falha_editar();
        }
    }

    public function base_conhecimento() {
        if ($this->session->userdata('status') == "On-line") {
            // Page
            $dados['nome_view'] = 'v_Secinfor_Base_Conhecimento';
            $this->load->model('M_Secinfor');
            $dados['falha'] = $this->M_Secinfor->m_listar_falha();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function cadastrar_base_conhecimento() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('palavras_chave', 'Palavras-Chave', 'required');
        $this->form_validation->set_rules('falha', 'Falha', 'required');
        $this->form_validation->set_rules('causa', 'Causa', 'required');
        $this->form_validation->set_rules('solucao', 'Solução', 'required');
        $this->form_validation->set_rules('observacoes', 'Observações', 'required');

        if ($this->form_validation->run()) {
            $falha_id = $this->input->post('falha');
            $palavras_chave = $this->input->post('palavras_chave');
            $causa = $this->input->post('causa');
            $solucao = $this->input->post('solucao');
            $observacoes = $this->input->post('observacoes');

            $dados = [
                "base_conhecimento_falha_id" => $falha_id,
                "base_conhecimento_causa" => $causa,
                "base_conhecimento_solucao" => $solucao,
                "base_conhecimento_palavras_chave" => $palavras_chave,
                "base_conhecimento_observacoes" => $observacoes,
            ];

            $this->load->model('M_Secinfor');
            $id = $this->M_Secinfor->m_cadastrar_base_conhecimento($dados);

            if ($id) {
                $this->session->unset_userdata('palavras_chave');
                $this->session->unset_userdata('falha');
                $this->session->unset_userdata('causa');
                $this->session->unset_userdata('solucao');
                $this->session->unset_userdata('observacoes');
                $this->base_conhecimento();
            }
        } else {
            $this->session->set_flashdata('palavras_chave', $this->input->post('palavras_chave'));
            $this->session->set_flashdata('falha', $this->input->post('falha'));
            $this->session->set_flashdata('causa', $this->input->post('causa'));
            $this->session->set_flashdata('solucao', $this->input->post('solucao'));
            $this->session->set_flashdata('observacoes', $this->input->post('observacoes'));
            $this->base_conhecimento();
        }
    }

    public function base_conhecimento_consultas() {
        if ($this->session->userdata('status') == "On-line") {
// Page
            $dados['nome_view'] = 'v_Secinfor_Base_Conhecimento_Consultar';
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function listar_base_conhecimento() {
        $this->load->model('M_Secinfor');
        $consulta = $this->M_Secinfor->m_listar_base_conhecimento();
        $row = "";
        if ($consulta == false) {
            $row .= "<p><div class='text text-warning' role='alert'>Nenhuma resultado para esta consulta!</div></p>";
        } else {
            foreach ($consulta->result() as $linha) {
                $row .= "<p>";
                $row .= "<spam class='text-uppercase'><a href='" . base_url('Secinfor-Base-Conhecimento-Visualizar') . "/" . $linha->base_conhecimento_id . "'>" . $linha->base_conhecimento_palavras_chave . "</a></spam><br>";
                if (strlen($linha->falha_descricao) > 60) {
                    $falha = substr($linha->falha_descricao, 0, 60) . "...";
                } else {
                    $falha = $linha->falha_descricao . "...";
                }
                $row .= "<spam class='text-muted'>" . $falha . "</spam> <a href='" . base_url('Secinfor-Base-Conhecimento-Editar') . "/" . $linha->base_conhecimento_id . "'> Editar</a> <a href='" . base_url('Secinfor-Base-Conhecimento-Visualizar') . "/" . $linha->base_conhecimento_id . "'>Visualizar</a><br>";
                if (strlen($linha->base_conhecimento_causa) > 60) {
                    $causa = substr($linha->base_conhecimento_causa, 0, 60) . "...";
                } else {
                    $causa = $linha->base_conhecimento_causa . "...";
                }
                $row .= "<spam class='text-muted'>" . $causa . "</spam> ";
                $row .= "</p>";
            }
        }
        echo $row;
    }

    function base_conhecimento_visualizar() {
        if ($this->session->userdata('status') == "On-line") {
// Page
            $this->load->model('M_Secinfor');
            $dados['nome_view'] = 'v_Secinfor_Base_Conhecimento_Visualizar';
            if ($this->uri->segment(2) == FALSE) {
                $base_conhecimento_id = $this->session->flashdata('base_conhecimento_id');
            } else {
                $base_conhecimento_id = $this->uri->segment(2);
            }
            $dados['base_conhecimento'] = $this->M_Secinfor->m_listar_base_conhecimento_by_id($base_conhecimento_id);
            $dados['falha'] = $this->M_Secinfor->m_listar_falha();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function base_conhecimento_editar() {
        if ($this->session->userdata('status') == "On-line") {
//Page
            $dados['nome_view'] = 'v_Secinfor_Base_Conhecimento_Editar';
            if ($this->uri->segment(2) == FALSE) {
                $base_conhecimento_id = $this->session->flashdata('base_conhecimento_id');
            } else {
                $base_conhecimento_id = $this->uri->segment(2);
            }
            $this->load->model('M_Secinfor');
            $dados['base_conhecimento'] = $this->M_Secinfor->m_listar_base_conhecimento_by_id($base_conhecimento_id);
            $dados['falha'] = $this->M_Secinfor->m_listar_falha();
            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

    function alterar_dados_base_conhecimento() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('palavras_chave', 'Palavras-Chave', 'required');
        $this->form_validation->set_rules('falha', 'Falha', 'required');
        $this->form_validation->set_rules('causa', 'Causa', 'required');
        $this->form_validation->set_rules('solucao', 'Solução', 'required');
        $this->form_validation->set_rules('observacoes', 'Observações', 'required');

        if ($this->form_validation->run()) {
            $base_conhecimento_id = $this->input->post('base_conhecimento_id');
            $palavras_chave = $this->input->post('palavras_chave');
            $falha = $this->input->post('falha');
            $causa = $this->input->post('causa');
            $solucao = $this->input->post('solucao');
            $observacoes = $this->input->post('observacoes');
            $dados = [
                "base_conhecimento_palavras_chave" => $palavras_chave,
                "base_conhecimento_falha_id" => $falha,
                "base_conhecimento_causa" => $causa,
                "base_conhecimento_solucao" => $solucao,
                "base_conhecimento_observacoes" => $observacoes,
            ];
            $this->load->model('M_Secinfor');
            $id = $this->M_Secinfor->m_alterar_dados_base_conhecimento($dados, $base_conhecimento_id);

            if ($id) {
                $this->session->unset_userdata('palavras_chave');
                $this->session->unset_userdata('falha');
                $this->session->unset_userdata('causa');
                $this->session->unset_userdata('solucao');
                $this->session->unset_userdata('observacoes');

                $this->base_conhecimento_consultas();
            }
        } else {
            $this->session->set_flashdata('palavras_chave', $this->input->post('palavras_chave'));
            $this->session->set_flashdata('falha', $this->input->post('falha'));
            $this->session->set_flashdata('causa', $this->input->post('causa'));
            $this->session->set_flashdata('solucao', $this->input->post('solucao'));
            $this->session->set_flashdata('observacoes', $this->input->post('observacoes'));
            $this->session->set_flashdata('base_conhecimento_id', $this->input->post('base_conhecimento_id'));
            $this->base_conhecimento_editar();
        }
    }

    public function contador() {
        $rem = strtotime('2023-02-26 12:00:00') - time();
        $year = floor($rem / 31536000);
        $month = floor(($rem % 31536000) / 2592000);

        $day = floor((($rem - 31536000) - (2592000 * $month)) / 86400);
        $hr = floor(($rem % 86400) / 3600);
        $min = floor(($rem % 3600) / 60);
        $sec = ($rem % 60);

        if ($year)
            echo "<h1 style='text-align: center;color: red;'>" . $year . "Ano ";
        if ($month)
            echo $month . "meses ";
        if ($day)
            echo $day . "Dias ";

        if ($hr)
            echo $hr . "Horas ";
        if ($min)
            echo $min . "Minutos ";
        if ($sec)
            echo $sec . "Segundos ";

        echo "Restantes...</h1>";
    }

    function tickets() {
        if ($this->session->userdata('status') == "On-line") {
            $dados['nome_view'] = 'v_Secinfor_Ticket';
            $this->load->model('M_Secinfor');
            $dados['so'] = $this->M_Secinfor->m_estatistica_so();

            $this->load->view('template', $dados);
        } else {
            redirect(base_url('Acesso'));
        }
    }

}
