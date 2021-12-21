<?php
    function form_error($file){
		global $error;
		if(!empty($error[$file])) return $error[$file];
	}
?>