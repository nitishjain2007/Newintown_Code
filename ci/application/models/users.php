<?php 
class Users extends CI_Model{
	function getAll11($sector){
		$this->db->select('*');
		$this->db->from('properties');
		//$this->db->where_in('id',$ids);
		$this->db->where_in('sector',$sector);
		//$this->db->where_in('type',"2BHK");
		$q = $this->db->get();
		//$this->db->select('test');
		//$ids = array(1,2);
		//$q = $this->db->query('SELECT * from test where id = $ids and title="some text"');
		//$q = $this->db->field_data('test');
		//foreach($q->result() as $row)
		//var_dump($q);
		///foreach($q->result() as $field)
		///{
			///echo $field->address;
			///echo "<br>";
		///}
		return $q;
	}
	function filter($databasevar,$sector){
		$this->db->select('*');
		$this->db->from('properties');
		$this->db->where_in('sector',$sector);
		$this->db->where_in('type',$databasevar);
		$f = $this->db->get();
		return $f;
	}
	function getall($advancevars){
		$this->db->select('*');
		$this->db->from('pg');
		$this->db->where($advancevars);
		$result = $this->db->get();
		return $result;
	}
	function getfiltered($databasevar,$advancevars){
		$this->db->select('*');
		$this->db->from('pg');
		$this->db->where_in('house_type',$databasevar);
		$this->db->where($advancevars);
		$result = $this->db->get();
		return $result;
	}
	function authenticate($authentications){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($authentications);
		$recievedcreddentials = $this->db->get();
		$dummy = array();
		foreach($recievedcreddentials->result() as $d){
			$dummy[] = $d;
		}
		if(count($dummy) == 0){
			$result = 'false';
		}
		else{
			$result = 'true';
		}
		return $result;
	}
	function getimages($data){
		$this->db->select($data);
		$this->db->from('pg');
		$result = $this->db->get();
		return $result;
	}
	function temp($gender,$sharing,$advancevars){
		$this->db->select('*');
		$this->db->from('pg');
		if($gender[0]!="all"){
			$this->db->where_in('seeking_a',$gender);
		}
		if($sharing[0]!="all"){
			$this->db->where_in('sharing_type',$sharing);
		}
		$this->db->where($advancevars);
		$result = $this->db->get();
		return $result;
	}
	function tempflat($furniture,$sharing,$advancevars){
		$this->db->select('*');
		$this->db->from('flat');
		if($furniture[0]!="all"){
			$this->db->where_in('furnishing_type',$furniture);
		}
		if($sharing[0]!="all"){
			$this->db->where_in('bhk_type',$sharing);
		}
		$this->db->where($advancevars);
		$result = $this->db->get();
		return $result;
	}
	function check($name){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where_in('username',$name);
		$result = $this->db->get();
		return $result;
	}
	function retrievedata($name){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where_in('username',$name);
		$result = $this->db->get();
		return $result;
	}
	function getsessioninfo($sessionname){
		$this->db->select('*');
		$this->db->from('sessions');
		$this->db->where_in('sessionid',$sessionname);
		$result = $this->db->get();
		return $result;
	}
	function insertdata($values){
		$this->db->insert('listing',$values);
	}
	function createuser($values){
		$this->db->insert('users',$values);
	}
	function addsession($sessionname){
		$data = array('sessionid' => $sessionname);
		$this->db->insert('sessions',$data);
	}
	function getshort($values){
		$this->db->select('*');
		$this->db->from('pg');
		$this->db->where_in('pid',$values);
		$result = $this->db->get();
		return $result;
	}
	function getshortflat($values){
		$this->db->select('*');
		$this->db->from('flat');
		$this->db->where_in('pid',$values);
		$result = $this->db->get();
		return $result;
	}
	function checkuser($values){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($values);
		$result = $this->db->get();
		return $result;
	}
	function addshort($username,$short){
		$data = array('shortpg' => $short);
		$this->db->where('username',$username);
		$this->db->update('users',$data);
	}
	function getcurrentsession(){
		$this->db->select('*');
		$this->db->from('currentsession');
		$this->db->where_in('id',1);
		$ids = $this->db->get();
		foreach($ids->result() as $i){
			$currentid = $i->session;
		}
		$currentid = $currentid + 1;
		$data = array('session' => $currentid);
		$this->db->where('id',1);
		$this->db->update('currentsession',$data);
		return $currentid;
	}
	function addshortpid($sessionname,$pid){
		$data = array('shortpg' => $pid);
		$this->db->where('sessionid',$sessionname);
		$this->db->update('sessions',$data);
	}
	function addshortpidflat($sessionname,$pid){
		$data = array('shortflat' => $pid);
		$this->db->where('sessionid',$sessionname);
		$this->db->update('sessions',$data);
	}
	function createsitevisit($name,$username,$phone,$pickdate,$picktime,$pickpoint,$shortpg,$shortflat){
		$data = array('name' => $name,"username"=>$username,"phoneno"=>$phone,"pickupdate"=>$pickdate,"pickuptime"=>$picktime,"pickuppoint"=>$pickpoint,"shortpg"=>$shortpg,"shortflat"=>$shortflat);
		$this->db->insert('sitevisits',$data);	
	}
	function getuserinfor($username){
		$this->db->select('*');
		$this->db->from('sitevisits');
		$this->db->where_in('username',$username);
		$result = $this->db->get();
		return $result;
	}
	function gethistoryinfo($cusid){
		$this->db->select('*');
		$this->db->from('customerhistory');
		$this->db->where_in('customerid',$cusid);
		$result = $this->db->get();
		return $result;
	}
	function createhistory($cusid,$shortpg,$shortflat){
		$data = array("customerid" => $cusid, "shortpg" => $shortpg, "shortflat" => $shortflat);
		$this->db->insert("customerhistory",$data);
	}
	function updatehistory($cusid,$shortpg,$shortflat){
		$data = array("shortpg"=>$shortpg,"shortflat"=>$shortflat);
		$this->db->where('customerid',$cusid);
		$this->db->update('customerhistory',$data);
	}
}
?>
