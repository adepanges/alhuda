<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->library("rest_request");
		$this->load->model("chapter");


		$this->api_quran = $this->config->item("api_quran");
		$this->endpoint = "chapters";

		$this->mylog->init(array(
			'log_name' => 'GRAB'
		));
	}

	public function add()
	{
		$this->mylog->write(__METHOD__, 'START');
		$endpoint = $this->api_quran.$this->endpoint;
		$params = array(
			"language" => "id"
		);
		$this->mylog->http(__METHOD__, 'GET', $endpoint, array(), $params);
		$response = $this->rest_request->get($endpoint, array(), $params);
		
		if(isset($response->body->chapters) && is_array($response->body->chapters)){
			foreach ($response->body->chapters as $key => $value) {
				$value = (array) $value;
				$value['status'] = 1;
				$value['bismillah_pre'] = (int) $value['bismillah_pre'];

				var_dump($value);
				exit;

				$this->mylog->write(__METHOD__, 'Surat ditambahkan', $value);
				$this->chapter->add($value);
			}
		}
		$this->mylog->write(__METHOD__, 'END');
	}

	public function add_translated($lang = "id"){
		$this->mylog->write(__METHOD__, 'START');
		$params = array(
			"language" => $lang
		);
		$endpoint = $this->api_quran.$this->endpoint;
		$this->mylog->http(__METHOD__, 'GET', $endpoint, array(), $params);
		$response = $this->rest_request->get($endpoint, array(), $params);
		$this->mylog->http_response(__METHOD__, $response);
		
		if(isset($response->body->chapters) && is_array($response->body->chapters)){
			foreach ($response->body->chapters as $key => $value) {
				$value = (array) $value;
				$tn = (array) $value['translated_name'];
				$data['chapter_number'] = $value['chapter_number'];
				$data['language_name'] = isset($tn['language_name'])?$tn['language_name']:'';
				$data['name'] = isset($tn['name'])?$tn['name']:'';

				$this->chapter->add_translated($data);
			}
		}
	}
}