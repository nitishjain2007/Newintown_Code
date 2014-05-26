<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller1 extends CI_Controller{

	public function index(){
		echo "this is the function named index";
	}
	public function three(){
		$state = 0;
		if($_GET["2BHK"] == "yes"):
			$databasevar[] = "2BHK";
			$state=1;
		endif;
		if($_GET["3BHK"] == "yes"):
			$databasevar[] = "3BHK";
			$state = 1;
		endif;
		$this->load->model('users');
		if($state==1):
			$g = $this->users->filter($databasevar,$_GET["sector"]);
		else:
			$g = "your searches did not match any records";
		endif;
		$data = array('second' => $g, 'state' => $state);
		$this->load->view("three",$data);
	} 
	public function two(){
		$s = $_POST["sector"];
		$this->load->model('users');
		$f = $this->users->getAll($s);
		$data = array('first' => $f);
		$this->load->view("two",$data);
	}
	public function one(){
		$this->load->view("one");
	}
}
?>