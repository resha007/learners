<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class VehicleType extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('VehicleTypeModel');
	}

	public function index()
	{	
		$this->load->view('VehicleType');
	}

	function get(){ 
		$data = $this->VehicleTypeModel->list();
		echo json_encode($data);
	}

	function save(){
        $data=$this->VehicleTypeModel->save();
        echo json_encode($data);
    }

	function update(){
        $data=$this->VehicleTypeModel->update();
        echo json_encode($data);
    }

	function delete(){
        $data=$this->VehicleTypeModel->delete();
        echo json_encode($data);
    }

	function checkName(){
        $data=$this->VehicleTypeModel->checkName();
        echo json_encode($data);
    }

	function getActive(){
        $data=$this->VehicleTypeModel->getActive();
        echo json_encode($data);
    }
}
