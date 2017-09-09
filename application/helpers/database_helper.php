<?php

function paramatize_data($field, $data = array(), $mandatory_check = array()){
	$out = array(
		"data" => array()
	);

	foreach ($field as $key => $value) {
		if(isset($data[$value])) $out['data'][$value] = $data[$value];
	}

	if(!empty($mandatory_check)) {

	}

	return $out;
}