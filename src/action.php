<?php

/**
 * @author Saleh Mahmood
 * @package SubtitlesTimeFixer
 */

require_once 'SubtitlesTimeFixer.php';

if ( isset( $_POST['inputExists'] ) ) // Checking wheather input exists or not?
{
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {

		$target_file_data = $_FILES["subtitleFile"];

		$target_dir = "uploaded_subtitles/";
		$target_file = basename( $target_file_data["name"] );
		$target_file_name = $target_dir . generate_random_file_name();
		$upload_status = 1;

		/**
		 * Could also have done this way -> strtolower( pathinfo($target_file,PATHINFO_EXTENSION) )
		 * But alot of subtitles contains too much dots (.)
		 *
		 * @see http://php.net/manual/en/function.pathinfo.php
		 * @see http://php.net/manual/en/function.end.php
		 */
		$file_name_explosion = explode( '.', $target_file_data["name"] );
		$file_type  = end( $file_name_explosion );
		$is_file_type_srt = ( $file_type === 'srt' ) ? true : false;

	    if( $is_file_type_srt && $target_file_data['type'] = "application/octet-stream" ) {
	    	
	    	if( move_uploaded_file( $target_file_data['tmp_name'], $target_file_name ) ) {
	    		
	    		$subs_content = file_get_contents( $target_file_name );

	    		$generated_subs = SubtitlesTimeFixer::shared()
				    			   ->parse_subs_time_differ( 
				    			   		$subs_content,
				    			   		(int) $_POST['difference'] )
				    			   ->get_subtitle();

			    $fh = fopen( $target_file_name, 'w' );
		    	fwrite( $fh, $generated_subs );
		    	fclose( $fh );

	    	} else throw new Exception("File Could not be uploaded", 1);

	    } else throw new Exception("File ain't a subtitle or application/octdec-stream", 1);

		if( file_exists( $target_file_name ) ) {

		    //Get file type and set it as Content Type
		    header('Content-Type: application/octet-stream');

		    //Use Content-Disposition: attachment to specify the filename
		    header('Content-Disposition: attachment; filename='.basename($target_file));

		    //No cache
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');

		    //Define file size
		    header('Content-Length: ' . filesize($target_file_name));

		    ob_clean();
		    flush();
		    readfile($target_file_name);
		    exit;
		}

	}
}

function generate_random_file_name() {
	$random_name = get_random_name();

	return ( file_exists( 'uploaded_subtitles/' . $random_name ) ) ? $random_name = get_random_name() . '.srt' : $random_name . '.srt';
}

function get_random_name() {
	return bin2hex(openssl_random_pseudo_bytes(10 / 2));
}