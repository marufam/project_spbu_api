<?php

require APPPATH . '/libraries/REST_Controller.php';

class Spbu_api extends REST_Controller {

  function __construct($config = 'rest') {
    parent::__construct($config);
  }

  // show data
  function index_get() {
    $id = $this->get('id');

    if ($id == '') {
      $data=$this->db->get("tbl_spbu")->result();

    } else {
      $this->db->where('id_spbu', $id);
      $data=$this->db->get("tbl_spbu")->result();

    }
    $data = array(
      "status"=>"success",
      "spbu"=> $data);
      $this->response($data, 200);
    }

    // insert new data to
    function index_post() {
      if($this->input->post('action')=="POST"){
        $data = array(
          'id_spbu' => "",
          'nama' => $this->input->post('nama'),
          'lnglat' => $this->input->post('lnglat'),
          'alamat' => $this->input->post('alamat'),
          'buka' => $this->input->post('buka'),
          'time' => $this->input->post('time')
        );
        $insert = $this->db->insert('tbl_spbu', $data);
        if ($insert) {
          $this->response(array("tbl_spbu"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("tbl_spbu"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="PUT"){
        $id_spbu = $this->input->post('id_spbu');
        $data = array(
          'nama' => $this->input->post('nama'),
          'lnglat' => $this->input->post('lnglat'),
          'alamat' => $this->input->post('alamat'),
          'buka' => $this->input->post('buka'),
          'time' => $this->input->post('time')
        );

        $this->db->where('id_spbu', $id_spbu);
        $update = $this->db->update('tbl_spbu', $data);
        if ($update) {
          $this->response(array("spbu"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("spbu"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="DELETE"){
        $id_spbu = $this->input->post('id_spbu');
        $this->db->where('id_spbu', $id_spbu);
        $delete = $this->db->delete('tbl_spbu');
        if ($delete) {
          $this->response(array('status' => 'success'), 200);
        } else {
          $this->response(array('status' => 'failed', 502));
        }
      }
    }

  }
