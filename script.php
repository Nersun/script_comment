<?php 

if (!isset($_REQUEST)) return; 
	require 'param.php';
$data = json_decode(file_get_contents('php://input')); 

	if ($param['message'] == " ") return;
	if ($param['confirmation_token'] == " ") return;
	if ($param['token'] == " ") return;
	if ($param['group_id'] == " ") return;

switch ($data->type) { 

	case 'confirmation': 
		if ($data->group_id == $param['group_id']) {
			echo $param['confirmation_token']; 
		}else return;
	break; 

	case 'wall_post_new':
		$id_post = $data->object->id;
		$owner_id = $data->object->owner_id;
		$request_params = array(
			'message' => $param['message'],
			'post_id' => $id_post,
			'owner_id' => $owner_id,
			'access_token' => $param['token'],
			'v' => '5.80'
		);
		$get_params = http_build_query($request_params);
		$x = file_get_contents('https://api.vk.com/method/wall.createComment?' . $get_params);
		echo "ok";
	break;
} 
?> 
