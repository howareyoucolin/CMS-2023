<?php 

function get_acf_data($id){
	$specifications_fields = array();
	$fields = acf_get_fields($id);
	foreach ( $fields as $field ) {
		$field_value = get_field( $field['name'] );		
		if ( $field_value && !empty( $field_value ) ) {
				$specifications_fields[$field['name']] = $field_value;
		}
	}
	return $specifications_fields;
}



function get_website_data(){
	$data = get_acf_data('group_6421a6b6493ed');;
	return $data;
}


