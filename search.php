<?php include 'core/init.php' ?>

<?php
if(isset($_POST['submit'])){
	$searchq= $_POST['searchq'];
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

if($searchq == ""){
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
}else if( !preg_match('/[^A-Za-z0-9]/', $searchq)){
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
				WHERE bk.title LIKE '%$searchq%' OR aut.name LIKE '%$searchq%' OR cat.name LIKE '%$searchq%' OR pub.name = '%$searchq%'
				ORDER BY bk.title ASC
					");
		$copies = mysqli_query($connection,"SELECT DISTINCT COUNT(copies.book_id) FROM copies INNER JOIN books ON copies.book_id=books.id
			");
		$dup = mysqli_query($connection,"SELECT book_id, COUNT(*) as count FROM copies GROUP BY book_id");
		$rows_copies = mysqli_fetch_array($copies);
		$rows = mysqli_fetch_assoc($rs);
		$tot_rows = mysqli_num_rows($rs);
}else if(preg_match('/[A-Z]+[a-z]+[0-9]+/', $searchq)){
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
				WHERE bk.isbn LIKE '%$searchq%'
				ORDER BY bk.title ASC
					");
		$copies = mysqli_query($connection,"SELECT DISTINCT COUNT(copies.book_id) FROM copies INNER JOIN books ON copies.book_id=books.id
			");
		$dup = mysqli_query($connection,"SELECT book_id, COUNT(*) as count FROM copies GROUP BY book_id");
		$rows_copies = mysqli_fetch_array($copies);
		$rows = mysqli_fetch_assoc($rs);
		$tot_rows = mysqli_num_rows($rs);
}else{
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
				ORDER BY bk.title ASC
					");
		$copies = mysqli_query($connection,"SELECT DISTINCT COUNT(copies.book_id) FROM copies INNER JOIN books ON copies.book_id=books.id
			");
		$dup = mysqli_query($connection,"SELECT book_id, COUNT(*) as count FROM copies GROUP BY book_id");
		$rows_copies = mysqli_fetch_array($copies);
		$rows = mysqli_fetch_assoc($rs);
		$tot_rows = mysqli_num_rows($rs);
}	

print_r($rs);



?>
<?php include 'mainContent/head.php' ?>
<link href="assets/css/customized.css" rel="stylesheet" media="screen">
<link href="assets/css/search.css" rel="stylesheet" media="screen">
<?php include 'mainContent/header.php' ?>


<div class="content">
  <div class="body_contents">
  	<div id="out">

  		<div id="hd"></div>
  		<div id="cnt">

        <div class="container jumbotron board">
		 <form action="search.php" method="get" name='search_for' class="form-horizontal">
		  <div class="form-group">
		    <p for="name" class="col-sm-2 control-label">Title</p>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="title" placeholder="enter member/book">
		    </div>
		  </div>
		  <div class="form-group">
		    <p for="author" class="col-sm-2 control-label">Author</p>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="author" placeholder="Enter author">
		    </div>
		  </div>
		  <div class="form-group">
		    <p class="col-sm-2 control-label">ISBN</p>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="isbn" placeholder="Enter ISBN">
		    </div>
		  </div>
		  <div class="form-group">
		    <p class="col-sm-2 control-label">Publisher</p>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="publisher" placeholder="Enter name of the publisher">
		    </div>
		  </div>
		  <div class="form-group">
		    <p for="year" class="col-sm-2 control-label">Published Year</p>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="year" placeholder="Enter the published year">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		     <?php $result = mysqli_query($connection,"SELECT name FROM `category`"); ?>
  						<select class="form-control" name="category">
  							<option vlaue="nil"><i>select category</i></option>
  							<?php while ($row=mysqli_fetch_array($result)){
  							$value = $row['name']; ?>
   							<?php echo "<option value='$value'>" ?><i><?php echo $row['name'] ?></i><?php echo "</option>" ?>
  							<?php
  							 }  ?>
						</select>
		    </div>
		  </div>
		  <div class="form-group">
		   <div class="col-sm-offset-2 col-sm-10">
		     <?php $result = mysqli_query($connection,"SELECT name FROM `languages`"); ?>
  						<select class="form-control" name="language">
  							<option value="nil"><i>select language</i></option>
  							<?php while ($row=mysqli_fetch_array($result)){
  							$value = $row['name']; ?>
   							<?php echo "<option value='$value'>" ?><i><?php echo $row['name'] ?></i><?php echo "</option>" ?>
  							<?php
  							 }  ?>
						</select>
		    </div>
		    </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" name="submitq" class="btn btn-info">Search</button>
		    </div>
		  </div>
		</form>
		</div>


  		</div>
  	</div>
  </div>

  <section class="searchresults spotlight">
   <h3 class="section-title" id="section_title"><i class="fa fa-lightbulb-o"></i> Search Results</h3>
   <div class="row">
       <div class="jumbo">
       <?php if($tot_rows > 0){  ?>
       <?php do { ?>
           <div class="col-md-3">
               <span class="product-image">

                    <a href="bookview.php?bookisbn=<?php echo $rows['ISBN']?>"><img src="<?php echo $rows['Cover'] ?>" class="img-thumbnail product-img" alt=""></a>
                </span>
                   <ul class="iteminfo">
                        <li><strong>Title: </strong><?php echo $rows['Title'] ?></li>
                        <li><strong>Category: </strong><?php echo $rows['Category'] ?></li>
                        <li><strong>Author: </strong><?php echo $rows['Author'] ?></li>
                        <li><strong>Price: </strong><?php echo $rows['Price']." Rs" ?></li>
                        <li><strong>Publisher: </strong><?php echo $rows['Publisher'] ?></li>
                        <li><strong>Copies: </strong><?php echo $rows['Copies'] ?></li>
                	</ul>
           	</div>
        <?php } while($rows=mysqli_fetch_assoc($rs)); }else{ ?>
        <?php echo 'No Results'; }?>
       </div>
   </div>
</section>
 </div>

<?php include 'mainContent/footer.php' ?>
<?php include 'mainContent/scripts.php' ?>
