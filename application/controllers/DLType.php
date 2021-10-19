<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class DLType extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('DLTypeModel1');
	}

	public function index()
	{	
		$this->load->view('dlType');
	}

	function get(){ 
		$data = $this->DLTypeModel->list();
		echo json_encode($data);
	}

	function save(){
        $data=$this->DLTypeModel->save();
        echo json_encode($data);
    }

	function update(){
        $data=$this->DLTypeModel->update();
        echo json_encode($data);
    }

	function delete(){
        $data=$this->DLTypeModel->delete();
        echo json_encode($data);
    }

	function checkName(){
        $data=$this->DLTypeModel->checkName();
        echo json_encode($data);
    }
}
