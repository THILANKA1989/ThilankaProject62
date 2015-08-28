<script>
$(document).on("click", ".bookget", function (){
    $.get('index.php',{'bookisbn': $(this).data('id')}, function(){
  });
});
</script>

  <?php
  $isbn = $_GET['bookisbn'];
  include 'functions.php'
  ?>
<div class="modal popupbook" id="my_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title"><?php echo $sqlbookrows['Title'] ?></h4>
      </div>
      <div class="modal-body">

       		<div class="row">
               <div class="col-md-4">
               	<span class="product-image">
               	 <img src="<?php echo $sqlbookrows['Cover'] ?>" class="img-thumbnail product-img" alt="">
               	 </span>
               	</div>
               <div class="col-md-4">
                 <div>
                     <ul class="iteminfo" style="zoom: 1.3;">
                          <li><strong>Description: </strong><p><?php  echo $sqlbookrows['Description'] ?></p></li>
                          <li><strong>Title: </strong><?php echo $sqlbookrows['Title'] ?></li>
                          <li><strong>Category: </strong><?php echo $sqlbookrows['Category'] ?></li>
                          <li><strong>Author: </strong><?php echo $sqlbookrows['Author'] ?></li>
                          <li><strong>Price: </strong><?php echo $sqlbookrows['Price'] ?></li>
                          <li><strong>Publisher: </strong><?php echo $sqlbookrows['Publisher'] ?></li>
                          <li><strong>Copies: </strong><?php echo $sqlbookrows['Copies'] ?></li>
                    </ul>
                </div>
               </div>
               <div class="col-md-4 bookrev">
                 <h3 class="heading">Reviews and comments</h3>


                       <div class="row  userpost">
                        <div class="col-md-2">
                            <span class="profilepic"><img src="assets/images/profile1.jpg" class="img-circle" width="100px" height="100px"></span>
                        </div>
                        <div class="col-md-10">
                            <p>Thilanka Ranasinghe</p>
                           <span><p><i> 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also</i></p></span>
                        </div>
                      </div>

                      <div class="row  userpost">
                        <div class="col-md-2">
                            <span class="profilepic"><img src="assets/images/profile1.jpg" class="img-circle" width="100px" height="100px"></span>
                        </div>
                        <div class="col-md-10">
                            <p>Thilanka Ranasinghe</p>
                           <span><p><i> 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also</i></p></span>
                        </div>
                      </div>

                      <div class="row  userpost">
                        <div class="col-md-2">
                            <span class="profilepic"><img src="assets/images/profile1.jpg" class="img-circle" width="100px" height="100px"></span>
                        </div>
                        <div class="col-md-10">
                            <p>Thilanka Ranasinghe</p>
                           <span><p><i> 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also</i></p></span>
                        </div>
                      </div>

               </div>
            </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
