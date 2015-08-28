<h4>Edit or Delete Newspapers</h4>
<div class="row">
	<div class="col-md-12">
		<div class="tableofpenalty">
			<?php
			require_once('../../core/init.php');
			$rs = mysqli_query($connection,"SELECT DISTINCT na.id AS ID,na.date_pub AS Published, np.id AS npID,np.name AS Title,na.type AS Type,np.cover AS Cover FROM newspaper_adds na JOIN newspaper np ON na.newspaper_id = np.id
					");
			$rows = mysqli_fetch_assoc($rs);
			$numrows = mysqli_num_rows($rs);
			

			?>
			<table class="table table-bordered table-responsive">
  				<th>
  					<td>Newspaper ID</td>
  					<td>Title</td>
  					<td>Date</td>
  					<td>Logo</td>
  					<td>Type</td>
  					<td>Operations</td>
  					
  				</th>
  				<?php if($numrows > 0){  ?>
                        <?php do { ?>
  				<tr>
  					<td><?php echo $rows['ID'];?></td>
  					<td><?php echo $rows['npID'];?></td>
              <td><?php echo $rows['Title'];?></td>
  					<td><?php echo $rows['Published'];?></td>
  				
  					<td><img src="<?php echo "../".$rows['Cover'];?>" style="width:200px; height:170px;"/></td>
              <td><?php echo $rows['Type'];?></td>
  		
  					<td>
  						<div class="row">
	  						<div class="col-lg-6"><a href="pages/processing/newspapers/edit.php?editid=<?php echo $rows['npID']; ?>" class="bkadd pull-left" style="zoom:0.75">Edit</a></div>
	  						<div class="col-lg-6"><a href="pages/processing/newspapers/delete.php?delete=<?php echo $rows['ID']; ?>" class="bkedit pull-right" style="zoom:0.75">Delete</a></div>
  						</div>
  					</td>
  				</tr>

  				<?php } while($rows=mysqli_fetch_assoc($rs)); }else{ ?>
                            <?php echo 'No Books'; }?>
  				
			</table>


		</div>
	</div>
</div>