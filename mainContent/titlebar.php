
<?php
if(isset($_SESSION['username'])){
  $user = $_SESSION['username'];

  $userget = mysqli_query($connection,"SELECT firstname,lastname FROM user WHERE username = '$user'");
  $row = mysqli_fetch_assoc($userget);
}
?>

<div class="titlebar">
    <div class="row">
        <div class="col-md-5 class="titlelogo"">
          <h4 class="titlebar-title">Hasangasena</h4>

        </div>
        <div class="col-md-6">
        					<form class="form-inline inlinebox" action="search.php#section_title" method="post">
  								<div class="form-group has-feedback">
            		<label for="search" class="sr-only">Search</label>
            		<input type="text" class="form-control" name="searchq" id="search" placeholder="search">
              		<span class="glyphicon glyphicon-search form-control-feedback"></span>
                <button type="submit" class="btn btn-success dashaddnews  searchbtn" id="submit" name="submit" >Search</button>
            	</div>
							</form><i>  or</i>
		</div>
    <div class="col-md-1 pull-left">	<a href="search.php" class="adv_search">Advanced Search</a></div>
    	</div>
  </div>
