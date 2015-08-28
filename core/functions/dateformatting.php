<?php
	$timestamp = time();

	function strip_zeros($marked_string=""){
		$nozeros = str_replace('*0','',$marked_string);
		$cleaned_string = str_replace('*','',$nozeros);
		return $cleaned_string;
	}

	function strip_slash($dateofrel=""){
		$noslash = str_replace('/','-',$dateofrel);
		return $noslash;
	}
	//echo strip_zeros(strftime(*%m/*%d/%/y, $timestamp));

	$dt = time();
	$mysql_datetime = strftime("%Y-%m-%d %H:%M:%S", $dt);
?>