<?php include 'mainContent/head.php';
include 'core/init.php';
 ?>
<link href="assets/css/customized.css" rel="stylesheet" media="screen">
<?php
    if(isset($_SESSION['username'])){
        header('location: index.php');
    }else{
?>
<body>
	<div class="homepage">
		<img src="assets/images/books.jpg" width="100%" height="100%" class="backimage">
		<div class="title animatedParent">
			<h1 class="heading2">Welcome!</h1>
			<p class="caption">This is the official website for Hasangasena Youth Club and TMM Library</p>
			<div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">                                
                                <div class="row-fluid user-row">
                                    <img src="assets/images/logo.png" width="50%" height="50%" class="img-responsive" alt="Conxole Admin"/>
                                </div>
                            </div>
                            <div class="panel-body">
                                <form accept-charset="UTF-8" method="post" role="form" id="formLogin" class="form-signin" action="login.php">
                                    <fieldset>
                                        <label class="panel-login">
                                            <div class="login_result"></div>
                                        </label>
                                        <input class="form-control" placeholder="Username" name="username" id="username" type="text">
                                        <input class="form-control" name="password" placeholder="Password" id="password" type="password">
                                        <span id="errMessage" style="color: #f00;"></span><br></br>
                                        <input class="btn btn-lg btn-success btn-block" type="submit" id="submit" value="Login »">
                                    </fieldset>
                                </form>
                                <a href="register.php">Or register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<!-- end login form -->
</body>
<?php } ?>
<?php include 'assets/js/login.js'?>