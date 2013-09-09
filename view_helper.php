<?php

function output_view_file($view_file_path, $view_parameters = NULL)
{
	ob_start();

	include($view_file_path);

	$content = ob_get_clean();

	echo $content;
}

?>