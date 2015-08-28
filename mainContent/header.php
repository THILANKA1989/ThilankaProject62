<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">T M M L</a>
    </div>
    <div class="navbar-collapse collapse animatedParent">
        <ul class="nav navbar-nav animated bounceIn">
            <li id="inactive"><a href="index.php">Home</a></li>
           <?php 
           if (isset($_SESSION['username'])){
           ?> <li id="inactive"><a href="services.php">Library Services</a></li><?php } ?>
            <li id="inactive"><a href="resources.php">Resources</a></li>
            <li id="inactive"><a href="archives.php">Archives</a></li>
            <?php
             if (isset($_SESSION['username'])){
            ?><li id="inactive"><a href="forum.php">Forum for Youth</a></li><?php } ?>
            <li id="inactive"><a href="playground.php">Play for Children</a></li>
            <li id="inactive"><a href="aboutus.php">About Us</a></li>
            <li id="inactive" class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Social <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="http://www.facebook.com">Facebook</a></li>
                    <li><a href="http://www.twitter.com">Twitter</a></li>
                    <li><a href="https://plus.google.com">Google+</a></li>
                    <li><a href="http://www.linkedin.com">LinkedIn</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-right animated bounceIn">
            <?php if(isset($_SESSION['username'])){ ?>
                <li class="rightcontact"><a href="logout.php">Logout</a></li>
            <?php }else{ ?>
                <li class="rightcontact"><a href="home.php">Login/Signup</a></li>
            <?php } ?>
            <li id="inactive" class="rightdonate"><a href="hasangasena.php">Donate Us</a></li>
        </ul>
    </div>
</nav>
<!-- End Navigation -->
<!-- scripts -->
<script>
  var inactivelink = document.getElementById('inactive');
  var activelink = document.getElementById('active');
  inactivelink.onclick = function(){
    activelink.id= 'innactive';
    $('this').id = 'active';
  }
</script>
<!-- scripts -->
