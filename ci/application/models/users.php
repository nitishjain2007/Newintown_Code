<?php 
class Users extends CI_Model{
	function getAll($sector){
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
}
?>