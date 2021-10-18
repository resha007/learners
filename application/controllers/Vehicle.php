<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Vehicle extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('VehicleModel');
	}

	public function index()
	{	
		$this->load->view('Vehicle');
	}

	function get(){ 
		$data = $this->VehicleModel->list();
		echo json_encode($data);
	}

	function save(){
        $data=$this->VehicleModel->save();
        echo json_encode($data);
    }

	function update(){
        $data=$this->VehicleModel->update();
        echo json_encode($data);
    }

	function delete(){
        $data=$this->VehicleModel->delete();
        echo json_encode($data);
    }

	function checkName(){
        $data=$this->VehicleModel->checkName();
        echo json_encode($data);
    }

	function checkNumPlate(){
        $data=$this->VehicleModel->checkNumPlate();
        echo json_encode($data);
    }
}
