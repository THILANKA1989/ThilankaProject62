<?php
	$timestamp = time();

	function strip_zeros($marked_string=""){
		$nozeros = str_replace('*0','',$marked_string);
		$cleaned_string = str_replace('*','',$nozeros);
		return $cleaned_string;
	}

	function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' ){
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    
    $interval = date_diff($datetime1, $datetime2);
    
    return $interval->format($differenceFormat);
    
}
	//echo strip_zeros(strftime(*%m/*%d/%/y, $timestamp));
?>