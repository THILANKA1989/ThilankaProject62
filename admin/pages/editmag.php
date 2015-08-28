<h4>Edit or Delete Magazines</h4>
<div class="row">
	<div class="col-md-12">
		<div class="tableofpenalty">
			<?php
			require_once('../../core/init.php');
			$rs = mysqli_query($connection,"SELECT DISTINCT ma.id AS ID,ma.date_pub AS Published, mg.id AS magID,mg.name AS Title,mg.language AS Lang,co.name AS Cover FROM magazine_adds ma JOIN magazines mg ON ma.magazine_id = mg.id JOIN covers co ON co.id = mg.cover
					");
			$rows = mysqli_fetch_assoc($rs);
			$numrows = mysqli_num_rows($rs);
			

			?>
			<table class="table table-bordered table-responsive">
  				<th>
  					<td>Magazine ID</td>
  					<td>Title</td>
  					<td>Language</td>
  					<td>Logo</td>
  					<td>Published Date</td>
  					<td>Operations</td>
  					
  				</th>
  				<?php if($numrows > 0){  ?>
                        <?php do { ?>
  				<tr>
  					<td><?php echo $rows['ID'];?></td>
  					<td><?php echo $rows['magID'];?></td>
  					<td><?php echo $rows['Title'];?></td>
  					<td><?php echo $rows['Lang'];?></td>
  					<td><img src="<?php echo "../".$rows['Cover'];?>" style="width:200px; height:170px;"/></td>
  					<td><?php echo $rows['Published'];?></td>
  					<td>
  						<div class="row">
	  						<div class="col-lg-6"><a href="../editmag.php?ID=<?php echo $rows['magID']; ?>" class="bkadd pull-left" style="zoom:0.75">Edit</a></div>
	  						<div class="col-lg-6"><a href="pages/processing/magazines/delete.php?delete=<?php echo $rows['ID']; ?>" class="bkedit pull-right" style="zoom:0.75">Delete</a></div>
  						</div>
  					</td>
  				</tr>

  				<?php } while($rows=mysqli_fetch_assoc($rs)); }else{ ?>
                            <?php echo 'No Books'; }?>
  				
			</table>


		</div>
	</div>
</div>