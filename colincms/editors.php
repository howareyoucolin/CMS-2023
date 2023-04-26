<?php

include_once(dirname(__FILE__).'/config.php');

if(is_user_logged_in()){

	global $pagenow;
	$postid = isset($_GET['post'])?$_GET['post']:0;
	$action = isset($_GET['action'])?$_GET['action']:'';
	$username = wp_get_current_user()->data->user_login;
    $roles = ( array ) wp_get_current_user()->roles;

    if(!str_starts_with($username, 'manager') && in_array('editor', $roles)){
		function editor_custom_css() {
		  echo '<style>
		    #wpadminbar, #adminmenu li:not(.editor-info), #screen-meta-links, 
		  	.page-title-action, #footer-thankyou, #titlewrap, 
		  	.wrap h1.wp-heading-inline, #submitdiv a, #message a{display:none;}
		  	#submitdiv{position: fixed;top: 120px;}
		  	#adminmenu li.editor-info{
		  		background:#fff;padding:15px;margin:0 8px;word-break: break-word;;
		  	}
		  </style>';
		}
		add_action('admin_head', 'editor_custom_css');
		function se26675378_adminmenu(){
			global $username;
		    echo "<li class=\"editor-info\">You're logged in as $username.<br/><a href=\"".wp_logout_url()."\" style=\"margin-top:10px;padding:0;\"><button class=\"button button-primary button-large\" style=\"width:100%;\">Log out</button></a>
		    </li>";
		}
		add_action( 'adminmenu', 'se26675378_adminmenu' );
    
		// if(!($pagenow === 'admin-ajax.php' || $pagenow === 'async-upload.php' || $pagenow === 'wp-login.php')){
		// 	$matched=false;
		// 	foreach(RULES as $rule):
		// 		if(str_starts_with($username, $rule['prefix'])){
		// 			$matched=true;
		// 			if(!($pagenow == 'post.php' && $postid == $rule['id'] && $action == 'edit')){
		// 				header("Location:".HOSTNAME."/wp-admin/post.php?post=10&action=edit");
		// 			}
		// 		}
		// 	endforeach;
		// 	if(!$matched) die('Access Denied!');
		// }

	}
}
