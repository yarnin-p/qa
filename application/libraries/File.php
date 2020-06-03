<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File {
	protected $CI;

	public function __construct() {
		//Set Iinstance
		$this->CI =& get_instance();

	}

	public function filePath($filename, $folder_name = '') {
		if( empty( $folder_name ) )
			$folder_name = $this->CI->function_name;

		$dir_path = PATH_UPLOADS.$folder_name;
		
		// Check if directory not found. create it.
		if( !file_exists($dir_path) )
			mkdir($dir_path);

		$file_path = $dir_path.'/'.$filename;
		if( empty($filename) || !file_exists( $file_path ) )
			return PATH_UPLOADS.'no-image.png';

		return $file_path;
	}

	public function folderValidate(){
		$folder_name = $this->CI->function_name;

		$dir_path = PATH_UPLOADS.$folder_name;
		
		// Check if directory not found. create it.
		if( !file_exists($dir_path) )
			mkdir($dir_path);
	}

}