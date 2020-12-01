<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_Customer extends CI_Controller
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

        $ref = "Pandaan/Costumers";
        $data['data_customer'] = $db->getReference($ref)->getValue();
        $this->load->view('customer/view_data_customer', $data);
    }

    public function delete_data($id)
    {
        $db  = $this->firebase->getDatabase();
        $auth = $this->firebase->getAuth();

        $ref = "Pandaan/Costumers/" . $id;

        try {
            $auth->deleteUser($id);
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
        }

        $db->getReference($ref)->remove();
        redirect('C_Customer', 'refresh');
    }
}
        
    /* End of file  C_Customer.php */
