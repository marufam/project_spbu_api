<?php

require APPPATH . '/libraries/REST_Controller.php';

class Admin_api extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model("API_Admin_model");
    }

    // show data 
    function index_get() {
        $id = $this->get('id');

        if ($id == '') {
            // $this->db->join('prodi', 'mahasiswa.id_prodi = prodi.id', 'left');
            // $this->db->join('project', 'project.id_customer = customer.no_customer', 'left');
            // $data = $this->db->get('customer')->result();
            // $data = array("status"=>"0");
            $admin=$this->db->get("admin")->result();

        } else {
            // $this->db->join('prodi', 'mahasiswa.id_prodi = prodi.id', 'left');
            // $this->db->join('jurusan', 'jurusan.id = prodi.id_jurusan', 'left');
            // $this->db->join('project', 'project.id_customer = customer.no_customer', 'left');
            $this->db->where('id_admin', $id);
            $admin=$this->db->get("admin")->result();
            
        }
        $data = array(
            "status"=>"success",
            "jumlah"=>$this->API_Admin_model->total_rows(),
            "admin"=> $admin);
        
        $this->response($data, 200);
    }

    // insert new data to 
    function index_post() {
        $data = array(
            'id_admin' => "",
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'foto' => $this->input->post('foto')
            );
        $insert = $this->db->insert('admin', $data);
        if ($insert) {
            $this->response(array("admin"=>array($data), "status"=>"success", 200));
        } else {
            $this->response(array("admin"=>array($data),'status' => 'failed', 502));
        }
    }

    // update data 
    function index_put() {
        $id_admin = $this->put('id_admin');
        $data = array(
            'id_admin' => $this->put('id_admin'),
            'username' => $this->put('username'),
            'password' => $this->put('password'),
            'foto' => $this->put('foto'));
        $this->db->where('id_admin', $id_admin);
        $update = $this->db->update('admin', $data);
        if ($update) {
            $this->response(array("admin"=>array($data), "status"=>"success", 200));
        } else {
            $this->response(array("admin"=>array($data),'status' => 'failed', 502));
        }
    }

    // delete 
    function index_delete() {
        $id_admin = $this->delete('id_admin');
        $this->db->where('id_admin', $id_admin);
        $delete = $this->db->delete('admin');
        if ($delete) {
            $this->response(array('status' => 'success'), 200);
        } else {
            $this->response(array('status' => 'failed', 502));
        }
    }
}
