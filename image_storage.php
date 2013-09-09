<?php

class ImageStorage
{
	private $m_directory;
	private $m_prefix;

	function __construct ($directory, $prefix)
	{
		$this->m_directory = $directory;
		$this->m_prefix = $prefix;
	}

	public function store($image_path, $move_function = NULL) 
	{
		$uniq_image_path = tempnam($this->m_directory, $this->m_prefix);
		if($uniq_image_path == FALSE)
		{
			throw new Exception("tempnam() failed.");
		}

		$success = false;

		if($move_function == NULL)
		{
			$success = rename( $image_path, $uniq_image_path);
			if($success == FALSE)
			{
				throw new Exception("rename function() failed. [$image_path][$uniq_image_path]");
			}			
		}
		else
		{
			$success = $move_function( $image_path, $uniq_image_path);
			if($success == FALSE)
			{
				throw new Exception("move function() failed. [$image_path][$uniq_image_path]");
			}			
		}


		return $uniq_image_path;
	}

	public function files() 
	{
		$pattern = "$this->m_directory/$this->m_prefix*";
		return glob($pattern);
	}

	public function clear()
	{
		$files = $this->files();
		foreach( $files as $file ) 
		{
			unlink($file);
		}
	}
}

?>