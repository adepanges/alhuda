<?php

class Languages extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table_name = "master_languages";
		$this->table_column = array('name', 'iso_code', 'native_name', 'direction', 'status');
		$this->table_column_key = array('id', 'name', 'iso_code', 'native_name', 'direction', 'status');
	}

	function add($data = array()){
		$field = $this->table_column;
		$params = paramatize_data($field, $data);

		if(empty($params['data'])) return FALSE;
		else return $this->db->insert($this->table_name, $params['data']);
	}

	function get($where_array = array()){
		$field = $this->table_column;
		$params = paramatize_data($field, $where_array);
		return $this->db->get_where($this->table_name, $params['data']);
	}
}