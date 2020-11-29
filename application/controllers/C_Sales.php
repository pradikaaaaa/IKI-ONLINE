<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_Sales extends CI_Controller
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

        $ref = "Pandaan/Akun_Sales";
        $data['data_sales'] = $db->getReference($ref)->getValue();
        $this->load->view('sales/view_data_sales', $data);
    }

    public function form_tambah()
    {
        $this->load->view('sales/add_data_sales');
    }

    public function form_edit($id)
    {
        $db  = $this->firebase->getDatabase();

        $ref = "Pandaan/Akun_Sales";
        $data['id'] = $id;
        $data['data_sales'] = $db->getReference($ref)->getChild($id)->getValue();
        $this->load->view('sales/edit_data_sales', $data);
    }

    public function add_data()
    {
        $nama = $this->input->post('nama');
        $nohp = $this->input->post('nohp');
        $nik = $this->input->post('nik');
        $jk = $this->input->post('jk');
        $email = $this->input->post('email');
        $area = $this->input->post('area');
        $alamat = $this->input->post('alamat_pribadi');


        $db  = $this->firebase->getDatabase();
        $storage = $this->firebase->getStorage();
        $bucket = $storage->getBucket();

        //rename foto
        $foto_sales = str_replace(" ", "-", $nama);
        $filename = $_FILES["foto_sales"]["name"];
        $tmp = explode('.', $filename);
        $ext = end($tmp);

        $ref = "Pandaan/Akun_Sales";
        $key = $db->getReference($ref)->push()->getKey();

        $new_name_sales = 'sales-' . $foto_sales . '.' . $ext;
        $bucket->upload(
            file_get_contents($_FILES['foto_sales']['tmp_name']),
            [
                'name' => 'Sales/' . $key . '/foto/' . $new_name_sales
            ]
        );

        $url = "https://firebasestorage.googleapis.com/v0/b/ikijekpandaan-3bb02.appspot.com/o/";
        $nama_foto = $url . 'Sales%2f' . $key . "%2ffoto%2f" . $new_name_sales . "?alt=media&token=";



        $data = [
            'kode_sales' => $key,
            'nama' => $nama,
            'nik' => $nik,
            'jenis_kelamin' => $jk,
            'email' => $email,
            'foto' => $nama_foto,
            'area' => $area,
            'notlpn' => $nohp,
            'alamat' => $alamat,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $db->getReference($ref . "/" . $key)->set($data);

        redirect('C_Sales', 'refresh');
    }


    public function edit_data()
    {
        $nama = $this->input->post('nama');
        $nohp = $this->input->post('nohp');
        $nik = $this->input->post('nik');
        $jk = $this->input->post('jk');
        $email = $this->input->post('email');
        $area = $this->input->post('area');
        $alamat = $this->input->post('alamat_pribadi');

        $idUser = $this->input->post('id');

        $db  = $this->firebase->getDatabase();
        $data = [
            'nama' => $nama,
            'nik' => $nik,
            'jenis_kelamin' => $jk,
            'email' => $email,
            'area' => $area,
            'notlpn' => $nohp,
            'alamat' => $alamat,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $ref = "Pandaan/Akun_Sales/" . $idUser;
        $db->getReference($ref)->update($data);
        redirect('C_Sales', 'refresh');
    }

    public function edit_foto_sales()
    {
        $nama = $this->input->post('nama');
        $key = $this->input->post('id');

        $db  = $this->firebase->getDatabase();
        $storage = $this->firebase->getStorage();
        $bucket = $storage->getBucket();

        //rename foto ktp
        $foto_sales = str_replace(" ", "-", $nama);
        $filename = $_FILES["foto_sales"]["name"];
        $tmp = explode('.', $filename);
        $ext = end($tmp);

        $new_name_sales = 'sales-' . $foto_sales . '.' . $ext;
        $bucket->upload(
            file_get_contents($_FILES['foto_sales']['tmp_name']),
            [
                'name' => 'Sales/' . $key . '/foto/' . $new_name_sales
            ]
        );

        $url = "https://firebasestorage.googleapis.com/v0/b/ikijekpandaan-3bb02.appspot.com/o/";
        $nama_foto = $url . 'Sales%2f' . $key . "%2ffoto%2f" . $new_name_sales . "?alt=media&token=";

        $data = [
            'foto' => $nama_foto,
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $ref = "Pandaan/Akun_Sales/" . $key;
        $db->getReference($ref)->update($data);
        redirect('C_Sales', 'refresh');
    }


    public function delete_data($id)
    {
        $db  = $this->firebase->getDatabase();

        $ref = "Pandaan/Akun_Sales/" . $id;
        $db->getReference($ref)->remove();

        redirect('C_Sales', 'refresh');
    }
}
        
    /* End of file  C_Sales.php */
