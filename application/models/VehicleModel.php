<?php

class VehicleModel extends CI_Model{
	function list(){
		//$hasil=$this->db->
		$this->db->where('status =', 'A');
		$this->db->or_where('status =', 'I');
		$hasil=$this->db->get('vehicle');
		return $hasil->result();
	}
	function save(){
		$data = array(				
				'name' 			=> $this->input->post('name'), 
				'description'	=> $this->input->post('description'), 
				'number_plate'	=> $this->input->post('numberPlate'), 
				'vehicle_type_id'	=> $this->input->post('vehicleType'), 
				'status' 		=> $this->input->post('status'),
			);
		$result=$this->db->insert('vehicle',$data);
		return $result;
	}
	function update(){
		$this->db->set('name', $this->input->post('name'));
		$this->db->set('description', $this->input->post('description'));
		$this->db->set('status', $this->input->post('status'));
		$this->db->where('id', $this->input->post('txtId'));
		$result=$this->db->update('vehicle');
		return $result;	
	}

	function delete(){
		$id=$this->input->post('txtId');
		$this->db->set('status', 'D');
		$this->db->where('id', $id);
		$result=$this->db->update('vehicle');
		return $result;
	}	

	function checkName(){
		$this->db->select('name');
		$this->db->where('status =', 'A');
		$this->db->or_where('status =', 'I');
		$hasil=$this->db->get('vehicle');
		return $hasil->result();
	}
}

?>