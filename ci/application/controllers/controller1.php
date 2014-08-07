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
		$user = $_GET["user"];
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
		$log = $_GET["logstatus"];
		if($this->input->cookie('session')){
		$sessionname = $_COOKIE['session'];
		$g = $this->users->getsessioninfo($sessionname);
		foreach($g->result() as $i){
			$shorted = $i->shortpg;
		}
		$shorted = explode(',',$shorted);
		}
		for($j=0;$j<count($list);$j++){
			$temp = explode(',',$list[$j]->gps);
			$list[$j]->lati = $temp[0];
			$list[$j]->longi = $temp[1];
			if($this->input->cookie('session')){
			if(in_array($list[$j]->pid,$shorted)){
				$list[$j]->short = "yes";
			}
			else{
				$list[$j]->short = "no";
			}
			}
			else{
				$list[$j]->short = "no";
			}
		}
		$data = array("locations" => $list,"log" => $_GET["logstatus"],"user" => $_GET["user"]);
		$this->load->view("4",$data);
	}
	function viewshortlist(){
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
    	}
    	if($this->input->cookie('log') == "loggedin"){
    		$user = $_COOKIE['newuser'];
    		$this->load->model("users");
    		$f = $this->users->retrievedata($user);
    		foreach($f->result() as $i){
    			$userdata = $i;
    		}
    		if($userdata->shortpg == NULL && $userdata->shortflat == NULL){
    			$this->load->view('viewshortnone');
    		}
    		else{
    			$short = $userdata->shortpg;
    			$short1 = $userdata->shortflat;
    			$list = array();
    			$list1 = array();
    			if($short != NULL || $short != ""){
    				$shorted = explode(',',$short);
    				$locations = $this->users->getshort($shorted);
    				foreach($locations->result() as $i){
						$list[] = $i;
					}
    			}
    			if($short1 != NULL || $short1 != ""){
    				$shorted1 = explode(',',$short1);
    				$locations = $this->users->getshortflat($shorted1);
    				foreach($locations->result() as $i){
						$list1[] = $i;
					}
    			}
			    for($j=0;$j<count($list);$j++){
			        $temp = explode(',',$list[$j]->gps);
	                $list[$j]->lati = $temp[0];
	                $list[$j]->longi = $temp[1];
				}
			    for($j=0;$j<count($list1);$j++){
			        $temp = explode(',',$list1[$j]->gps);
	                $list1[$j]->lati = $temp[0];
	                $list1[$j]->longi = $temp[1];
				}
				$data = array("locations" => $list,"locations1" => $list1,"log"=>"loggedin","user"=>$_COOKIE['newuser']);
				$this->load->view("shortlist",$data);
    		}
    	}
    	else{
		if(!$this->input->cookie('session')){
			$this->load->view('viewshortnone');
		}
		else{
			$sessionname = $_COOKIE['session'];
			$this->load->model("users");
			$f = $this->users->getsessioninfo($sessionname);
			$short = "";
			$short1 = "";
			foreach($f->result() as $i){
				$short = $i->shortpg;
				$short1 = $i->shortflat;
			}
			$short2 = $short . $short1;
			if($short2 == ""){
				$this->load->view('viewshortnone');
			}
			else{
				$list = array();
				$list1 = array();
				if($short!= ""){
					$shorted = explode(',',$short);
					$locations = $this->users->getshort($shorted);
					foreach($locations->result() as $i){
						$list[] = $i;
					}
				}
				if($short1!=""){
					$shorted = explode(',',$short1);
					$locations = $this->users->getshortflat($shorted);
					foreach($locations->result() as $i){
						$list1[] = $i;
					}
				}
		    for($j=0;$j<count($list);$j++){
		        $temp = explode(',',$list[$j]->gps);
                $list[$j]->lati = $temp[0];
                $list[$j]->longi = $temp[1];
			}
		    for($j=0;$j<count($list1);$j++){
		        $temp = explode(',',$list1[$j]->gps);
                $list1[$j]->lati = $temp[0];
                $list1[$j]->longi = $temp[1];
			}
			$data = array("locations" => $list,"locations1" => $list1,"log"=>"loggedout","user"=>"");
			$this->load->view("shortlist",$data);	
			}
		}
	}
	}
	function checkifshort(){
		if(!isset($_COOKIE["session"])){
			echo "failure";
		}
		else{
			$user = $_COOKIE['session'];
    		$this->load->model("users");
    		$f = $this->users->getsessioninfo($user);
    		foreach($f->result() as $i){
    			$userdata = $i;
    		}
    		if(($userdata->shortpg == NULL || $userdata->shortpg == "")&&($userdata->shortflat==NULL || $userdata->shortflat=="")){
    			echo "failure";
    		}
    		else{
    			echo "success";
    		}
		}
	}
	function logout(){
                delete_cookie("log");
	}
	function yourshortlist(){
		$customerid = $_GET["id"];
	}
	function validate(){
		$username = $_POST["username"];
		$this->load->model("users");
		$f = $this->users->check($username);
		$j = 0;
		foreach($f->result() as $i){
			$j = $j + 1;
		}
		if($j == 0){
			echo "success";
		}
		else{
			echo "failure";
		}
	}
	function removeshort1(){
		$pid = $_POST["pid"];
		$this->load->model("users");
		$sessionname = $_COOKIE["session"];
		$f = $this->users->getsessioninfo($sessionname);
		$shorted = "";
		foreach($f->result() as $i){
			$shorted = $i->shortpg;
		}
		$shorted = explode(',',$shorted);
		$short = "";
		for($i=0;$i<count($shorted);$i++){
			if($shorted[$i] != $pid){
				$short = $short . "," . $shorted[$i];
			}
		}
		if($short != ""){
			$short = substr($short,1);
		}
		$this->users->addshortpid($sessionname,$short);
	}
	function removeshort2(){
		$pid = $_POST["pid"];
		$this->load->model("users");
		$sessionname = $_COOKIE["session"];
		$f = $this->users->getsessioninfo($sessionname);
		$shorted = "";
		foreach($f->result() as $i){
			$shorted = $i->shortflat;
		}
		$shorted = explode(',',$shorted);
		$short = "";
		for($i=0;$i<count($shorted);$i++){
			if($shorted[$i] != $pid){
				$short = $short . "," . $shorted[$i];
			}
		}
		if($short != ""){
			$short = substr($short,1);
		}
		$this->users->addshortpidflat($sessionname,$short);
	}
	function addshort(){
		$pid = $_POST["pid"];
		$this->load->model('users');
		if(!$this->input->cookie('session')){
			$sessionname = $this->users->getcurrentsession();
                        $cookie = array(
                        'name'   => 'session',
                        'value'  => $sessionname,
                        'expire' => '1000000',
                        'path'   => '/',
                        'prefix' => '',
	                );
        		$this->input->set_cookie($cookie);
		        $_COOKIE['session'] = $sessionname;
			$this->users->addsession($sessionname);
		}
		$sessionname = $_COOKIE['session'];
		$short = $this->users->getsessioninfo($sessionname);
		$shorted = "";
		foreach($short->result() as $i){
			$shorted = $i->shortpg;
		}
		if($shorted == NULL || $shorted == ""){
			$shorted = $pid;
		}
		else{
			$shorted = $shorted . ',' . $pid;
		}
		$shortedids = explode(',',$shorted);
		if(count($shortedids) >=7){
			echo "failure";
		}
		else{
			$this->users->addshortpid($sessionname,$shorted);
			echo "success";
		}
	}
	function addshortflat(){
		$pid = $_POST["pid"];
		$this->load->model('users');
		if(!$this->input->cookie('session')){
			$sessionname = $this->users->getcurrentsession();
			echo $sessionname;
                        $cookie = array(
                        'name'   => 'session',
                        'value'  => $sessionname,
                        'expire' => '1000000',
                        'path'   => '/',
                        'prefix' => '',
	                );
        		$this->input->set_cookie($cookie);
		        $_COOKIE['session'] = $sessionname;
			$this->users->addsession($sessionname);
		}
		$sessionname = $_COOKIE['session'];
		$short = $this->users->getsessioninfo($sessionname);
		$shorted = "";
		foreach($short->result() as $i){
			$shorted = $i->shortflat;
		}
		if($shorted == NULL || $shorted == ""){
			$shorted = $pid;
		}
		else{
			$shorted = $shorted . ',' . $pid;
		}
		$shortedids = explode(',',$shorted);
		if(count($shortedids) >=7){
			echo "failure";
		}
		else{
			$this->users->addshortpidflat($sessionname,$shorted);
			echo "success";
		}
	}
	function checkuser1(){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$data = array("username" => $username, "password" => $password);
		$this->load->model("users");
		$f = $this->users->checkuser($data);
		$j=0;
		foreach($f->result() as $i){
			$j = $j + 1;
		}
		if($j == 1){
			$userinfo = $this->users->check($username);
			foreach($userinfo->result() as $i){
				$phone = $i->phoneno;
				$shortpg = $i->shortpg;
				$shortflat = $i->shortflat;
				$name = $i->name;
			}
			$flag = "no";
			$g = $this->users->getuserinfor($username);
			foreach($g->result() as $i){
				$flag = "yes";
			}
			if($flag == "no"){
				$f=$this->users->getsessioninfo($_COOKIE['session']);
				foreach($f->result() as $i){
					$shortpg1 = $i->shortpg;
					$shortflat1 = $i->shortflat;
				}
				$this->users->createsitevisit($name,$username,$phone,$shortpg1,$shortflat1);
				echo "success";
			}
			else{
				echo "alreadysitevisit";
			}
		}
		else{
			echo "failure";
		}
	}
	function getcurrentshortlistedpg(){
		if(isset($_COOKIE['session'])){
			$this->load->model('users');
			$f = $this->users->getsessioninfo($_COOKIE["session"]);
			foreach($f->result() as $i){
				$shorted = $i->shortpg;
			}
			echo $shorted;
		}
		else{
			echo "false";
		}
	}
	function yourshortlisted(){
		$userid = $_GET["userid"];
		$this->load->model('users');
		$f = $this->users->gethistoryinfo($userid);
		foreach($f->result() as $i){
			$shortedpg = $i->shortpg;
			$shortedflat = $i->shortflat;
		}
		$shorted = explode(",",$shortedpg);
		$shorted1 = explode(",",$shortedflat);
		$shortedpg1 = $this->users->getshort($shorted);
		$shortedflat1 = $this->users->getshortflat($shorted1);
		$list = array();
		$list1 = array();
		foreach($shortedpg1->result() as $i){
			$list[] = $i;
		}
		foreach($shortedflat1->result() as $i){
			$list1[] = $i;
		}
		for($i=0;$i<count($list);$i++){
			$temp = explode(",",$list[$i]->gps);
			$list[$i]->lati = $temp[0];
			$list[$i]->longi = $temp[1];
		}
		for($i=0;$i<count($list1);$i++){
			$temp = explode(",",$list1[$i]->gps);
			$list1[$i]->lati = $temp[0];
			$list1[$i]->longi = $temp[1];
		}
		$data = array("locations" => $list,"locations1" => $list1);
		$this->load->view("yourshortlisted",$data);
	}
	function getcurrentshortlistedflat(){
		if($_COOKIE['session']){
			$this->load->model('users');
			$f = $this->users->getsessioninfo($_COOKIE["session"]);
			foreach($f->result() as $i){
				$shorted = $i->shortflat;
			}
			echo $shorted;
		}
		else{
			echo "false";
		}
	}
	function makesitevisit(){
		$name = $_POST["name"];
		$username = $_POST["username"];
		$phone = $_POST["phone"];
		$pickdate = $_POST["pickdate"];
		$picktime = $_POST["picktime"];
		$pickplace = $_POST["pickplace"];
		$this->load->model("users");
		$j = 0;
		$sessioninfo = $this->users->getuserinfor($username);
		foreach($sessioninfo->result() as $i){
			$j = $j + 1;
		}
		if($j == 1){
			echo "failure";
		}
		else{
			if(isset($_COOKIE["session"])){
				$f = $this->users->getsessioninfo($_COOKIE["session"]);
			}
			$shortpg = "";
			$shortflat = "";
			if(isset($_COOKIE["session"])){
			foreach ($f->result() as $i){
				if(!empty($i->shortpg)){
					$shortpg = $i->shortpg;
				}
				if(!empty($i->shortflat)){
					$shortflat = $i->shortflat;
				}
			}
			}
			if($shortflat == "" && $shortpg == ""){
				echo "wrong";
			}
			else{
				$this->users->createsitevisit($name,$username,$phone,$pickdate,$picktime,$pickplace,$shortpg,$shortflat);
				$cusid = $name . $username . $phone ;
				$cusid4 = md5($cusid);
				$f = $this->users->gethistoryinfo($cusid4);
				$j = 0;
				$shortpg4 = "";
				$shortflat4 = "";
				foreach($f->result() as $i){
					$j = $j + 1;
					if(!empty($i->shortpg)){
						$shortpg4 = $i->shortpg;
					}
					if(!empty($i->shortflat)){
						$shortflat4 = $i->shortflat;
					}
				}
				if($j==1){
					$shortpg5 = $shortpg . $shortpg4;
					$shortflat5 = $shortflat . $shortflat4;
					$this->users->updatehistory($cusid4,$shortpg5,$shortflat5); 
				}
				else{
					$this->users->createhistory($cusid4,$shortpg,$shortflat);
				}
				echo "success";
			}
		}
	}
	function checkuser(){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$data = array("username" => $username, "password" => $password);
		$this->load->model("users");
		$f = $this->users->checkuser($data);
		$j=0;
		foreach($f->result() as $i){
			$j = $j + 1;
		}
		if($j == 1){
			echo "success";
		}
		else{
			echo "failure";
		}
	}
	function createuser(){
		$name = $_POST["name"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$phoneno = $_POST["phoneno"];
		$data = array("name" => $name,"username" => $username, "password" => $password, "phoneno" => $phoneno);
		$this->load->model("users");
		$this->users->createuser($data);
	}
	function five(){
		$lng = $_GET["lng"];
		$lat = $_GET["lat"];
		$furniture = $_GET["furnishing"];
		$sharing = $_GET["sharing"];
		$advance = "";
		$user = $_GET["user"];
		if(isset($_GET["advance"])){
			$advance = $_GET["advance"];
		}
		if($furniture == ""){
			$furniture = "all";
		}
		if($sharing == ""){
			$sharing = "all";
		}
		$furniture = explode(',',$furniture);
		$sharing = explode(',',$sharing);
		$advancevars = array();
		if($advance!=""){
			$advance = explode(',',$advance);
			foreach($advance as $i){
				$advancevars[$i] = "y";
			}
		}
		$list = array();
		$this->load->model("users");
		$f = $this->users->tempflat($furniture,$sharing,$advancevars);
		foreach ($f->result() as $i){
			$temp = explode(',',$i->gps);
			if($this->_calculate($temp[1],$temp[0],$lng,$lat) <=5){
				$list[] = $i;
			}
		}
		$log = $_GET["logstatus"];
		if($this->input->cookie('session')){
		$sessionname = $_COOKIE['session'];
		$g = $this->users->getsessioninfo($sessionname);
		foreach($g->result() as $i){
			$shorted = $i->shortflat;
		}
		$shorted = explode(',',$shorted);
		}
		for($j=0;$j<count($list);$j++){
			$temp = explode(',',$list[$j]->gps);
			$list[$j]->lati = $temp[0];
			$list[$j]->longi = $temp[1];
			if($this->input->cookie('session')){
			if(in_array($list[$j]->pid,$shorted)){
				$list[$j]->short = "yes";
			}
			else{
				$list[$j]->short = "no";
			}
			}
			else{
				$list[$j]->short = "no";
			}
		}
		$data = array("locations" => $list,"log" => $_GET["logstatus"],"user" => $_GET["user"]);
		$this->load->view("5",$data);
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
		if($_GET["type"] == "pg"){
			$page = "query4";
		}
		else{
			$page = "query5";
		}
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
    	$this->load->view($page,$data);
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
						$this->load->view($page,$data);
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
						$this->load->view($page,$data);
					}
				}
				else{
					$data = array("log" => $this->input->cookie('log'),"list" => $list,"login"=>$login,"logout"=>$logout,"lng" => $lng,"lat" => $lat);
					$this->load->view($page,$data);
				}
			}
			else{
				$data = array("log" => $this->input->cookie('log'), "user" => $this->input->cookie('newuser'),"list"=>$list,"login"=>$login,"logout"=>$logout,"lng" => $lng,"lat" => $lat);
				$this->load->view($page,$data);
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
