<?php include 'mainContent/head.php' ?>
<?php include 'core/init.php' ?>
<link href="assets/css/customized.css" rel="stylesheet" media="screen">
<link href="assets/css/resources.css" rel="stylesheet" media="screen">
<link href="assets/css/ihover.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> <!-- load bootstrap via CDN -->

  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> <!-- load jquery via CDN -->
<?php include 'mainContent/header.php' ?>
<div class="pageheading">
	<div class="pagelogo">
		<img src="assets/images/forum.png">
	</div>
	<div class="headingofpage">
		<h1> Forum </h1>
	</div>
</div>
<div class="content">

<!-- post forum -->
<div class="container">
  <div class="row userpost">
    <form method="post" role="form" id="forumform" class="forum" row="3" action="process/addforumpost.php">
                    <div class="row">
                    
                      <div class="col-md-12">
                      <div class="form-group">
                            <textarea class="form-control textarea" rows="3" name="forum" id="forum" placeholder="Post your Idea"></textarea>
                      </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <span id="errMessage"></span>
                      <button type="submit" name="submit" id="submit" class="btn main-btn pull-right">Post</button>
                  </div>
                  </div>
                </form>
  </div>
</div>
<!-- post forum -->

<!--forum-->
    <div class="row posts">
<?php
$query = "SELECT DISTINCT pc.profilepic As Picture, us.username As Username, pst.date_added As Date, pst.post As Post FROM posts pst JOIN picture pc ON pc.user_id = pst.user_id JOIN user us ON us.id = pst.user_id ORDER BY pst.date_added DESC";
$showq = mysqli_query($connection,$query);
$rows = mysqli_fetch_assoc($showq);
$numrows = mysqli_num_rows($showq);
$posted_time = $rows['Date'];
$count=0;
$dt = time();
$datetime = strftime("%Y-%m-%d %H:%M:%S", $dt);

?>
<?php if($numrows > 0){  ?>
    <?php do { ?>
     <div class="container">
           <div class="row  userpost">
            <div class="col-md-2 pictp">
                <span class="profilepic"><img src="<?php echo $rows['Picture']; ?>" class="img-circle" width="100px" height="100px"></span>
            </div>
            <div class="col-md-10">
                <p><?php echo $rows['Username']; ?></p>
               <span><p> <?php echo $rows['Post']; ?></p></span>
            </div>
            <div class="timeposted pull-right  posted"><?php echo $rows['Date']; ?></div>
          </div>
        </div>
<?php } while($rows=mysqli_fetch_assoc($showq)); }else{ ?>
        <?php echo 'No Posts'; }?>
    </div>
<!--forum-->


</div>
<?php include 'mainContent/footer.php'; ?>
<?php include 'mainContent/scripts.php'; ?>

<script>
  $(document).ready(function() {

    // process the form
    $('form.forum').submit(function(event) {

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'forum'              : $('input[name=forum]').val(),
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'process/addforumpost.php', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
                        encode          : true
        })
            // using the done promise callback
            .done(function(data) {

                // log data to the console so we can see
                console.log(data); 

                        if ( ! data.success) {
          
          // handle errors for name ---------------
          if (data.errors.forum) {
            $('#name-group').addClass('has-error'); // add the error class to show red input
            $('#errMessage').append('<div class="help-block">' + data.errors.forum + '</div>'); // add the actual error message under our input
          }
        } else {

          // ALL GOOD! just show the success message!
          $('#errMessage').append('<div class="alert alert-success">' + data.message + '</div>');

          // usually after form submission, you'll want to redirect
          // window.location = '/thank-you'; // redirect a user to another page

        }
      })

      // using the fail promise callback
      .fail(function(data) {

        // show any errors
        // best to remove for production
        console.log(data);
      });
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
});

</script>
