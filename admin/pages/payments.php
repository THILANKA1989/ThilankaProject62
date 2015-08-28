<div class="dashtitle">
	<h2>Returns & Payments</h2>
</div><br/>
<?php include '../../core/init.php';?>
<h4>Return Book</h4>

<form role="form" action="pages/processing/returns.php" method="post" id="formbooks">
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
        <label for="Title">User ID:</label>
        <input type="text" class="form-control" id="userid" name="userid">
      </div>
  </div>
  <div class="col-md-6">
       <div class="form-group">
        <label for="Title">Copy ID</label>
        <input type="id" class="form-control" id="copyid" name="copyid">
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <span id="errMessage"></span>
    <input type="submit" value="Return Book" id="submit" class="form-control blue" name="submit">
  </div>
</div>
</form>
<h4>Payments</h4>
<form role="form" action="pages/processing/pay.php" method="post" id="formbooks">
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
        <label for="Title">User ID:</label>
        <input type="text" class="form-control" id="userid" name="userid">
      </div>
  </div>
  <div class="col-md-6">
       <div class="form-group">
        <label for="Title">Paid Amount:</label>
        <input type="title" class="form-control" id="paid" name="paid">
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <span id="errMessage"></span>
    <input type="submit" value="Pay" id="submit" class="form-control blue" name="submit">
  </div>
</div>
</form>
<?php 
  $getpays = mysqli_query($connection,"SELECT pay.date_paid AS DateP, us.username AS Username,us.id AS ID, pay.penalty AS Pay FROM payments pay
    JOIN user us ON
    us.id = pay.user_id
    ORDER BY pay.date_paid DESC");
  $getp = mysqli_fetch_assoc($getpays);
  $numrow = mysqli_num_rows($getpays);

 ?>
<div class="libraryinfo row">
<div class="col-md-12">
<h4>Payers History</h4>
   <table class="table table-bordered table-responsive">
          <th>
            <td>User ID</td>
            <td>Username</td>
            <td>Paid Amount</td>
            <td>Date</td>
            
          </th>
          <?php if($numrow > 0){  ?>
                        <?php do { ?>
          <tr>
            <td></td>
            <td><?php echo $getp['ID'];?></td>
            <td><a href="../memberview.php?username=<?php echo $getp['Username']; ?>"><?php echo $getp['Username'];?></a></td>
            <td><?php echo $getp['Pay'];?></td>
            <td><?php echo $getp['DateP'];?></td>
    </tr>
<?php } while($getp=mysqli_fetch_assoc($getpays)); }else{ ?>
                            <?php echo 'No Borrows'; }?>
</table>
</div>
</div>
<br/>
