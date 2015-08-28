<?php



function datecheck($date1,$date2){
	if($date1 >= $date2 ){
		return $view=1;
	}else{
		return $view=0;
	}
}

function checkweek($date1,$date2){
	if($date1 >= $date2){
		return (int)$view = 1;
	}else{
		return (int)$view= 0;
	}
}

?>