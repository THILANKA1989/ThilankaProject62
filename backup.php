<?php
if(isset($_GET['submit'])){
	$searchq= $_GET['searchq'];
}else{
	$searchq="";
}

if(isset($_GET['submitq'])){
	$titles = $_GET['title'];
	$auts = $_GET['author'];
	$isbns = $_GET['isbn'];
	$pubs = $_GET['publisher'];
	$cats = $_GET['category'];
	$langs = $_GET['language'];
}else{
	$titles = "";
	$auts = ""; 
	$isbns = "";
	$pubs = "";
	$cats = "";
	$langs = "";
}

$rs = mysqli_query($connection,"SELECT DISTINCT bk.title As Title, YEAR(bk.date_released) AS Year, bk.price AS Price, cat.name AS Category, pub.name AS Publisher, aut.name AS Author,co.name AS Cover, cp.count AS Copies,bk.isbn AS ISBN
				FROM books bk
                JOIN (SELECT book_id, COUNT(*) as count FROM copies GROUP BY book_id) cp
                	ON bk.id = cp.book_id
				JOIN category cat
					ON cat.id = bk.category_id
				JOIN publishers pub
                	ON pub.id = bk.publisher_id
				JOIN books_covers bk_co
					ON bk_co.book_id = bk.id
				JOIN covers co
					ON co.id = bk_co.cover_id
				JOIN books_authors bk_aut
					ON bk_aut.book_id = bk.id
				JOIN authors aut
					ON aut.id = bk_aut.author_id
				JOIN books_languages bk_lan
					ON bk_lan.book_id = bk.id
				JOIN languages lan
					ON lan.id = bk_lan.lang_id
				JOIN books_locations bk_loc
					ON bk_loc.book_id = bk.id
				JOIN locations loc
					ON loc.id = bk_loc.location_id
				
					");
		$copies = mysqli_query($connection,"SELECT DISTINCT COUNT(copies.book_id) FROM copies INNER JOIN books ON copies.book_id=books.id
			");
		$dup = mysqli_query($connection,"SELECT book_id, COUNT(*) as count FROM copies GROUP BY book_id");
		$rows_copies = mysqli_fetch_array($copies);
		$rows = mysqli_fetch_assoc($rs);
		$tot_rows = mysqli_num_rows($rs);




if(isset($_GET['submitq'])){
	$isbns = array();
	$getters = array();
	$queries = array();

	foreach($_GET as $key => $value){
		$temp = is_array($value) ? $value : trim($value);
		if(!empty($temp)){
			list($key) = explode("-", $key);
			if($key == 'isbn'){
				array_push($isbns,$value);
			}
			if(!in_array($key,$getters)){
				$getters['$key'] = $value;
			}
		}
	}

	if(!empty($isbns)){
		$isbnq = implode(",",$isbns);
	}

	if(!empty($getters)){
		foreach($getters as $key => $value){
			switch($key){
				case 'searchq':
				array_push($queries,"(bk.title LIKE '%$searchq%' || bk.isbn LIKE '%$searchq%')");
				break;
				case 'category':
				array_push($queries,"bk.category = $cats");
				break;
				case 'author':
				array_push($queries,"bk_aut.author_id = $auts");
				break;
				case 'langauge':
				array_push($queries,"bk_lan.lang_id = $langs");
				break;
				case 'publisher':
				array_push($queries,"bk.publisher_id = $pubs");
				break;
				case 'langauge':
				array_push($queries,"bk_lan.lang_id = $langs");
				break;
			}
		}
	}

	if(!empty($queries)){
		$rs .= " WHERE ";
		$i = 1;
		foreach($queries as $query){
			if($i < count($queries)){
				$rs .= $query." AND ";
			}else{
				$rs .= $query;
			}
			$i++;
		}
	}


}



?>