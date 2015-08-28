<?php include 'mainContent/head.php' ?>
<?php include 'core/init.php' ?>
<link href="assets/css/customized.css" rel="stylesheet" media="screen">
<link href="assets/css/resources.css" rel="stylesheet" media="screen">
<link href="assets/css/ihover.css" rel="stylesheet" media="screen">

<?php include 'mainContent/header.php' ?>
<div class="pageheading">
	<div class="pagelogo">
		<img src="assets/images/Game.png">
	</div>
	<div class="headingofpage">
		<h1> Boring? Play Games! </h1>
	</div>
</div>

<div class="content">
  <div class="body_contents">
<!-- game area -->
<div class="row libraryinfo">
<div class="resources">
	<div class="card">
		<div class="col-md-4">
		<div class="cardslot">
			<img src="assets/images/games/duskdrive.jpg">
			<h4 class="blue">Dusk Drive</h4>
			<a href="#my_modal" class="playlink" data-toggle="modal"><span class="small">Play Now</span>&nbsp;&nbsp;&nbsp;<i class="fa fa-play"></i><br/></a>
		</div>
		</div>

		<div class="col-md-4">
		<div class="cardslot">
			<img src="assets/images/games/rollerrider.jpg">
			<h4 class="blue">Roller Rider</h4>
			<a href="#my_modal" class="playlink" data-toggle="modal"><span class="small">Play Now</span>&nbsp;&nbsp;&nbsp;<i class="fa fa-play"></i><br/></a>
		</div>
		</div>

		<div class="col-md-4">
		<div class="cardslot">
			<img src="assets/images/games/the-last-dinosaurs.jpg">
			<h4 class="blue">The Last Dinosaurs</h4>
			<a href="#my_modal" class="playlink" data-toggle="modal"><span class="small">Play Now</span>&nbsp;&nbsp;&nbsp;<i class="fa fa-play"></i><br/></a>
		</div>
		</div>

		<div class="col-md-4">
		<div class="cardslot">
			<img src="assets/images/games/sticky-ninja-missions.jpg">
			<h4 class="blue">Sticky Ninja Missions</h4>
			<a href="#my_modal" class="playlink" data-toggle="modal" data-id="stickyninja"><span class="small">Play Now</span>&nbsp;&nbsp;&nbsp;<i class="fa fa-play"></i><br/></a>
		</div>
		</div>

</div>
	</div>
</div>

</div>
</div>
<script>
	$('#my_modal').on('show.bs.modal', function(e) {
    var gameId = $(e.relatedTarget).data('book-id');
    $(e.currentTarget).find('input[name="bookId"]').val(bookId);
});
</script>

<?php include 'mainContent/footer.php' ?>
<?php include 'games/popupgames.php' ?>
