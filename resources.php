<?php include 'mainContent/head.php' ?>
<?php include 'core/init.php' ?>
<link href="assets/css/customized.css" rel="stylesheet" media="screen">
<link href="assets/css/resources.css" rel="stylesheet" media="screen">
<link href="assets/css/ihover.css" rel="stylesheet" media="screen">

<?php include 'mainContent/header.php' ?>
<div class="pageheading">
	<div class="pagelogo">
		<img src="assets/images/living1.png">
	</div>
	<div class="headingofpage">
		<h1> Resources </h1>
	</div>
</div>
<div class="content">
  <?php include 'mainContent/titlebar.php' ?>
  <div class="body_contents">

  <!-- Left to right-->
<div class="row libraryinfo animatedParent" data-appear-top-offset="-30">
 <div class="resources">
  <div class="col-sm-4 animated bounceInDown">

    <!-- colored -->
    <div class="ih-item circle colored effect3 left_to_right"><a href="#resources" class="bookfetch">
        <div class="img"><img src="assets/images/books.jpg" alt="img"></div>
        <div class="info">
          <h3>Books</h3>
          <p>See all books in library in ascending order</p>
        </div></a></div>
    <!-- end colored -->

  </div>
  <div class="col-sm-4 animated bounceInDown">

    <!-- normal -->
    <div class="ih-item circle effect3 left_to_right"><a href="#resources" class="mag">
        <div class="img"><img src="assets/images/mag.jpg" alt="img"></div>
        <div class="info">
          <h3>Magazines</h3>
          <p>See the types of all magazines</p>
        </div></a></div>
    <!-- end normal -->

  </div>
  <div class="col-sm-4 animated bounceInDown">

    <!-- colored -->
    <div class="ih-item circle colored effect3 left_to_right"><a href="#resources" class="fetchnews">
        <div class="img"><img src="assets/images/5.jpg" alt="img"></div>
        <div class="info">
          <h3>News Papers</h3>
          <p>See the all newspapers providing by the library</p>
        </div></a></div>
    <!-- end colored -->

  </div>
  </div>
</div>
<!-- end Left to right-->
  	<!-- start of lower notice section -->
	<div class="row libraryinfo noticesection animatedParent" data-appear-top-offset='-30' data-sequence='500'>
		<h4 class="animated bounceInUp" data-id='1'>Notice for all Library users</h4>
		<ul>
			<li class='animated bounceInDown' data-id='1'>Users Must be Silence inside the library</li>
			<li class='animated bounceInDown' data-id='2'>Magazines and Newspapers are not allowed to bring outside</li>
			<li class='animated bounceInDown' data-id='3'>Please Do not damage any book, magazine or Newspaper</li>
			<li class='animated bounceInDown' data-id='4'>You can only borrow 2 books maximum at a time</li>
			<li class='animated bounceInDown' data-id='5'>Pay all penalty need to be paid and avoid being penalized by handover book before the due date</li>
      <li class='animated bounceInDown' data-id='5'>Check your online account often to avoid such incidents</li>
		</ul>
	</div>
<!-- end of lower notice section -->
  </div>

 </div>

 <script>
$(document).ready(function(){
    $(".fetchnews").click(function(){
        $(".resources").load("newspapers/newspapers.php");
    });

    $(".mag").click(function(){
        $(".resources").load("magazines/magazines.php");
    });

    $(".bookfetch").click(function(){
        $(".resources").load("books/bookscat.php");
    });
});
</script>
<?php include 'mainContent/footer.php' ?>
<?php include 'mainContent/scripts.php' ?>
