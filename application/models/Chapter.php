<?php

class Chapter extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table_name = "chapters";
		$this->table_name_translated = "chapters_translated";

		$this->table_field = array("id", "chapter_number", "bismillah_pre", "revelation_order", "revelation_place", "name_complex", "name_arabic", "name_simple", "verses_count", "status");

	}

	function add($data = array()){
		$params = paramatize_data($this->table_field, $data);

		if(empty($params['data'])) return FALSE;
		else return $this->db->insert($this->table_name, $params['data']);
	}

	function add_translated($data = array()){
		$field = array("chapter_number", "language_name", "name");

		$params = paramatize_data($field, $data);

		if(empty($params['data'])) return FALSE;
		else return $this->db->insert($this->table_name_translated, $params['data']);
	}

	function get($params){
		$params = paramatize_data($this->table_field, $params);
		$res = $this->db->get_where($this->table_name, $params['data']);
		return $res;
	}
	
}