<?php

require APPPATH . '/libraries/REST_Controller.php';

class User_api extends REST_Controller {

  function __construct($config = 'rest') {
    parent::__construct($config);
  }

  // show data
  function index_get() {
    $id = $this->get('id');
    if ($id == '') {
      $data=$this->db->get("tbl_user")->result();
    } else {
      $this->db->where('id_user', $id);
      $data=$this->db->get("tbl_user")->result();
    }
    $data = array(
      "status"=>"success",
      "user"=> $data);
      $this->response($data, 200);
    }

    // insert new data to
    function index_post() {
      if($this->input->post('action')=="POST"){
        $data = array(
          'id_user' => '',
          'nama' => $this->input->post('nama'),
          'alamat' => $this->input->post('alamat'),
          'telp' => $this->input->post('telp'),
          'email' => $this->input->post('email'),
          'username' => $this->input->post('username'),
          'password' => $this->input->post('password')
        );
        $insert = $this->db->insert('tbl_user', $data);
        if ($insert) {
          $this->response(array("user"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("user"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="PUT"){
        $id_user = $this->input->post('id_user');
        $data = array(
          'nama' => $this->input->post('nama'),
          'alamat' => $this->input->post('alamat'),
          'telp' => $this->input->post('telp'),
          'email' => $this->input->post('email'),
          'username' => $this->input->post('username'),
          'password' => $this->input->post('password')
        );

        $this->db->where('id_user', $id_user);
        $update = $this->db->update('tbl_user', $data);
        if ($update) {
          $this->response(array("user"=>array($data), "status"=>"success", 200));
        } else {
          $this->response(array("user"=>array($data),'status' => 'failed', 502));
        }

      }elseif($this->input->post('action')=="DELETE"){
        $id_user = $this->input->post('id_user');
        $this->db->where('id_user', $id_user);
        $delete = $this->db->delete('tbl_user');
        if ($delete) {
          $this->response(array('status' => 'success'), 200);
        } else {
          $this->response(array('status' => 'failed', 502));
        }
      }
    }

  }
