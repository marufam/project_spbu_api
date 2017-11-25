<?php

require APPPATH . '/libraries/REST_Controller.php';

class Rating_api extends REST_Controller {

  function __construct($config = 'rest') {
    parent::__construct($config);
  }

  // show data
  function index_get() {
    $id = $this->get('id');

    if ($id == '') {
      $data=$this->db->get("tbl_rating")->result();

    } else {
      $this->db->where('id', $id);
      $data=$this->db->get("tbl_rating")->result();

    }
    $data = array(
      "status"=>"success",
      "rating"=> $data);
      $this->response($data, 200);
    }

    // insert new data to
    function index_post() {
      if($this->input->post('action')=="POST"){
        $data = array(
          'id' => "",
          'id_spbu' => $this->input->post('id_spbu'),
          'id_user' => $this->input->post('id_user'),
          'rate' => $this->input->post('rate')
        );
        $insert = $this->db->insert('tbl_rating', $data);
        if ($insert) {
          $this->response(array("tbl_rating"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("tbl_rating"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="PUT"){
        $id = $this->input->post('id');
        $data = array(
          'id_spbu' => $this->input->post('id_spbu'),
          'id_user' => $this->input->post('id_user'),
          'rate' => $this->input->post('rate')
        );

        $this->db->where('id', $id);
        $update = $this->db->update('tbl_rating', $data);
        if ($update) {
          $this->response(array("spbu"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("spbu"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="DELETE"){
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('tbl_rating');
        if ($delete) {
          $this->response(array('status' => 'success'), 200);
        } else {
          $this->response(array('status' => 'failed', 502));
        }
      }
    }

  }
