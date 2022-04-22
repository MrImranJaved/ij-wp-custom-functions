<?php

 function CheckAllImagesAltTextAndSet(){
	
	global $post;
	

	// Get only image post_mime_type
	$filtered_mime_types = array();

foreach( get_allowed_mime_types() as $key => $type ):
    if( false !== strpos( $type, 'image' ) )
        $filtered_mime_types[] = $type;
endforeach;
	

	// set an array to fetch all the attachments
	$args = array( 
	
    'post_type' => 'attachment', 
    'posts_per_page' => -1 ,
    'post_mime_type' => implode( ',', $filtered_mime_types )

); 
$attachments = get_posts( $args );


	
if ( $attachments ) {

	foreach ( $attachments as $attachment ) { 
		$alt_text = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);

		// if image 's alt text is not set , then set them. 
			if(  empty( $alt_text ) ){

				$image_alt = $attachment->post_title;
				update_post_meta($attachment->ID, '_wp_attachment_image_alt', $image_alt);
		}
	}
} 
 
}



?>