<?php

if(is_user_logged_in()){

	global $pagenow;
	$postid = isset($_GET['post'])?$_GET['post']:0;
	$action = isset($_GET['action'])?$_GET['action']:'';
	$username = wp_get_current_user()->data->user_login;

	if(!($pagenow === 'admin-ajax.php' || $pagenow === 'async-upload.php')){

		// Wangzu
		if(str_contains($username,'wangzu')){
			if(!($pagenow == 'post.php' && $postid == 10 && $action == 'edit')){
				header("Location: http://api.wangzubeauty.com/wp-admin/post.php?post=10&action=edit");
			}
		}







	}
}
