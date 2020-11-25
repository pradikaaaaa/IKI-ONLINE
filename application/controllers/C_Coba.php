<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_Coba extends CI_Controller
{

    public function index()
    {
        $this->load->library('mailer');

        $email_penerima = 'yahyapradika87@gmail.com';
        $subjek = 'Percobaan';
        $pesan = 'Tes';
        $content = $this->load->view('content/body-email', '', true);


        $sendmail = array(
            'email_penerima' => $email_penerima,
            'subjek' => $subjek,
            'content' => $content
        );

        $send = $this->mailer->send($sendmail);

        var_dump($send);
    }
}
        
    /* End of file  C_Coba.php */
