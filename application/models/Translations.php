<?php

class Translations extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table_name = "master_translations";
		$this->table_column = array('author_name', 'slug', 'name', 'language_name', 'status');
		$this->table_column_key = array('id', 'author_name', 'slug', 'name', 'language_name', 'status');
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