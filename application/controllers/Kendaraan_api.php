<?php

require APPPATH . '/libraries/REST_Controller.php';

class Kendaraan_api extends REST_Controller {

  function __construct($config = 'rest') {
    parent::__construct($config);
  }

  // show data
  function index_get() {
    $id = $this->get('id');
    if ($id == '') {
      $data=$this->db->get("tbl_kendaraan")->result();
    } else {
      $this->db->where('id_kendaraan', $id);
      $data=$this->db->get("tbl_kendaraan")->result();
    }
    $data = array(
      "status"=>"success",
      "kendaraan"=> $data);
      $this->response($data, 200);
    }

    // insert new data to
    function index_post() {
      if($this->input->post('action')=="POST"){
        $data = array(
          'id_kendaraan' => '',
          'nama_kedaraan' => $this->input->post('nama_kedaraan'),
          'jarak_liter' => $this->input->post('jarak_liter'),
          'merek' => $this->input->post('merek')
        );
        $insert = $this->db->insert('tbl_kendaraan', $data);
        if ($insert) {
          $this->response(array("kendaraan"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("kendaraan"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="PUT"){
        $id_kendaraan = $this->input->post('id_kendaraan');
        $data = array(
          'nama_kedaraan' => $this->input->post('nama_kedaraan'),
          'jarak_liter' => $this->input->post('jarak_liter'),
          'merek' => $this->input->post('merek')
        );
        $this->db->where('id_kendaraan', $id_kendaraan);
        $update = $this->db->update('tbl_kendaraan', $data);
        if ($update) {
          $this->response(array("kendaraan"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("kendaraan"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="DELETE"){
        $id_kendaraan = $this->input->post('id_kendaraan');
        $this->db->where('id_kendaraan', $id_kendaraan);
        $delete = $this->db->delete('tbl_kendaraan');
        if ($delete) {
          $this->response(array('status' => 'success'), 200);
        } else {
          $this->response(array('status' => 'failed', 502));
        }
      }
    }

  }
