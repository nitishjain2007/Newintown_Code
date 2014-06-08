<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller1 extends CI_Controller{

	public function index(){
		echo "this is the function named index";
	}
	public function _calculate($lngstr1,$latstr1,$lngstr2,$latstr2){
		$lng1 = floatval($lngstr1);
		$lat1 = floatval($latstr1); 
		$lng2 = floatval($lngstr2);
		$lat2 = floatval($latstr2);
		$theta = $lng1 - $lng2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);	
		$kilometres = $dist * 60 * 1.1515 * 1.609344;
		return $kilometres;
	}
	public function getplaces()
	{
		$type = $_GET["type"];
		$advance = $_GET["advance"];
		echo "the following is the type";
		echo "<br>";
		echo $type;
		echo "<br>";
		echo "<br>";
		echo "the following are distances of all possible types from desired location";
		echo "<br>";
		echo "<br>";
		$lng = $_GET["lng"];
		$lat = $_GET["lat"];
		$array = explode(',',$type);
		$advancearray = explode(',',$advance);
		$advancevars = array();
		if($advance != ""){
			foreach($advancearray as $i){
				$advancevars[$i] = "yes";
			}
		}
		$this->load->model('users');
		if($type=="all"){
			$f = $this->users->getall($advancevars);
		}
		else{
			$f = $this->users->getfiltered($array,$advancevars);
		}
		$requiredlocations = array();
		foreach($f->result() as $d){
			$temp = explode(',',$d->gps);
			echo $this->_calculate($temp[1],$temp[0],$lng,$lat);
			echo "<br>";
			if($this->_calculate($temp[1],$temp[0],$lng,$lat) <=5){
				$requiredlocations[] = $d;
			}
		}
		$data = array('locations' => $requiredlocations);
		$this->load->view("places",$data);
	}
	public function query(){
		$lngstr = $_GET["lng"]; //specifies longitude in string
		$latstr = $_GET["lat"]; //specifies latitude in string
		$data = array('lngstr' => $lngstr, 'latstr' => $latstr);
		$this->load->view("query", $data);
	}
	public function main(){
		$this->load->view("main");
	}
}
?>