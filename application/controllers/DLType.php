<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class DLType extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('DLTypeModel');
	}

	public function index()
	{	
		//$this->load->helper('url');
		$this->load->view('dlType');
	}

	function crud(){
		echo $this->input->get('type');
		$data = $this->DLTypeModel->list();
		echo json_encode($data);
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

	public function test()
	{
		$this->load->view('new');
	}
}
