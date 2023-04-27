<?php 

// ini_set('display_errors', 1); 
// ini_set('display_startup_errors', 1); 
// error_reporting(E_ALL);

function cmp($a, $b) {
  return strcmp($a->post_date, $b->post_date);
}

function _save_posts_ping_website($post_id){
  $data = (object) array(
    "keys" => array(),
    "posts" => (object) array()
  );
  $keys = array();
	$posts = get_posts(array(
  'numberposts' => -1,
 ));
  if(is_array($posts)){
    foreach($posts as $p){
      $keys[] = (object) array(
        'post_name' => $p->post_name,
        'post_date' => $p->post_date
      );
      $data->posts->{$p->post_name} = (object) array(
        "post_name" => $p->post_name,
        "post_date" => $p->post_date,
        "post_content"=> $p->post_content,
        "post_title"=> $p->post_title,
        "modified_date" => $p->post_modified,
        // 'x' => $p
      );
    }
  }

  usort($keys, "cmp");
  foreach($keys as $key){
    $data->keys[] = $key->post_name;
  }
  $data->keys = array_reverse($data->keys);

  $siteurl = RULES[0]['siteurl'];

	$post = [
	    'token' => 'FatfatEatShit',
	    'data' => json_encode($data),
	];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"$siteurl/receptor/posts.php");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$output = curl_exec($ch);
	curl_close($ch);
}
add_action( 'save_post', '_save_posts_ping_website',999, 1);
