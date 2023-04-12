<?php 

// ini_set('display_errors', 1); 
// ini_set('display_startup_errors', 1); 
// error_reporting(E_ALL);

include_once(dirname(__FILE__).'/data.php');
include_once(dirname(__FILE__).'/editors.php');
include_once(dirname(__FILE__).'/config.php');

add_filter('use_block_editor_for_post', '__return_false', 10); 

function get_siteurl_associate_to_post_id($post_id){
  foreach(RULES as $rule){
      if($rule['id']==$post_id) return $rule['siteurl'];
  }
  die('error in func get_siteurl_associate_to_post_id!');
}

function ping_website($post_id){
	$data = get_website_data();
  $siteurl = get_siteurl_associate_to_post_id($post_id);

	$post = [
	    'token' => 'FatfatEatShit',
	    'data' => json_encode($data),
	];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"$siteurl/receptor/index.php");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$output = curl_exec($ch);
	curl_close($ch);
}
add_action( 'acf/save_post', 'ping_website',999, 1);


// Display table rows as columns.
function admin_custom_css() {
  echo '<style>
    .wp_flex tbody {
      display:flex;
      flex-direction: row;
    } 
    .wp_flex tbody tr{
    	flex: 1 1 0;
    }
    .wp_flex tbody tr td{
    	display:block;
    }
    .wp_500 iframe{
    	height:500px !important;
    }
    .wp_750 iframe{
    	height:750px !important;
    }
    .wp_1000 iframe{
    	height:1000px !important;
    }
  </style>';
}
add_action('admin_head', 'admin_custom_css');