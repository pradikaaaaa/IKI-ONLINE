<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_Profile extends CI_Controller
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
        $this->load->view('profile/view_profile');
    }

    public function detail_profile($id)
    {
        $db  = $this->firebase->getDatabase();

        $ref = "Pandaan/Akun_Karyawan";
        $data['id'] = $id;
        $data['profile'] = $db->getReference($ref)->getChild($id)->getValue();
        $this->load->view('profile/view_profile', $data);
    }
}
        
    /* End of file  C_Profile.php */
