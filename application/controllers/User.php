<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Controller {
	//$this->load->helper('url');

	function __construct(){
		parent::__construct();
		$this->load->model('UserModel');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('user');
	}

	function get(){
		$data = $this->UserModel->userList();
		echo json_encode($data);
	}

	public function test()
	{
		//$this->load->view('new');
	}
}
