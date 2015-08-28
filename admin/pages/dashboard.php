<div class="dashtitle">
	<h2>Dashboard</h2>
</div>
<!-- quick update section -->
<div class="quickpick">
	<h3>Quick Update</h3>
<!-- newspapers-->
	<div class="formnp dashboardform row">
	<h4>Add The Latest Newspaper</h4>
		<form class="form-inline dashformnp" method="post" action="pages/processing/newspaperadd.php">
		 <div class="form-group dashformgroup col-md-3">
		    <label for="date">Name</label>
 <?php require_once '../../core/database/connect.php'; ?>
  <?php $result = mysqli_query($connection,"SELECT name FROM `newspaper`"); ?>
		    
		    <select class="form-control dashoption" name="name" id="name">
		    <option>Add newspaper</option>
			<?php while ($row=mysqli_fetch_array($result)){
                $value = $row['name']; ?>

                <?php echo "<option value='$value'>" ?><i><?php echo $row['name'] ?></i><?php echo "</option>" ?>
                <?php
                 }  ?> 
			</select>
		  </div>
		  <div class="form-group dashformgroup col-md-3">
		    <label for="date">Date</label>
		    <input type="date" class="form-control" id="date" placeholder="" name="date">
		  </div>
		  <div class="form-group dashformgroup col-md-3">
		    <label for="date">Type</label>
		    <select class="form-control dashoption" name="typenp" id="typenp">
			  <option>Daily</option>
			  <option>Weekend</option>
			</select>
		  </div>
		  <div class="col-md-3">
		  	<button type="submit" name="submit" class="btn btn-success dashaddnews">Add Newspaper</button>
		  </div>
		</form>
	</div>
<!-- newspapers -->
<!--magazine-->
	<div class="formnp dashboardform row">
	<h4>Add The Latest Magazine</h4>
		<form class="form-inline dashform" method="post" action="pages/processing/newspaperadd.php">
		 <div class="form-group dashformgroup col-md-4">
		    <label for="date">Name</label>
 <?php require_once '../../core/database/connect.php'; ?>
  <?php $result = mysqli_query($connection,"SELECT name FROM `newspaper`"); ?>
		    
		    <select class="form-control dashoption" name="name" id="name">
		    <option>Add Magazine</option>
			<?php while ($row=mysqli_fetch_array($result)){
                $value = $row['name']; ?>

                <?php echo "<option value='$value'>" ?><i><?php echo $row['name'] ?></i><?php echo "</option>" ?>
                <?php
                 }  ?> 
			</select>
		  </div>
		  <div class="form-group dashformgroup col-md-4">
		    <label for="date">Date</label>
		    <input type="date" class="form-control" id="date" placeholder="" name="date">
		  </div>
		  <div class="col-md-4">
		  	<button type="submit" name="submit" class="btn btn-success dashaddnews">Add Magazine</button>
		  </div>
		</form>
	</div>
<!--magazine-->
	<div class="noticeform">
	<form action="pages/processing/addnotice.php" method="post" id="notice">
	<h4>Post a Notice</h4>
		<textarea type="text" name="npost" id="npost" class="form-control" rows="3"></textarea>
		<button type="submit" class="btn btn-success dashaddnotice" name="submit" id="submit">Post Notice</button>
	</form>
	</div>
</div>
<!-- quick update section -->

<!-- latest borrowers -->
<div class="quickpick borrowers">
<?php
 $borrows =mysqli_query($connection,"SELECT uc.copy_id AS copyID, uc.user_id AS User,bk.title AS Book, bk.id AS bookID, uc.status AS Status,uc.date_lend AS bdate,us.username AS Username,uc.due_date AS ddate,uc.id AS ID,bk.isbn AS ISBN
          FROM user_lends_copies uc
          JOIN copies cp ON
            uc.copy_id = cp.id
          JOIN books bk ON
            cp.book_id = bk.id
          JOIN user us ON
          	us.id = uc.user_id
          ORDER BY bdate DESC
          LIMIT 10");
  $allborrows=mysqli_fetch_assoc($borrows);
  $numrowsbr = mysqli_num_rows($borrows);

?>
	<!-- lending history -->
<div class="libraryinfo row">
<h4>Borrowing history</h4>
	 <table class="table table-bordered table-responsive">
          <th>
          	<td>Copy ID</td>
            <td>Username</td>
            <td>Book Title</td>
            <td>BookID</td>
            <td>Status</td>
            <td>Borrowed Date</td>
            <td>Due Date</td>
            <td>Operations</td>
          </th>
          <?php if($numrowsbr > 0){  ?>
                        <?php do { ?>
          <tr>
            <td><?php echo $allborrows['ID'];?></td>
            <td><?php echo $allborrows['copyID'];?></td>
            <td><a href="../memberview.php?username=<?php echo $allborrows['Username']; ?>"><?php echo $allborrows['Username'];?></a></td>
            <td><?php echo $allborrows['Book'];?></td>
            <td><?php echo $allborrows['bookID'];?></td>
            <td><?php echo $allborrows['Status'];?></td>
            <td><?php echo $allborrows['bdate'];?></td>
            <td><?php echo $allborrows['ddate'];?></td>
            <td>
            	<div class="row">
	  						<div class="col-lg-6"><a href="../editbook.php?username=<?php echo $rows['ISBN']; ?>" class="bkadd pull-left" style="zoom:0.75">Edit</a></div>
	  					
  						</div>
            </td>
		</tr>
<?php } while($allborrows=mysqli_fetch_assoc($borrows)); }else{ ?>
                            <?php echo 'No Borrows'; }?>
</table>
	
</div>
<!-- lending history -->

<!-- members who have most penalty alive -->

<!-- table of penalty -->
<!-- members who have most penalty alive -->