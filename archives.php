<?php include 'mainContent/head.php' ?>
<?php include 'core/init.php' ?>
<?php ?>
<link href="assets/css/customized.css" rel="stylesheet" media="screen">
<link href="assets/css/resources.css" rel="stylesheet" media="screen">
<link href="assets/css/ihover.css" rel="stylesheet" media="screen">

<?php include 'mainContent/header.php' ?>
<div class="pageheading">
	<div class="pagelogo">
		<img src="assets/images/administration1.png">
	</div>
	<div class="headingofpage">
		<h1> Archives </h1>
	</div>
</div>
<?php

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
				ORDER BY bk.id DESC LIMIT 8
					");
		$copies = mysqli_query($connection,"SELECT DISTINCT COUNT(copies.book_id) FROM copies INNER JOIN books ON copies.book_id=books.id
			");
		$dup = mysqli_query($connection,"SELECT book_id, COUNT(*) as count FROM copies GROUP BY book_id");
		$rows_copies = mysqli_fetch_array($copies);
		$rows = mysqli_fetch_assoc($rs);
		$tot_rows = mysqli_num_rows($rs);
 ?>
<div class="content">
	<div class="libraryinfo">
		<!-- new arrivals -->
		<section class="spotlight animatedParent" data-appear-top-offset='-30' data-sequence='500'>
		   <h3 class="section-title"><i class="fa fa-diamond animatedbounceIn"></i> Latest Entries</h3>
		<div class="row">
		 <div class="jumbo">
		       <?php if($tot_rows > 0){  ?>
		       <?php do { ?>
		           <div class="col-md-3 animatedbounceIn">
		               <span class="product-image">

		                   <?php $isbnget = $rows['ISBN'];  ?>
		                  <a href="bookview.php?bookisbn=<?php echo $isbnget;  ?>"><img src="<?php echo $rows['Cover'] ?>" class="img-thumbnail product-img" alt=""></a>
		                </span>
		                   <ul class="iteminfo">
		                        <li class="animated fadeInLeftShort" data-id='1'><strong>Title: </strong><?php echo $rows['Title'] ?></li>
		                        <li class="animated fadeInLeftShort" data-id='1'><strong>Category: </strong><?php echo $rows['Category'] ?></li>
		                        <li class="animated fadeInLeftShort" data-id='2'><strong>Author: </strong><?php echo $rows['Author'] ?></li>
		                        <li class="animated fadeInLeftShort" data-id='3'><strong>ISBN: </strong><?php echo $rows['ISBN'] ?></li>
		                        <li class="animated fadeInLeftShort" data-id='3'><strong>Copies: </strong><?php echo $rows['Copies'] ?></li>
		                  </ul>
		            </div>
		        <?php } while($rows=mysqli_fetch_assoc($rs)); }else{ ?>
		        <?php echo 'No Results'; }?>
		       </div>
		       <?php include 'books/popup.php' ?>
		</section>
		<!-- new arrivals-->

<?php

$getdup = mysqli_query($connection, "SELECT count(*) AS duplicate_count
FROM (
 SELECT ul.copy_id AS CopyID, cp.book_id AS ID FROM user_lends_copies ul
 JOIN ON cp.id = ul.copy_id
 GROUP BY  HAVING COUNT(CopyID) > 1
) AS t ")

$rs1 = mysqli_query($connection,"SELECT DISTINCT bk.title As Title, YEAR(bk.date_released) AS Year, bk.price AS Price, cat.name AS Category, pub.name AS Publisher, aut.name AS Author,co.name AS Cover, cp.count AS Copies,bk.isbn AS ISBN
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
				ORDER BY bk.id DESC LIMIT 8
					");
		$copies1 = mysqli_query($connection,"SELECT DISTINCT COUNT(copies.book_id) FROM copies INNER JOIN books ON copies.book_id=books.id
			");
		$dup1 = mysqli_query($connection,"SELECT book_id, COUNT(*) as count FROM copies GROUP BY book_id");
		$rows_copies1 = mysqli_fetch_array($copies1);
		$rows1 = mysqli_fetch_assoc($rs1);
		$tot_rows1 = mysqli_num_rows($rs1);
 ?>

	



		<!-- most popular -->
		<section class="spotlight animatedParent" data-appear-top-offset='-30' data-sequence='500'>
		   <h3 class="section-title"><i class="fa fa-diamond animatedbounceIn"></i> Most Popular Books</h3>
		<div class="row">
		 <div class="jumbo">
		       <?php if($tot_rows1 > 0){  ?>
		       <?php do { ?>
		           <div class="col-md-3 animatedbounceIn">
		               <span class="product-image">
		               <?php $isbnget = $rows1['ISBN'];  ?>
		                  <a href="bookview.php?bookisbn=<?php echo $isbnget;  ?>" id="bookid"><img src="<?php echo $rows['Cover'] ?>" class="img-thumbnail product-img" alt=""></a>
		                </span>
		                   <ul class="iteminfo">
		                        <li class="animated fadeInLeftShort" data-id='1'><strong>Title: </strong><?php echo $rows1['Title'] ?></li>
		                        <li class="animated fadeInLeftShort" data-id='1'><strong>Category: </strong><?php echo $rows1['Category'] ?></li>
		                        <li class="animated fadeInLeftShort" data-id='2'><strong>Author: </strong><?php echo $rows1['Author'] ?></li>
		                        <li class="animated fadeInLeftShort" data-id='2'><strong>Price: </strong><?php echo $rows1['Price'] ?></li>
		                        <li class="animated fadeInLeftShort" data-id='3'><strong>ISBN: </strong><?php echo $rows1['ISBN'] ?></li>
		                        <li class="animated fadeInLeftShort" data-id='3'><strong>Copies: </strong><?php echo $rows1['Copies'] ?></li>
		                  </ul>
		            </div>
		        <?php } while($rows1=mysqli_fetch_assoc($rs1)); }else{ ?>
		        <?php echo 'No Results'; }?>
		       </div>
		</section>

		<!-- most popular -->
	</div>
<!-- most active users -->
	<div class="libraryinfo">
		<div class="row">
			<h3 class="heading2 memtitle">Top 3 Members this Month</h3>
			<div class="col-md-4 officials">
				<div class="memberimage2">
				<div class="pictp">
									<span class="profilepic"><img src="assets/images/profile1.jpg" class="img-circle" width="100px" height="100px"></span>
							</div>
							<h4>Malinga Prabath</h4>
							<p>21 Borrows</p>
						</div>
			</div>
			<div class="col-md-4">
				<div class="memberimage2">
				<div class="pictp">
									<span class="profilepic"><img src="assets/images/profile1.jpg" class="img-circle" width="100px" height="100px"></span>
							</div>
							<h4>Chanaka Silva</h4>
							<p>10 Borrows</p>
						</div>
			</div>
			<div class="col-md-4">
				<div class="memberimage2">
				<div class="pictp">
									<span class="profilepic"><img src="assets/images/profile1.jpg" class="img-circle" width="100px" height="100px"></span>
							</div>
							<h4>Thilanka Ranasinghe</h4>
							<p>9 Borrows</p>
						</div>
			</div>
		</div>
	</div>
	<!-- most active users-->
</div>
<?php include 'mainContent/footer.php' ?>
<script src="assets/js/css3-animate-it.js"></script>
