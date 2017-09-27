<?php

require APPPATH . '/libraries/REST_Controller.php';

class Jadwal_api extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model("API_Jadwal_model");
    }

    // show data 
    function index_get() {
        // $id = $this->get('id');
        $id_karyawan = $this->get('id_karyawan');
       

        if ($id_karyawan == '') {
            $this->db->join('karyawan', 'karyawan.id_karyawan = jadwal.id_karyawan', 'left');
            $this->db->join('lokasi', 'lokasi.id_lokasi = jadwal.id_lokasi', 'left');
            $this->db->join('laporan', 'laporan.id_jadwal_laporan = jadwal.id_jadwal', 'left');
             $this->db->where('jadwal.tanggal', date("Y-m-d"));
            $jadwal=$this->db->get("jadwal");
            $count=$jadwal->num_rows();
            $jadwal=$jadwal->result();
        } else {
           
            $this->db->join('karyawan', 'karyawan.id_karyawan = jadwal.id_karyawan', 'left');
            $this->db->join('lokasi', 'lokasi.id_lokasi = jadwal.id_lokasi', 'left');
            $this->db->join('laporan', 'laporan.id_jadwal_laporan = jadwal.id_jadwal', 'left');
            // $this->db->where('id_jadwal', $id);
            $this->db->where('jadwal.tanggal', date("Y-m-d"));
            $this->db->where('jadwal.id_karyawan', $id_karyawan);
            $jadwal=$this->db->get("jadwal");
            $count=$jadwal->num_rows();
            $jadwal=$jadwal->result();
        }
        $data = array(
            "status"=>"success",
            "jumlah"=>$count,
            "jadwal"=>$jadwal );
        
        $this->response($data, 200);
    }

    // insert new data to 
    function index_post() {
        $data = array(
            'id_jadwal_laporan' => "",
            'tanggal' => $this->input->post('tanggal'),
            'id_karyawan' => $this->input->post('id_karyawan'),
            'id_lokasi' => $this->input->post('id_lokasi')
            );
        $insert = $this->db->insert('jadwal', $data);
        if ($insert) {
            $this->response(array("jadwal"=>array($data), "status"=>"success", 200));
        } else {
            $this->response(array("jadwal"=>array($data),'status' => 'failed', 502));
        }
    }

    // update data 
    function index_put() {
        $id_jadwal_laporan = $this->put('id_jadwal_laporan');
        $data = array(
            'id_jadwal_laporan' => $this->put('id_jadwal_laporan'),
            'tanggal' => $this->put('tanggal'),
            'id_karyawan' => $this->put('id_karyawan'),
            'id_lokasi' => $this->put('id_lokasi'));
        $this->db->where('id_jadwal_laporan', $id_jadwal_laporan);
        $update = $this->db->update('jadwal', $data);
        if ($update) {
            $this->response(array("jadwal"=>array($data), "status"=>"success", 200));
        } else {
            $this->response(array("jadwal"=>array($data), "status"=>"failed", 502));
        }
    }

    // delete 
    function index_delete() {
        $id_jadwal_laporan = $this->delete('id_jadwal_laporan');
        $this->db->where('id_jadwal_laporan', $id_jadwal_laporan);
        $delete = $this->db->delete('jadwal');
        if ($delete) {
            $this->response(array('status' => 'success'), 200);
        } else {
            $this->response(array('status' => 'failed', 502));
        }
    }
}
