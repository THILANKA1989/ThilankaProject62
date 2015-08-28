<?php
if(isset($_GET['username'])){
$username = $GET['username'];
$querybasic = mysqli_query($connection,"SELECT * FROM user WHERE username= '$usename'");
$currentdata= mysqli_fetch_assoc($querybasic);

}
?>

<div class="modal popupbook" id="#my_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

      </div>
      <div class="modal-body">
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

