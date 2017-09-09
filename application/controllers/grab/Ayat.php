<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayat extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->library("rest_request");
		$this->load->model(array("verse","chapter","languages", "translations"));


		$this->api_quran = $this->config->item("api_quran");
		$this->endpoint = "chapters";

		$this->mylog->init(array(
			'log_name' => 'GRAB'
		));
	}

	function add(){
		$surat_data = $this->chapter->get(array('status' => 1))->result();
		$languages = $this->languages->get(array('iso_code' => "id"))->first_row()->iso_code;
		$translations_data = $this->translations->get(array('status' => 1))->result();


		$translations = array();
		foreach ($translations_data as $key => $value_translations) {
			$translations[] = $value_translations->id_ext;
		}

		$params = array(
			'translations' => $translations,
			'language' => $languages,
			// 'recitation' => '3',
			'media' => '',
			'page' => '1',
			// 'offset' => '0',
			'limit' => '10',
			'text_type' => 'words'
		);
		
		foreach ($surat_data as $key => $value_surat) {
			$endpoint = $this->api_quran.$this->endpoint."/{$value_surat->id_ext}/verses";
			// echo $endpoint."\n";
		}
	}
}