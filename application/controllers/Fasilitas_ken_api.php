<?php

require APPPATH . '/libraries/REST_Controller.php';

class Fasilitas_ken_api extends REST_Controller {

  function __construct($config = 'rest') {
    parent::__construct($config);
  }

  // show data
  function index_get() {
    $id = $this->get('id');
    if ($id == '') {
      $this->db->join('tbl_fasilitas', 'tbl_fasilitas.id_fasilitas = tbl_fasilitas_ken.id_fasilitas', 'left');

	$this->db->select('tbl_fasilitas.*, tbl_fasilitas_ken.*, tbl_fasilitas.nama as nama_fasilitas');
      $data=$this->db->get("tbl_fasilitas_ken")->result();
    } else {
      $this->db->join('tbl_fasilitas', 'tbl_fasilitas.id_fasilitas = tbl_fasilitas_ken.id_fasilitas', 'left');

$this->db->select('tbl_fasilitas.nama, tbl_fasilitas.*,tbl_fasilitas_ken.*, tbl_fasilitas.nama as nama_fasilitas');
      // $this->db->distinct('tbl_fasilitas_ken.id_fasilitas');
      $this->db->where('tbl_fasilitas_ken.id_spbu', $id);
      $data=$this->db->get("tbl_fasilitas_ken")->result();
    }
    $data = array(
      "status"=>"success",
      "fasilitas_ken"=> $data);
      $this->response($data, 200);
    }

    // insert new data to
    function index_post() {
      if($this->input->post('action')=="POST"){
        $data = array(
          'id_fasilitas' => $this->input->post('id_fasilitas'),
          'id_spbu' => $this->input->post('id_spbu'),
	  'id_user' => $this->input->post('id_user')
        );
        $insert = $this->db->insert('tbl_fasilitas_ken', $data);
        if ($insert) {
          $this->response(array("fasilitas_ken"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("fasilitas_ken"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="PUT"){
        $id_fasilitas = $this->input->post('id_fasilitas');
        $data = array(
          'id_fasilitas' => $this->input->post('id_fasilitas'),
          'id_spbu' => $this->input->post('id_spbu')
        );

        $this->db->where($data);
        $update = $this->db->update('tbl_fasilitas_ken', $data);
        if ($update) {
          $this->response(array("fasilitas_ken"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("fasilitas_ken"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="DELETE"){
        $data = array(
          'id_fasilitas' => $this->input->post('id_fasilitas'),
          'id_spbu' => $this->input->post('id_spbu')
        );

        $this->db->where($data);
	$delete = $this->db->delete('tbl_fasilitas_ken');
        if ($delete) {
          $this->response(array('status' => 'success'), 200);
        } else {
          $this->response(array('status' => 'failed', 502));
        }
      }
    }

  }
