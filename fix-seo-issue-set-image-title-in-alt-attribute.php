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
				$getImageFileName = getImageName($image_alt);
				update_post_meta($attachment->ID, '_wp_attachment_image_alt', $image_alt);
		}
	}
} 
 
}




// remove the file extension if any, get the image file name and return
function getImageName ($str ){
    $fileExt=''; 
    if ( strpos($str, '.png') !== false ) {
        $fileExt = substr($str, -4); 
        $filename = explode($fileExt, $str);
        $filename =  isset($filename[0]) ? $filename[0] : '';
        
    }else if ( strpos($str, '.jpeg') !== false ){ 
        $fileExt = substr($str, -5); 
        $filename = explode($fileExt, $str);
        $filename =  isset($filename[0]) ? $filename[0] : '';
        
    } else if ( strpos($str, '.jpg') !== false ){
        $fileExt = substr($str, -4); 
        $filename = explode($fileExt, $str);
         $filename =  isset($filename[0]) ? $filename[0] : '';
    } 
    
    return $filename; 
    
}
 /* For any assistance, or hire me for your next project , skype me at imran.javed11
	Please subscribe my youtube channel link is: https://bit.ly/learn-wp-with-imran-javed-on-youtube
	
	Thank you!
 */

?>