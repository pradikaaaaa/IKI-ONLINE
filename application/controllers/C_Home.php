<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_Home extends CI_Controller
{

    public function index()
    {
        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();

        $ref = "Pandaan/Akun_Driver";
        $data['jumlah_ojek'] = $db->getReference($ref)->getSnapshot()->numChildren();

        $ref = "Pandaan/Akun_Mobil";
        $data['jumlah_taksi'] = $db->getReference($ref)->getSnapshot()->numChildren();

        $ref = "Pandaan/Akun_Resto";
        $data['jumlah_warung'] = $db->getReference($ref)->getSnapshot()->numChildren();
        $this->load->view('index', $data);
    }

    public function contact()
    {
        $this->load->library('email');

        // ini_set('SMTP', 'smtp.gmail.com');
        // ini_set('smtp_port', 465);

        // $name = $this->input->post('name');
        // $email = $this->input->post('email');
        // $subjek = $this->input->post('subject');
        // $pesan = $this->input->post('message');

        // $this->email->from($email, $name);
        // $this->email->to('yahyapradika87@gmail.com');
        // // $this->email->cc('another@another-example.com');
        // // $this->email->bcc('them@their-example.com');

        // $this->email->subject($subjek);
        // $this->email->message($pesan);

        // $this->email->send();

        // echo $this->email->print_debugger();
    }
}
        
    /* End of file  C_Home.php */
