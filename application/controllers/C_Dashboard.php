<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_Dashboard extends CI_Controller
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

        $firebase = $this->firebase;
        $db  = $firebase->getDatabase();

        $ref = "Pandaan/Akun_Driver";
        $data['jumlah_ojek'] = $db->getReference($ref)->getSnapshot()->numChildren();

        $ref = "Pandaan/Akun_Mobil";
        $data['jumlah_taksi'] = $db->getReference($ref)->getSnapshot()->numChildren();

        $ref = "Pandaan/Akun_Resto";
        $data['jumlah_warung'] = $db->getReference($ref)->getSnapshot()->numChildren();

        $ref = "Pandaan/Akun_Sales";
        $data['jumlah_sales'] = $db->getReference($ref)->getSnapshot()->numChildren();

        $this->load->view('home', $data);
    }
}
        
    /* End of file  C_Dashboard.php */
