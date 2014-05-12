<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller1 extends CI_Controller{

/*	public function __construct(){
		parent::__construct();
		echo "This is from the parent<br>";
	}*/

	public function index(){
		echo "this is the function named index";
	}

	public function one(){
		$n = date("Y");
		$data = array('year' => $n);
		$this->load->view("one", $data);
	}
}
?>