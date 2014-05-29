<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller1 extends CI_Controller{

	public function index(){
		echo "this is the function named index";
	}
	public function four(){
		$lngstr = $_GET["lng"]; //specifies longitude in string
		$latstr = $_GET["lat"]; //specifies latitude in string
		$lngdec = floatval($lngstr);
		$latdec = floatval($latstr); 
		$lat1 = 28.491743000000000000;
		$lng1 = 77.070836999999980000;
		$theta = $lng1 - $lngdec;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($latdec)) + cos(deg2rad($lat1)) * cos(deg2rad($latdec)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);	
		$kilometres = $dist * 60 * 1.1515 * 1.609344;
		echo $kilometres;
		echo " km";
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