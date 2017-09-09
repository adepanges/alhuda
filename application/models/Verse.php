<?php

class Verse extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table_name = "verses";
		$this->table_column = array('id', 'verse_number', 'chapter_id', 'verse_key', 'text_madani', 'text_indopak', 'text_simple', 'juz_number', 'hizb_number', 'rub_number', 'sajdah', 'sajdah_number', 'version', 'status');
		$this->table_column_key = array('id', 'verse_number', 'chapter_id', 'verse_key', 'status');
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
		return $this->db->get($this->table_name, $params);
	}

	function add_if_not_exist($data = array()){

		$field_key = $this->table_column_key;
		$params_cek = paramatize_data($field_key, $data);
		$cek = $this->get($params_cek);


	}
}