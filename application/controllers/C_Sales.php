<?php

defined('BASEPATH') or exit('No direct script access allowed');

class C_Sales extends CI_Controller
{

    public function index()
    {
        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();

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
        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();

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


        $foto = $this->input->post('foto_sales');

        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();
        $auth = $firebase->getAuth();
        $storage = $firebase->getStorage();
        $bucket = $storage->getBucket();
        $new_name = time() . $_FILES["foto_sales"]['name'];
        $bucket->upload(
            file_get_contents($_FILES['foto_sales']['tmp_name']),
            [
                'name' => 'img_sales/' . $new_name
            ]
        );


        $url = "https://firebasestorage.googleapis.com/v0/b/ikijekpandaan-3bb02.appspot.com/o/";

        $nama_foto = $url . 'img_sales%2f' . $new_name . "?alt=media&token=";

        $ref = "Pandaan/Akun_Sales";
        $key = $db->getReference($ref)->push()->getKey();

        $data = [
            'kode_sales' => $key,
            'nama' => $nama,
            'nik' => $nik,
            'jenis_kelamin' => $jk,
            'email' => $email,
            'foto' => $nama_foto,
            'area' => $area,
            'notlpn' => $nohp
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

        $idUser = $this->input->post('id');

        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();
        $data = [
            'nama' => $nama,
            'nik' => $nik,
            'jenis_kelamin' => $jk,
            'email' => $email,
            'area' => $area,
            'notlpn' => $nohp
        ];
        $ref = "Pandaan/Akun_Sales/" . $idUser;
        $updateData = $db->getReference($ref)->update($data);
        redirect('C_Sales', 'refresh');
    }

    public function delete_data($id)
    {
        $firebase = $this->firebase->init();
        $db  = $firebase->getDatabase();

        $ref = "Pandaan/Akun_Sales/" . $id;
        $deleteData = $db->getReference($ref)->remove();

        redirect('C_Sales', 'refresh');
    }
}
        
    /* End of file  C_Sales.php */
