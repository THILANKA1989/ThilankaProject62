<?php include 'core/init.php' ?>
<!doctype html>
<html lang="en">
<?php include 'mainContent/head.php' ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700,400,600' rel='stylesheet' type='text/css'>
<link href="assets/css/customized.css" rel="stylesheet" media="screen">
<body>
<?php
$catid = $_GET['catid'];
echo $catid;
$selectcat = mysqli_query($connection,"SELECT id FROM category WHERE name='$catid'");
$catidf = mysqli_fetch_assoc($selectcat);
$allcat = mysqli_query($connection,"SELECT DISTINCT bk.title As Title, YEAR(bk.date_released) AS Year, bk.price AS Price, cat.name AS Category, pub.name AS Publisher, aut.name AS Author,co.name AS Cover, cp.count AS Copies,bk.isbn AS ISBN
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
				WHERE cat.id = '$catidf[id]'
				ORDER BY bk.id 
					");
		$copies = mysqli_query($connection,"SELECT DISTINCT COUNT(copies.book_id) FROM copies INNER JOIN books ON copies.book_id=books.id
			");
		$dup = mysqli_query($connection,"SELECT book_id, COUNT(*) as count FROM copies GROUP BY book_id");
		$rows_copies = mysqli_fetch_array($copies);
		$rows = mysqli_fetch_assoc($allcat);
		$tot_rows = mysqli_num_rows($allcat);
?>

<?php include 'mainContent/header.php' ?>
<div class="content">

<section class="spotlight animatedParent" data-appear-top-offset='-30' data-sequence='500'>
   <h3 class="section-title"><i class="fa fa-diamond animatedbounceIn"></i>All Books from <?php echo $catid;?></h3>
   <div class="row">
 <div class="jumbo">

       <?php if($tot_rows > 0){  ?>
       <?php do { ?>

           <div class="col-md-3 animatedbounceIn">
               <span class="product-image">
                  <?php $isbnget = $rows['ISBN']; ?>
                   <a href="bookview.php?bookisbn=<?php echo $isbnget;  ?>" id="bookid"><img src="<?php echo $rows['Cover'] ?>" class="img-thumbnail product-img" alt=""></a>
                </span>
                   <ul class="iteminfo">
                        <li class="animated fadeInLeftShort" data-id='1'><strong>Title: </strong><?php echo $rows['Title'] ?></li>
                        <li class="animated fadeInLeftShort" data-id='1'><strong>Category: </strong><?php echo $rows['Category'] ?></li>
                        <li class="animated fadeInLeftShort" data-id='2'><strong>Author: </strong><a href="authorview.php?authorname=<?php echo $rows['Author']; ?>"><?php echo $rows['Author']; ?></a></li>
                        <li class="animated fadeInLeftShort" data-id='3'><strong>ISBN: </strong><?php echo $rows['ISBN'] ?></li>
                        <li class="animated fadeInLeftShort" data-id='3'><strong>Copies: </strong><?php echo $rows['Copies'] ?></li>
                  </ul>
            </div>
         
        <?php } while($rows=mysqli_fetch_assoc($allcat)); }else{ ?>
        <?php echo 'No Results'; }?>
       </div>
        
</section>




</div>

<?php include '/mainContent/footer.php';?>

<?php include '/mainContent/scripts.php' ?>


 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="/assets/js/css3-animate-it.js"></script>
<script src="assets/js/css3-animate-it.js"></script>
</html>