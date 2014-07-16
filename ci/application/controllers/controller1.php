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
	function query3(){
		$this->load->view("query3");
	}
	function four(){
		$lng = $_GET["lng"];
		$lat = $_GET["lat"];
		$gender = $_GET["gender"];
		$sharing = $_GET["sharing"];
		$advance = "";
		if(isset($_GET["advance"])){
			$advance = $_GET["advance"];
		}
		if($gender == ""){
			$gender = "all";
		}
		if($sharing == ""){
			$sharing = "all";
		}
		$gender = explode(',',$gender);
		$sharing = explode(',',$sharing);
		$advancevars = array();
		if($advance!=""){
			$advance = explode(',',$advance);
			foreach($advance as $i){
				$advancevars[$i] = "y";
			}
		}
		$this->load->model("users");
		$f = $this->users->temp($gender,$sharing,$advancevars);
		$list = array();
		foreach ($f->result() as $i){
			$temp = explode(',',$i->gps);
			if($this->_calculate($temp[1],$temp[0],$lng,$lat) <=5){
				$list[] = $i;
			}
		}
		$data = array("locations" => $list);
		$this->load->view("4",$data);
	}
	function five(){
		$this->load->view("5");
	}
	function three(){
		$this->load->model("users");
		$f = $this->users->temp();
		$list = array();
		foreach ($f->result() as $i){
			$list[] = $i;
		}
		$data = array("locations" => $list);
		$this->load->view("3",$data);
	}
	function query2(){
		$this->load->view("query1");
	}
	function ten(){
		$h = array();
		$h[1]="two";
		$h[2]="three";
		$data = array("free" => $h);
		$this->load->view("ten",$data);
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
		echo count($requiredlocations);
		$r = array("image_1","image_2","image_3");
		$answer = $this->users->getimages($r);
		foreach($answer->result() as $i){
			echo $i->image_1;
		}
		$data = array('locations' => $requiredlocations);
		$this->load->view("places",$data);
	}
	public function query(){
		$lng = $_GET["lng"];
		$lat = $_GET["lat"];
		$list = "no";
		$login = "no";
		$logout = "no";
		if(isset($_POST['logout'])){
			$logout = "yes";
			delete_cookie("log");
		}
		if(isset($_POST['name'])){
			$list = "yes";
			$name1 = $_POST['name'];
			$email1 = $_POST['email'];
			$phoneno1 = $_POST['phoneno'];
			$data1 = array('name' => $name1, 'email' => $email1, 'phoneno' => $phoneno1);
			$this->load->model('users');
			$this->users->insertdata($data1);
		}
		if(!$this->input->cookie('log')){
			$cookie = array(
				'name'   => 'log',
        		'value'  => 'loggedout',
        		'expire' => '1000000',
        		'path'   => '/',
        		'prefix' => '',
    		);
    	$this->input->set_cookie($cookie);
    	$_COOKIE['log'] = 'loggedout';
    	$data = array("log" => $this->input->cookie('log'),"list" => $list,"login" =>$login,"logout"=>$logout,"lng" => $lng,"lat" => $lat);
    	$this->load->view("query4",$data);
		}
		else{
			if($this->input->cookie('log')=="loggedout" || $this->input->cookie('log') == "wrong"){
				if(isset($_POST['username'])){
					$this->load->model('users');
					$credentials = array("username" => $_POST['username'], "password" => $_POST['password']);
					$f = $this->users->authenticate($credentials);
					if($f == "true"){
						$cookie1 = array(
							'name' => 'newuser',
							'value' => $_POST['username'],
							'expire' => '100000',
							'path' => '/',
							'prefix' => '',
						);
						$cookie = array(
							'name'   => 'log',
		        			'value'  => 'loggedin',
		        			'expire' => '100000',
		        			'path'   => '/',
		        			'prefix' => '',
		    			);
		    			$login = "yes";
		    			$logout = "no";
						$this->input->set_cookie($cookie1);
						$this->input->set_cookie($cookie);
						$_COOKIE['log'] = 'loggedin';
						$_COOKIE['newuser'] = $_POST["username"];
						//echo $_POST["username"];
						$data = array("log" => $this->input->cookie('log'), "user" => $this->input->cookie('newuser'), "list" => $list,"login" =>$login,"logout" => $logout,"lng" => $lng,"lat" => $lat);
						$this->load->view("query4",$data);
					}
					else{
						$cookie = array(
							'name' => 'log',
							'value' => 'wrong',
							'expire' => '100000',
							'path' => '/',
							'prefix' => '',
							);
						$this->input->set_cookie($cookie);
						$_COOKIE['log'] = "wrong";
						$data = array("log" => $this->input->cookie('log'),"list"=>$list,"login" => $login,"logout" => $logout,"lng" => $lng,"lat" => $lat);
						$this->load->view("query4",$data);
					}
				}
				else{
					$data = array("log" => $this->input->cookie('log'),"list" => $list,"login"=>$login,"logout"=>$logout,"lng" => $lng,"lat" => $lat);
					$this->load->view("query4",$data);
				}
			}
			else{
				$data = array("log" => $this->input->cookie('log'), "user" => $this->input->cookie('newuser'),"list"=>$list,"login"=>$login,"logout"=>$logout,"lng" => $lng,"lat" => $lat);
				$this->load->view("query4",$data);
			}
		}

	}
	public function query1(){
		$lngstr = $_GET["lng"]; //specifies longitude in string
		$latstr = $_GET["lat"]; //specifies latitude in string
		$type = $_GET["type"]; //specifies the type		 
		$data = array('lngstr' => $lngstr, 'latstr' => $latstr);
		$this->load->view("query1", $data);
	}
	public function main(){
		$list = "no";
		$login = "no";
		$logout = "no";
		if(isset($_POST['logout'])){
			$logout = "yes";
			delete_cookie("log");
		}
		if(isset($_POST['name'])){
			$list = "yes";
			$name1 = $_POST['name'];
			$email1 = $_POST['email'];
			$phoneno1 = $_POST['phoneno'];
			$data1 = array('name' => $name1, 'email' => $email1, 'phoneno' => $phoneno1);
			$this->load->model('users');
			$this->users->insertdata($data1);
		}
		if(!$this->input->cookie('log')){
			$cookie = array(
				'name'   => 'log',
        		'value'  => 'loggedout',
        		'expire' => '1000000',
        		'path'   => '/',
        		'prefix' => '',
    		);
    	$this->input->set_cookie($cookie);
    	$_COOKIE['log'] = 'loggedout';
    	$data = array("log" => $this->input->cookie('log'),"list" => $list,"login" =>$login,"logout"=>$logout);
    	$this->load->view("main",$data);
		}
		else{
			if($this->input->cookie('log')=="loggedout" || $this->input->cookie('log') == "wrong"){
				if(isset($_POST['username'])){
					$this->load->model('users');
					$credentials = array("username" => $_POST['username'], "password" => $_POST['password']);
					$f = $this->users->authenticate($credentials);
					if($f == "true"){
						$cookie1 = array(
							'name' => 'newuser',
							'value' => $_POST['username'],
							'expire' => '100000',
							'path' => '/',
							'prefix' => '',
						);
						$cookie = array(
							'name'   => 'log',
		        			'value'  => 'loggedin',
		        			'expire' => '100000',
		        			'path'   => '/',
		        			'prefix' => '',
		    			);
		    			$login = "yes";
		    			$logout = "no";
						$this->input->set_cookie($cookie1);
						$this->input->set_cookie($cookie);
						$_COOKIE['log'] = 'loggedin';
						$_COOKIE['newuser'] = $_POST["username"];
						//echo $_POST["username"];
						$data = array("log" => $this->input->cookie('log'), "user" => $this->input->cookie('newuser'), "list" => $list,"login" =>$login,"logout" => $logout);
						$this->load->view("main",$data);
					}
					else{
						$cookie = array(
							'name' => 'log',
							'value' => 'wrong',
							'expire' => '100000',
							'path' => '/',
							'prefix' => '',
							);
						$this->input->set_cookie($cookie);
						$_COOKIE['log'] = "wrong";
						$data = array("log" => $this->input->cookie('log'),"list"=>$list,"login" => $login,"logout" => $logout);
						$this->load->view("main",$data);
					}
				}
				else{
					$data = array("log" => $this->input->cookie('log'),"list" => $list,"login"=>$login,"logout"=>$logout);
					$this->load->view("main",$data);
				}
			}
			else{
				$data = array("log" => $this->input->cookie('log'), "user" => $this->input->cookie('newuser'),"list"=>$list,"login"=>$login,"logout"=>$logout);
				$this->load->view("main",$data);
			}
		}
	}
	public function test(){
		if(isset($_POST["username"])){
			$user = $_POST["username"];
			echo $user;
			$sessiondata = array(
				'username' => $user);
			$this->session->set_userdata($sessiondata);
		}
		$this->load->view("test");
	}
	public function test1(){
		$value = $this->session->all_userdata();
		echo $value['username'];
	}
}
?>