<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Location extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('LocationModel');
	}

	public function index()
	{	
		$this->load->view('location');
	}

	function get(){ 
		$data = $this->LocationModel->list();
		echo json_encode($data);
	}

	function save(){
        $data=$this->LocationModel->save();
        echo json_encode($data);
    }

	function update(){
        $data=$this->LocationModel->update();
        echo json_encode($data);
    }

	function delete(){
        $data=$this->LocationModel->delete();
        echo json_encode($data);
    }
}
