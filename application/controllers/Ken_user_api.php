<?php

require APPPATH . '/libraries/REST_Controller.php';

class Ken_user_api extends REST_Controller {

  function __construct($config = 'rest') {
    parent::__construct($config);
  }

  // show data
  function index_get() {
    $id = $this->get('id');
    if ($id == '') {
      $this->db->join('tbl_user', 'tbl_user.id_user = tbl_ken_user.id_user', 'left');
      $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_ken_user.id_kendaraan', 'left');
      $data=$this->db->get("tbl_ken_user")->result();
    } else {
      $this->db->join('tbl_user', 'tbl_user.id_user = tbl_ken_user.id_user', 'left');
      $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_ken_user.id_kendaraan', 'left');
      $this->db->where('id', $id);
      $data=$this->db->get("tbl_ken_user")->result();
    }
    $data = array(
      "status"=>"success",
      "ken_user"=> $data);
      $this->response($data, 200);
    }

    // insert new data to
    function index_post() {
      if($this->input->post('action')=="POST"){
        $data = array(
          'id' => '',
          'id_user' => $this->input->post('id_user'),
          'id_kendaraan' => $this->input->post('id_kendaraan')
        );
        $insert = $this->db->insert('tbl_ken_user', $data);
        if ($insert) {
          $this->response(array("ken_user"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("ken_user"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="PUT"){
        $id = $this->input->post('id');
        $data = array(
          'id_user' => $this->input->post('id_user'),
          'id_kendaraan' => $this->input->post('id_kendaraan')
        );
        $this->db->where('id', $id);
        $update = $this->db->update('tbl_ken_user', $data);
        if ($update) {
          $this->response(array("ken_user"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("ken_user"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="DELETE"){
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('tbl_ken_user');
        if ($delete) {
          $this->response(array('status' => 'success'), 200);
        } else {
          $this->response(array('status' => 'failed', 502));
        }
      }
    }

  }
