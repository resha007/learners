<?php

class DLTypeModel extends CI_Model{
	function list(){
		//$hasil=$this->db->
		$this->db->where('status =', 'A');
		$this->db->or_where('status =', 'I');
		$hasil=$this->db->get('dl_type');
		return $hasil->result();
	}
	function save(){
		$data = array(				
				'name' 			=> $this->input->post('name'), 
				'description'	=> $this->input->post('description'), 
				'status' 		=> $this->input->post('status'),
			);
		$result=$this->db->insert('dl_type',$data);
		return $result;
	}
	function updateEmp(){
		$id=$this->input->post('id');
		$name=$this->input->post('name');
		$age=$this->input->post('age');
		$designation=$this->input->post('designation');
		$skills=$this->input->post('skills');
		$address=$this->input->post('address');
		$this->db->set('name', $name);
		$this->db->set('age', $age);
		$this->db->set('designation', $designation);
		$this->db->set('skills', $skills);
		$this->db->set('address', $address);
		$this->db->where('id', $id);
		$result=$this->db->update('emp');
		return $result;	
	}
	// function deleteEmp(){
	// 	$id=$this->input->post('id');
	// 	$this->db->where('id', $id);
	// 	$result=$this->db->delete('emp');
	// 	return $result;
	// }	
}

?>