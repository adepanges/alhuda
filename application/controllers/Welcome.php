<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->library("rest_request");
	}

	public function index()
	{
		$response = $this->rest_request->post('http://echo.jsontest.com/insert-key-here/insert-value-here/key/value');
		var_dump($response->raw_body);
		// $this->load->view('welcome_message');
	}
}
