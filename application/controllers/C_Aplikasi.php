<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_Aplikasi extends CI_Controller
{
    var $firebase;

    public function __construct()
    {
        parent::__construct();
        $this->firebase  = $this->firebase->init();

        $cek_session = $this->session->userdata('log_in');
        if (empty($cek_session)) {
            redirect('C_Login', 'refresh');
        }
    }

    public function index()
    {
        $db  = $this->firebase->getDatabase();

        $ref = "VersiAplikasi";
        $data['versi_aplikasi'] = $db->getReference($ref)->getValue();
        $this->load->view('versi_aplikasi/view_versi_aplikasi', $data);
    }

    public function add_data()
    {
        $db  = $this->firebase->getDatabase();
        $aplikasi = $this->input->post('aplikasi');
        $versi = $this->input->post('versi');
        $tanggal = date("Y-m-d H:i:s");

        $data = [
            'aplikasi' => $aplikasi,
            'versi' => $versi,
            'created_at' => $tanggal
        ];

        $ref = "VersiAplikasi";
        $db->getReference($ref)->push($data);
        redirect('C_Aplikasi', 'redirect');
    }
}
        
    /* End of file  C_Aplikasi.php */
