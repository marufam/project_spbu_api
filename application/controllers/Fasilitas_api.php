<?php

require APPPATH . '/libraries/REST_Controller.php';

class Fasilitas_api extends REST_Controller {

  function __construct($config = 'rest') {
    parent::__construct($config);
  }

  // show data
  function index_get() {
    $id = $this->get('id');

    if ($id == '') {
      $data=$this->db->get("tbl_fasilitas")->result();
    } else {
      $this->db->where('id_fasilitas', $id);
      $data=$this->db->get("tbl_fasilitas")->result();
    }
    $data = array(
      "status"=>"success",
      "fasilitas"=> $data);
      $this->response($data, 200);
    }

    // insert new data to
    function index_post() {
      if($this->input->post('action')=="POST"){
        $data = array(
          'id_fasilitas' => "",
          'nama' => $this->input->post('nama')
        );
        $insert = $this->db->insert('tbl_fasilitas', $data);
        if ($insert) {
          $this->response(array("tbl_fasilitas"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("tbl_fasilitas"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="PUT"){
        $id_fasilitas = $this->input->post('id_fasilitas');
        $data = array(
    
          'nama' => $this->input->input->post('nama')
        );

        $this->db->where('id_fasilitas', $id_fasilitas);
        $update = $this->db->update('tbl_fasilitas', $data);
        if ($update) {
          $this->response(array("fasilitas"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("fasilitas"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="DELETE"){
        $id_fasilitas = $this->input->post('id_fasilitas');
        $this->db->where('id_fasilitas', $id_fasilitas);
        $delete = $this->db->delete('tbl_fasilitas');
        if ($delete) {
          $this->response(array('status' => 'success'), 200);
        } else {
          $this->response(array('status' => 'failed', 502));
        }
      }
    }

  }
